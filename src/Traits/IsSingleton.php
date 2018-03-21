<?php

namespace SD\Dumper\Traits;

/**
 * Trait IsSingleton
 *
 * @package SD\Dumper\Traits
 */
trait IsSingleton
{
    /**
     * @var static $instance Экземпляр singleton класса
     */
    private static $instance = null;

    /**
     * Получить экземпляр singleton класса
     *
     * @return static
     */
    protected static function getInstance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new static;
        }

        return self::$instance;
    }

    /**
     * @inheritDoc
     */
    public static function make(array $config = [])
    {
        $instance = static::getInstance();
        $instance::$loaded = true;
    }
}
