<?php declare(strict_types=1);

namespace SD\Dumper\Contracts;

/**
 * Interface Dumper
 *
 * @package SD\Dumper\Contracts
 */
interface Dumper extends Runnable, Taggable, Writable
{
    /**
     * @param \SD\Dumper\Contracts\Parameter|mixed ...$args
     *
     * @return \SD\Dumper\Contracts\Dumper
     */
    public function dump(...$args): self;
}
