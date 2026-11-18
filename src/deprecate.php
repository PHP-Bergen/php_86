<?php

class Foo
{
    public function __construct()
    {
        return 123; // Deprecated: Returning a value from a constructor is deprecated in test.php on line 6
    }

    public function __destruct()
    {
        return 123; // Deprecated: Returning a value from a constructor is deprecated in test.php on line 12
    }
}
