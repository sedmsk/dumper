<?php

namespace SD\Dumper\Support;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;

class OutputDumper
{
    /**
     * Dump a value with elegance.
     *
     * @param  mixed  $value
     * @return void
     */
    public function dump($value)
    {
        if (class_exists(CliDumper::class)) {
            $mustCli = \in_array(PHP_SAPI, [
                    'cli',
                    'phpdbg',
                ]) && ! \defined('PHPUNIT_COMPOSER_INSTALL') && ! \defined('__PHPUNIT_PHAR__');
            $dumper = $mustCli ? new CliDumper : new HtmlDumper;

            $dumper->dump((new VarCloner)->cloneVar($value));
        } else {
            var_dump($value);
        }
    }
}
