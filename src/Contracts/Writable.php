<?php declare(strict_types=1);

namespace SD\Dumper\Contracts;

/**
 * Interface Writable
 *
 * @package SD\Dumper\Contracts
 */
interface Writable
{
    /**
     * Будет ли этот дамп записан
     *
     * @param bool $writable
     */
    public function setWritable(bool $writable = true): void;

    /**
     * @return bool
     */
    public function isWritable(): bool;
}
