<?php

use App\Container\Container;
use App\Router\Router;
use App\Storage\PhpArrayStorage;

$router = new Router();
include __DIR__ . '/routes.php';

$container = new Container();
$container->set('router', $router);
$container->set('storage', new PhpArrayStorage(__DIR__ . '/runtime/data.php'));
