<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals();

$app = new \App\Application();
$response = $app->dispatch($request);

echo $response->getBody();
