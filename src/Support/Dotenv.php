<?php

namespace SD\Dumper\Support;

use SD\Dumper\Contracts\Makeble;
use SD\Dumper\Traits\IsSingleton;

/**
 * Class Dotenv
 *
 * @package SD\Dumper\Support
 */
class Dotenv extends Makeble
{
    use IsSingleton;

    /**
     * @inheritDoc
     */
    protected static $loaded = false;

    /**
     * @var \Symfony\Component\Dotenv\Dotenv
     */
    protected $env;

    protected function __construct()
    {
        $this->env = new \Symfony\Component\Dotenv\Dotenv();
    }

    /**
     * @inheritDoc
     */
    public static function make(array $config = [])
    {
        static::getInstance()->env->load($config['file']);
        static::$loaded = true;
    }
}
