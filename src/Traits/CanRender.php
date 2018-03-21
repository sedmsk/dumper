<?php

namespace SD\Dumper\Traits;

use SD\Dumper\Support\Dumper;
use SD\Dumper\Support\Helper;
use SD\Dumper\Support\View;

/**
 * Trait CanRender
 *
 * @method static static getInstance() Получить экземпляр singleton класса
 *
 * @package SD\Dumper\Traits
 */
trait CanRender
{
    /**
     * Рендеринг шапки сообщения
     *
     * @return string
     */
    protected static function renderHeader(): string
    {
        $html = View::render('components/header', [
            'time' => time(),
            'date' => date('d.m.y H:i:s'),
            'uri' => $_SERVER['REQUEST_URI'] ?? '',
        ]);

        $html .= static::renderQueryParams();

        $html .= static::renderBacktrace();

        return $html;
    }

    /**
     * Рендеринг блока параметров запроса
     *
     * @return string
     */
    protected static function renderQueryParams(): string
    {
        return View::render('components/collapsible', [
            'hash' => Helper::hash(),
            'title' => 'Query params',
            'content' => static::renderDump($_REQUEST),
        ]);
    }

    /**
     * Рендеринг блока бэктрейса
     *
     * @return string
     */
    protected static function renderBacktrace(): string
    {
        $local_root = Helper::env('LOCAL_ROOT');
        $host = $local_root ? 'idea://open?file='.$local_root.DIRECTORY_SEPARATOR : 'http://localhost:63342/api/file?file=';

        $backtrace = debug_backtrace();
        do {
            $tmp = array_shift($backtrace);
        } while (substr(static::class, -strlen($tmp['class'])) !== $tmp['class'] || $tmp['function'] !== 'dump');

        $calls = [];
        $pattern = '/('.preg_quote(Helper::project(), DIRECTORY_SEPARATOR).')(.*)/';
        $from = $backtrace[0]['file'].':'.$backtrace[0]['line'];
        foreach ($backtrace as $call) {
            if (isset($call['file'], $call['line']) && preg_match($pattern, $call['file'], $matches)) {
                $call['file_relative'] = $matches[2];
                $call['file_root'] = $matches[1];
            }
            $calls[] = $call;
        }

        return View::render('components/collapsible', [
            'from' => $from,
            'hash' => Helper::hash(),
            'title' => 'Backtrace',
            'content' => View::render('components/table', compact('calls', 'host')),
        ]);
    }

    /**
     * Рендеринг дампа
     *
     * @param array ...$args
     *
     * @return string
     */
    protected static function renderDump(...$args): string
    {
        ob_start();

        foreach ($args as $x) {
            (new Dumper())->dump($x);
        }

        return ob_get_clean();
    }
}
