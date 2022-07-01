<?php

return new \Phalcon\Config(
    [
        'database' => [
            'adapter' => 'Postgresql',
            'host' => 'localhost',
            'port' => 5432,
            'username' => 'postgres',
            'password' => 'Jesus1706*',
            'dbname' => 'empresa',
        ],

        'application' => [
            'controllersDir' => "app/controllers/",
            'modelsDir' => "app/models/",
            'baseUri' => "/",
        ],
    ]
);