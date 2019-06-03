<?php

declare(strict_types=1);

namespace SD\Dumper;

use SD\Dumper\Contracts\Dumper;
use SD\Dumper\Contracts\Parameter;

/**
 * Class Tag.
 */
class Tag implements Parameter
{
    /**
     * @var string
     */
    protected $tag;

    /**
     * Tag constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->tag = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Dumper $dumper)
    {
        $dumper->appendTag($this->tag);
    }
}
