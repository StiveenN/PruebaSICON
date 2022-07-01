<?php
use Phalcon\Loader;
$loader = new Loader();

$loader->registerNamespaces(
    [
        'Store\Toys' => __DIR__ . '../models/',
        'ApiSICON' => __DIR__ . '../models/',
    ]
);

$loader->register();