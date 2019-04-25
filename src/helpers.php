<?php declare(strict_types=1);

if (!function_exists('dumper')) {
    /**
     * @param  \SD\Dumper\Contracts\Parameter|mixed ...$args
     *
     * @return \SD\Dumper\Contracts\Dumper
     */
    function dumper(...$args): \SD\Dumper\Contracts\Dumper
    {
        return (new \SD\Dumper\Dumper())->dump(...$args);
    }
}

if (!function_exists('tag')) {
    /**
     * @param string $name
     *
     * @return \SD\Dumper\Contracts\Parameter
     */
    function tag(string $name): \SD\Dumper\Contracts\Parameter
    {
        return new \SD\Dumper\Tag($name);
    }
}

if (!function_exists('expr')) {
    /**
     * @param $expression
     *
     * @return \SD\Dumper\Contracts\Parameter
     */
    function expr($expression): \SD\Dumper\Contracts\Parameter
    {
        return new \SD\Dumper\Expression($expression);
    }
}

if (!function_exists('dumpScripts')) {
    /**
     * @return string
     */
    function dumpScripts(): string
    {
        $scripts = (new \SD\Dumper\Support\HtmlDumper())->renderDumpHandler();

        $fa = [
            '<i class="fa fa-fw fa-arrow-circle-right" aria-hidden="true"></i>',
            '<i class="fa fa-fw fa-arrow-circle-down" aria-hidden="true"></i>',
        ];

        return str_replace(['▶', '▼',], $fa, $scripts);
    }
}

if (!function_exists('mix')) {
    /**
     * @param string $path
     * @param bool $wrap
     *
     * @return string
     */
    function mix(string $path, bool $wrap = true): string
    {
        $root = implode(DIRECTORY_SEPARATOR, [
            __DIR__,    /* root/vendor/sd/dumper */
            '..',       /* root/vendor/sd */
            '..',       /* root/vendor */
            '..',       /* root */
            '..',       /* root */
        ]);
        $root = realpath($root);
        $distDir = implode(DIRECTORY_SEPARATOR, [
                __DIR__,    /* package/src */
                '..',       /* package */
                'dist',     /* package/dist */
            ]);
        $distDir = realpath($distDir);
        $url = str_replace($root, '', $distDir);
        $manifest = json_decode(file_get_contents($distDir.DIRECTORY_SEPARATOR.'mix-manifest.json'), true);

        $output = $url.($manifest['/'.trim($path, '/')]);

        if ($wrap) {
            if ($wrap === true) {
                $exts = [
                    'js' => '<script src="%s"></script>',
                    'css' => '<link href="%s" rel="stylesheet">',
                ];
                $ext = explode('.', $path);
                $ext = array_pop($ext);
                if ($exts[$ext]) {
                    $wrap = $exts[$ext];
                }
            }
            $output = sprintf($wrap, $output);
        }

        return $output;
    }
}
