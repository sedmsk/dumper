<?php declare(strict_types=1);

namespace SD\Dumper;

use Closure;
use SD\Dumper\Contracts\Dumper;
use SD\Dumper\Contracts\Parameter;

/**
 * Class Expression
 *
 * @package SD\Dumper
 */
class Expression implements Parameter
{
    /**
     * @var bool
     */
    protected $expression;

    /**
     * Expression constructor.
     *
     * @param \Closure|bool $expression
     */
    public function __construct($expression)
    {
        $this->expression = $expression instanceof Closure ? $expression() : $expression;
    }

    public function apply(Dumper $dumper)
    {
        $dumper->setWritable($this->expression);
    }
}
