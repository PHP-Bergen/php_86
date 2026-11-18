<?php

// PHP 8.6: Io\Poll based HTTP server (epoll on Linux, kqueue on macOS/BSD).
// Run:  php src/poll.php
// Test: curl -i http://127.0.0.1:8080/hello
//       ab -k -n 10000 -c 50 http://127.0.0.1:8080/   (keep-alive benchmark)

use Io\Poll\Context;
use Io\Poll\Event;
use Time\Duration;

// HTTP/1.1 keeps the connection open unless the client says "close";
// HTTP/1.0 closes it unless the client asks for "keep-alive".
function wantsKeepAlive(string $protocol, string $head): bool
{
    $connection = preg_match('/^Connection:\s*(.+)$/mi', $head, $m) ? strtolower(trim($m[1])) : '';

    return $protocol === 'HTTP/1.1'
        ? !str_contains($connection, 'close')
        : str_contains($connection, 'keep-alive');
}

$server = stream_socket_server('tcp://127.0.0.1:8080', $errno, $errstr)
    ?: exit("Could not start server: $errstr\n");
stream_set_blocking($server, false);

$poll = new Context();
$poll->add(new StreamPollHandle($server), [Event::Read], data: 'server');

echo "Listening on http://127.0.0.1:8080 (backend: {$poll->getBackend()->name})\n";

while (true) {
    foreach ($poll->wait(Duration::fromSeconds(30)) as $watcher) {
        $stream = $watcher->getHandle()->getStream();

        // New client on the listening socket: accept it and watch it for reads.
        if ($watcher->getData() === 'server') {
            if ($client = @stream_socket_accept($stream, 0)) {
                stream_set_blocking($client, false);
                $poll->add(new StreamPollHandle($client), [Event::Read], data: '');
            }
            continue;
        }

        // Socket error: stop watching and close.
        if ($watcher->hasTriggered(Event::Error)) {
            $watcher->remove();
            fclose($stream);
            continue;
        }

        // Client sent data and/or hung up. A hang-up can arrive together with
        // a final request, so always read first; an empty read means EOF.
        if ($watcher->hasTriggered(Event::Read) || $watcher->hasTriggered(Event::HangUp)) {
            $chunk = fread($stream, 8192);
            if ($chunk === '' || $chunk === false) {
                $watcher->remove();
                fclose($stream);
                continue;
            }

            $buffer = $watcher->getData() . $chunk;
            $keepAlive = true;

            // Answer every complete request in the buffer (clients may pipeline).
            while ($keepAlive && ($end = strpos($buffer, "\r\n\r\n")) !== false) {
                $head = substr($buffer, 0, $end);
                $buffer = substr($buffer, $end + 4);

                [$method, $path, $protocol] = explode(' ', strtok($head, "\r\n"), 3) + ['', '', ''];
                $keepAlive = wantsKeepAlive($protocol, $head);
                $body = "Hello from PHP " . PHP_VERSION . "\nYou requested: $method $path\n";

                // Response is small, so a single write is enough for a demo.
                fwrite($stream, "HTTP/1.1 200 OK\r\n"
                    . "Content-Type: text/plain; charset=utf-8\r\n"
                    . "Content-Length: " . strlen($body) . "\r\n"
                    . 'Connection: ' . ($keepAlive ? 'keep-alive' : 'close') . "\r\n\r\n"
                    . $body);

                echo date('H:i:s') . " $method $path\n";
            }

            if ($keepAlive) {
                // Keep watching this connection; remember any partial next request.
                $watcher->modifyData($buffer);
            } else {
                $watcher->remove();
                fclose($stream);
            }
        }
    }
}
