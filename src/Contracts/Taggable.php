<?php declare(strict_types=1);

namespace SD\Dumper\Contracts;

/**
 * Interface Taggable
 *
 * @package SD\Dumper\Contracts
 */
interface Taggable
{
    /**
     * @param string $tag
     */
    public function appendTag(string $tag): void;

    /**
     * @return array
     */
    public function getTags(): array;
}
