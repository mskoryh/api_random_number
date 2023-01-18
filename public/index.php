<?php

use App\Http\Request;
use App\Kernel as App;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../bootstrap.php';

$app = new App($container);

$request = Request::fromGlobals();
$response = $app->handle($request);
$app->sendResponse($response);
