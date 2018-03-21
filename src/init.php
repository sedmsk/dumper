<?php

(function () {
    $boot = [
        \SD\Dumper\Support\Dotenv::class => ['file' => \SD\Dumper\Support\Helper::project().'.env',],
        \SD\Dumper\Support\Helper::class => [],
        \SD\Dumper\Support\View::class => ['resources' => \SD\Dumper\Support\Helper::resources('views'),],
    ];

    /**
     * @var \SD\Dumper\Contracts\Makeble $class
     */
    foreach ($boot as $class => $config) {
        $class::make($config);
    }
})();
