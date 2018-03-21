<?php

namespace SD\Dumper\Support;

use Closure;
use SD\Dumper\Contracts\Makeble;
use SD\Dumper\Traits\IsSingleton;
use SD\Dumper\Traits\TraitBootstrapper;

/**
 * Class Helper
 *
 * @package SD\Dumper\Support
 */
class Helper extends Makeble
{
    use IsSingleton, TraitBootstrapper;

    protected static $loaded = false;

    /**
     * @param int|float $multiply
     *
     * @return int
     */
    public static function time($multiply = 1e4): int
    {
        return intval(microtime(true) * $multiply);
    }

    /**
     * @param null $input
     * @param int $length
     *
     * @return string
     */
    public static function hash($input = null, $length = 7): string
    {
        $data = $input ?? microtime();

        return substr(hash('md5', $data), $length);
    }

    /**
     * Gets the value of an environment variable.
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    public static function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return static::value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        return $value;
    }

    /**
     * Return the default value of the given value.
     *
     * @param  mixed $value
     * @return mixed
     */
    public static function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }

    /**
     * @param string $path
     * @return string
     */
    public static function resources(string $path = ''): string
    {
        $resources = implode(DIRECTORY_SEPARATOR, [
            'resources',
            $path,
        ]);

        return static::package($resources);
    }

    /**
     * @param string $path
     * @return string
     */
    public static function project($path = ''): string
    {
        $project = implode(DIRECTORY_SEPARATOR, [
            '..',
            '..',
            '..',
            $path,
        ]);

        return static::package($project);
    }

    /**
     * @param string $path
     * @return string
     */
    public static function package(string $path = ''): string
    {
        $root = realpath(implode(DIRECTORY_SEPARATOR, [
            __DIR__,
            '..',
            '..',
            $path,
        ]));

        return $root.DIRECTORY_SEPARATOR;
    }

    /**
     * @return bool
     */
    public static function isAjax(): bool
    {
        $var = 'HTTP_X_REQUESTED_WITH';

        return !empty($_SERVER[$var]) && strtolower($_SERVER[$var]) === 'xmlhttprequest';
    }
}
