<?php
require dirname(__DIR__) . '/vendor/autoload.php';

/** @var \Psr\Http\Message\ServerRequestInterface $request */
$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals();

$app = new \App\Application();
$response = $app->dispatch($request);

$headers = $response->getHeaders();
foreach ($headers as $header => $values) {
    header($header . ': ' . $values[0]);
}
echo $response->getBody();
