<?php declare(strict_types=1);

namespace SD\Dumper\Support;

use SD\Dumper\Contracts\Dumper;
use SD\Dumper\Traits\Runnable;
use SD\Dumper\Traits\Taggable;
use SD\Dumper\Traits\Writable;

abstract class AbstractDumper implements Dumper
{
    use Runnable, Taggable, Writable;

    protected static $qid;

    public function __construct()
    {
        static::$qid = static::$qid ?? hash('sha256', microtime());
    }
}
