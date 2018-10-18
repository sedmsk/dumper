<?php declare(strict_types=1);

namespace SD\Dumper\Traits;

trait Writable
{
    private $writable = true;

    public function isWritable(): bool
    {
        return $this->writable;
    }

    public function setWritable(bool $writable = true): void
    {
        $this->writable = $writable;
    }

    /**
     * Добавление записы дампа
     *
     * @param mixed ...$args
     */
    abstract protected function write(...$args): void;
}
