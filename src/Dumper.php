<?php

namespace SD\Dumper;

use SD\Dumper\Support\Helper;
use SD\Dumper\Support\View;
use SD\Dumper\Traits\CanRender;
use SD\Dumper\Traits\HasTags;
use SD\Dumper\Traits\IsSingleton;
use SD\Dumper\Traits\TraitBootstrapper;

class Dumper
{
    use CanRender, HasTags, IsSingleton, TraitBootstrapper;

    protected function __construct()
    {
        static::boot();
    }

    /**
     * Получить абсолютный путь к пользовательской директории домпов
     *
     * @param string $tag
     *
     * @return string
     */
    protected static function getStorage(string $tag = ''): string
    {
        $tag = $tag ?: static::getTag();
        $tmp_dir = Helper::env('STORAGE_DIR', sys_get_temp_dir());

        $path = implode(DIRECTORY_SEPARATOR, [
            $tmp_dir,
            'dumper',
            Helper::hash(__DIR__),
            $tag,
        ]);

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        return realpath($path).DIRECTORY_SEPARATOR;
    }

    /**
     * @param array ...$args
     *
     * @return \SD\Dumper\Dumper
     */
    public static function dump(...$args): self
    {
        if (!empty($args)) {
            $html = static::renderHeader();

            $html .= static::renderDump(...$args);

            static::write($html);
        }

        return static::getInstance();
    }

    /**
     * Запись в файл
     *
     * @param string $content
     */
    protected static function write(string $content)
    {
        $storage = static::getStorage();
        $filename = static::filename();

        static::unsetTag(true);

        file_put_contents($storage.$filename, $content, LOCK_EX);
    }

    /**
     * @return string
     */
    protected static function filename():string
    {
        return Helper::time().'.'.rand(1000, 9999);
    }

    /**
     * Long pooling
     *
     * @param int $max_execution_time Максимальное время ожидания в секундах (TTL)
     *
     * @return void
     */
    protected static function longPooling($max_execution_time = 25)
    {
        $deadline = time() + $max_execution_time;

        $last = intval($_REQUEST['last'] ?? 0);
        $tag = $_REQUEST['tag'] ?? '';

        $storage = static::getStorage($tag);

        do {
            foreach (glob($storage.'*') as $file_path) {
                $filename = basename($file_path);
                $pattern = '/^(\d+)\.\d+$/';

                if (preg_match($pattern, $filename, $matches) && $last < (int)$matches[1]) {
                    $content = file_get_contents($file_path);

                    ob_start();
                    if (!unlink($file_path)) {
                        $unlink_warning = static::renderHeader();
                        $unlink_warning .= static::renderDump(ob_get_clean());
                        $content .= $unlink_warning;
                    } else {
                        ob_get_clean();
                    }

                    echo json_encode([
                        'response' => [
                            'time' => $matches[1],
                            'content' => $content,
                        ],
                    ]);

                    die(0);
                }
            }
            usleep(500);
        } while (time() < $deadline);

        die(1);
    }

    /**
     * Запуск web'а дампера
     *
     * @return void
     */
    public static function run()
    {
        if (Helper::isAjax()) {
            static::longPooling();
        } else {
            View::show('index', [
                'tag' => $_REQUEST['tag'] ?? '',
                'time' => Helper::time(),
                'ajax' => $_SERVER['REQUEST_URI'] ?? '',
            ]);
        }
    }
}
