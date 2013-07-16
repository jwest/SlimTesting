<?php

namespace Slim\Test;

use Slim\Test\Environment;
use PHPUnit_Framework_TestCase;

abstract class Testing extends PHPUnit_Framework_TestCase {

    public $app;

    public function get($route) {
        (new Environment)->get($route);
        return (new Runner($this->app))->run();
    }

    public function delete($route) {
        (new Environment)->delete($route);
        return (new Runner($this->app))->run();
    }

    public function post($route, $params) {
        (new Environment)->post($route, http_build_query($params));
        return (new Runner($this->app))->run();
    }

    public function postJson($route, $params) {
        (new Environment)->post($route, json_encode($params));
        return (new Runner($this->app))->run();
    }

    public function put($route, $params) {
        (new Environment)->put($route, $params);
        return (new Runner($this->app))->run();
    }

    public function putJson($route, $params) {
        (new Environment)->put($route, json_encode($params));
        return (new Runner($this->app))->run();
    }
}