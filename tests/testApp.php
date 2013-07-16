<?php

require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function(){
    echo 'test';
});

$app->delete('/product', function() {
    echo 'ok';
});

$app->post('/api/draw', function() use ($app) {
    echo json_encode(
        array(
            'object' => 'json',
            'code' => $app->request->post('key'),
        )
    );
});

$app->post('/api/draw.json', function() use ($app) {
    echo json_encode(
        array(
            'object' => 'json',
            'code' => json_decode($app->request->getBody())->key,
        )
    );
});

$app->put('/api/order', function() use ($app) {
    $app->response->setBody(json_encode(array(
        'force' => $app->request->get('force'),
        'order' => array(
            'orderKey' => $app->request->getBody(),
        ),
    )));
});

$app->put('/api/order.json', function() use ($app) {
    $app->response->setBody(json_encode(array(
        'force' => $app->request->get('force'),
        'order' => json_decode($app->request->getBody()),
    )));
});

$app->run();