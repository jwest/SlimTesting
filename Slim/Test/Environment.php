<?php

namespace Slim\Test;

use Slim\Environment as SlimEnv;

class Environment {

    public function doEnv($method, $route, $content = '') {
        SlimEnv::mock(array(
            'REQUEST_METHOD' => $method,
            'PATH_INFO' => $this->parseRoute($route),
            'QUERY_STRING' => $this->parseQueryString($route),
            'slim.input' => $content,
        ));
    }

    public function get($route) {
        $this->doEnv('GET', $route);
    }

    public function delete($route) {
        $this->doEnv('DELETE', $route);
    }

    public function post($route, $content = '') {
        $this->doEnv('POST', $route, $content);
    }

    public function put($route, $content = '') {
        $this->doEnv('PUT', $route, $content);
    }

    private function parseQueryString($route) {
        $parts = $this->explodeRoute($route);
        return isset($parts[1]) ? $parts[1] : '';
    }

    private function parseRoute($route) {
        return $this->explodeRoute($route)[0];
    }

    private function explodeRoute($route) {
        return explode('?', $route);
    }
}