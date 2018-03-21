<?php

namespace SD\Dumper\Contracts;

abstract class Makeble
{
    protected static $loaded = false;

    abstract public static function make(array $config = []);
}
