<?php

declare(strict_types=1);

namespace SD\Dumper\Contracts;

/**
 * Interface Parameter.
 */
interface Parameter
{
    /**
     * @param \SD\Dumper\Contracts\Dumper $dumper
     *
     * @return mixed
     */
    public function apply(Dumper $dumper);
}
