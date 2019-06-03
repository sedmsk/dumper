<?php

declare(strict_types=1);

namespace SD\Dumper\Traits;

trait Taggable
{
    private $tags = [];

    public function appendTag(string $tag): void
    {
        $this->tags[] = $tag;
    }

    public function getTags(): array
    {
        return array_unique($this->tags);
    }
}
