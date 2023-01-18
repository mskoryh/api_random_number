<?php

use Controller\RandomController;

$router->addRoute('post', '/api/v1/generate', [(new RandomController), 'generate']);
$router->addRoute('get', '/api/v1/retrive/{id}', [(new RandomController), 'retrive']);
