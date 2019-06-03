<?php

declare(strict_types=1);

namespace SD\Dumper\Contracts;

/**
 * Interface Runnable.
 */
interface Runnable
{
    /**
     * @param int $timeout
     *
     * @return int|string
     */
    public static function run($timeout = 25);
}
