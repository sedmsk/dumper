<?php declare(strict_types=1);

function rglob($pattern, $flags = 0)
{
    $options = [glob($pattern, $flags)];
    foreach (glob(dirname($pattern).DIRECTORY_SEPARATOR.'*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir) {
        $options[] = rglob($dir.DIRECTORY_SEPARATOR.basename($pattern), $flags);
    }

    return array_merge(...$options);
}

function mutate($re)
{
    chdir(implode(DIRECTORY_SEPARATOR, [
        __DIR__,
        '..',
        '..',
        'js',
    ]));

    foreach (rglob('*.vue') as $file) {
        file_put_contents($file, preg_replace(...array_merge($re, [file_get_contents($file)])));
    }
}

$options = getopt('v:', [
    'vector:',
]);

if (isset($options['v']) || isset($options['vector'])) {
    $vector = $options['v'] ?? $options['vector'];
    $options = [
        ['/(>|\}\})(\n\s+)\s{3}(\{\{|<)/', '$1<!--$2-->$3',],
        ['/(>|\}\})<!--(\n\s+)-->(\{\{|<)/', '$1$2   $3',],
    ];

    if (isset($options[$vector])) {

        mutate($options[$vector]);
        exit;
    }
}

exit(1);
