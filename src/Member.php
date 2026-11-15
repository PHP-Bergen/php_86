<?php

namespace phpbergen\php86;

interface MemberInterface {
    public string $organization { get; }
    public bool $notification { get; }
}

//Readonly class Member {
//
//    public function __construct(
//        public string $name,
//        public string $organization,
//        public bool $notification,
//    ) {
//    }
//}

// PHP 8.6.
final Readonly class Member implements MemberInterface {

    public string $organization = 'PHP Bergen';
    public bool $notification = false;

    public function __construct(
        public string $name,
        ?string $organization = null,
        ?bool $notification = null,
    ) {
    }
}

// Works on abstract classes.
abstract class Priority {
    public readonly int $priority = 1;
}

final class HighPriority extends Priority {
    public readonly int $priority = 2;
}

