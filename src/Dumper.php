<?php declare(strict_types=1);

namespace SD\Dumper;

use SD\Dumper\Contracts\Dumper as IDumper;
use SD\Dumper\Contracts\Parameter;
use SD\Dumper\Support\AbstractDumper;
use SD\Dumper\Support\DataBase;
use SD\Dumper\Support\OutputDumper;

/**
 * Class Dumper
 *
 * @package SD\Dumper
 * @since 0.4.0
 */
class Dumper extends AbstractDumper
{

    /**
     * @param mixed ...$args
     *
     * @return \SD\Dumper\Contracts\Dumper
     */
    public function dump(...$args): IDumper
    {
        while (($param = array_shift($args)) && $param instanceof Parameter) {
            $param->apply($this);
        }

        array_unshift($args, $param);

        $this->write(...$args);

        return $this;
    }

    /**
     * @inheritdoc
     */
    protected function write(...$args): void
    {
        if ($this->isWritable()) {
            ob_start();
            foreach ($args as $arg) {
                (new OutputDumper())->dump($arg);
            }
            $output = base64_encode(ob_get_clean());
            $tags = $this->getTags();
            $qid = static::$qid;
            $did = 'd'.mt_rand((int)1e10, (int)1e11 - 1);
            $timestamp = floor(microtime(true) * 1e3);

            $json = json_encode(compact('output', 'tags', 'qid', 'timestamp', 'did'), JSON_PRETTY_PRINT);

            DataBase::insert($json);
        }
    }

//    protected function getBacktrace(): array
//    {
//        $local_root = false;
//        $host = $local_root ? 'idea://open?file='.$local_root.DIRECTORY_SEPARATOR : 'http://localhost:63342/api/file?file=';
//
//        $backtrace = debug_backtrace();
//        do {
//            $tmp = array_shift($backtrace);
//        } while (substr(static::class, -\strlen($tmp['class'])) !== $tmp['class'] || $tmp['function'] !== 'dump');
//
//        return [];
//    }
}
