<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Postgresql as Postgresql;

$config = require(__DIR__ . '/config.php');

$di = new FactoryDefault();

$di->set(
  "db",
  function () use ($config) {    
      return new Postgresql(
        [
          "host"     => $config->database->host,
          "username" => $config->database->username,
          "password" => $config->database->password,
          "dbname"   => $config->database->dbname,
        ]
      );
  }
);

return $di;