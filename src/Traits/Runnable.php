<?php

declare(strict_types=1);

namespace SD\Dumper\Traits;

use SD\Dumper\Support\DataBase;

trait Runnable
{
    /**
     * @param int $timeout
     *
     * @return int|string
     */
    public static function run($timeout = 25)
    {
        $ajaxKey = 'HTTP_X_REQUESTED_WITH';

        if (isset($_SERVER[$ajaxKey]) && strtolower($_SERVER[$ajaxKey]) === 'xmlhttprequest') {
            if (isset($_GET['clear']) && $_GET['clear'] == 1) {
                DataBase::delete();

                return json_encode([]);
            }

            $max_time = time() + $timeout;

            do {
                $rows = DataBase::select($_GET['ts'] == -1 ? null : $_GET['ts']);
                if (\count($rows)) {
                    return json_encode([
                        'response' => [
                            'data' => $rows,
                            'ts' => $rows[0]['id'],
                        ],
                    ]);
                }
                usleep(200000); // .2 sec
            } while (time() < $max_time);

            return json_encode([]);
        }

        $index_file = implode(DIRECTORY_SEPARATOR, [
            __DIR__,        /* package/src/Traits       */
            '..',           /* package/src              */
            '..',           /* package                  */
            'resources',    /* package/resources        */
            'views',        /* package/resources/views  */
            'index.php',
        ]);

        require $index_file;

        return 0;
    }
}
