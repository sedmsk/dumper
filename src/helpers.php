<?php

if (!function_exists('dumper')) {
    function dumper(...$args): \SD\Dumper\Dumper
    {
        return \SD\Dumper\Dumper::dump(...$args);
    }
}
