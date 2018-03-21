<?php

namespace SD\Dumper\Support;

use SD\Dumper\Contracts\Makeble;
use SD\Dumper\Traits\IsSingleton;
use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * Class View
 *
 * @package SD\Dumper\Support
 */
class View extends Makeble
{
    use IsSingleton;

    /**
     * @var bool
     */
    protected static $loaded = false;

    /**
     * @var \Twig_Loader_Filesystem|null
     */
    private $loader = null;

    /**
     * @var \Twig_Environment|null
     */
    private $twig = null;

    /**
     * @inheritDoc
     */
    public static function make(array $config = [])
    {
        $instance = static::getInstance();

        if (!static::$loaded) {
            $instance->loader = new Twig_Loader_Filesystem($config['resources']);
            $instance->twig = new Twig_Environment($instance->loader/*, ['cache' => '/path/to/compilation_cache',]*/);
            static::$loaded = true;
        }

        return $instance;
    }

    /**
     * @param string $template
     * @param array $context
     *
     * @return string
     */
    public static function render(string $template, array $context = []): string
    {
        $instance = static::getInstance();

        $name = $template.'.twig';

        try {
            return $instance->twig->render($name, $context);
        } catch (\Twig_Error $e) {
            ob_start();
            var_dump($e);

            return '<div style="background-color: #e3e3e3"><pre>'.ob_get_clean().'</pre></div>';
        }
    }

    /**
     * @param string $template
     * @param array $context
     *
     * @return void
     */
    public static function show(string $template, array $context = [])
    {
        echo static::render($template, $context);
    }
}
