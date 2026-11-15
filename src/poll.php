<?php

// PHP 8.6: Epoll-based simple HTTP server.

use Io\Poll\Context;
use Io\Poll\Event;
use StreamPollHandle;

$server = stream_socket_server('tcp://127.0.0.1:8080');
$poll = new Context();
$poll->add(new StreamPollHandle($server), [Event::Read]);

foreach ($poll->wait(timeoutSeconds: 30) as $watcher) {
  if ($watcher->hasTriggered(Event::Read)) {
    $connection = stream_socket_accept($watcher->getHandle()->getStream());
    // handle new connection...
  }
}
