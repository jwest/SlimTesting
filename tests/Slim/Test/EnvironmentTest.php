<?php

use Slim\Test\Environment as Env;
use Slim\Environment as SlimEnv;

class EnvironmentTest extends PHPUnit_Framework_TestCase {

    //do env
    public function testDoSimpleEnv() {
        (new Env())->doEnv('GET', '/');
        $this->checkEnv('GET', '/');
    }

    public function testDoEnvWithData() {
        (new Env())->doEnv('POST', '/test?key=value', 'test');
        $this->checkEnv('POST', '/test', '?key=value', 'test');
    }

    //GET

    public function testPrepareSimpleEnv() {
        (new Env())->get('/');
        $this->checkEnv('GET', '/');
    }

    public function testOtherGetRoute() {
        (new Env())->get('/testRoute/1');
        $this->checkEnv('GET', '/testRoute/1');
    }

    public function testGetWithQueryString() {
        (new Env())->get('/testRoute/1?key=value');
        $this->checkEnv('GET', '/testRoute/1', '?key=value');
    }

    //DELETE

    public function testPrepareWithDelete() {
        (new Env())->delete('/');
        $this->checkEnv('DELETE', '/');
    }

    public function testOtherDeleteRoute() {
        (new Env())->delete('/testRoute/1');
        $this->checkEnv('DELETE', '/testRoute/1');
    }

    public function testDeleteWithQueryString() {
        (new Env())->delete('/testRoute/1?key=value');
        $this->checkEnv('DELETE', '/testRoute/1', '?key=value');
    }

    //POST

    public function testPrepareWithPost() {
        (new Env())->post('/');
        $this->checkEnv('POST', '/');
    }

    public function testPrepareWithOtherPostRoute() {
        (new Env())->post('/testPostRoute/1');
        $this->checkEnv('POST', '/testPostRoute/1');
    }

    public function testPostWithQueryString() {
        (new Env())->post('/testRoute/1?key=value');
        $this->checkEnv('POST', '/testRoute/1', '?key=value');
    }

    public function testPostWithPostContents() {
        (new Env())->post('/testRoute/1', 'key=value');
        $this->checkEnv('POST', '/testRoute/1', '', 'key=value');
    }

    //PUT

    public function testPrepareWithPut() {
        (new Env())->put('/');
        $this->checkEnv('PUT', '/');
    }

    public function testPrepareWithOtherPutRoute() {
        (new Env())->put('/testPostRoute/1');
        $this->checkEnv('PUT', '/testPostRoute/1');
    }

    public function testPutWithQueryString() {
        (new Env())->put('/testRoute/1?key=value');
        $this->checkEnv('PUT', '/testRoute/1', '?key=value');
    }

    public function testPutWithPostContents() {
        (new Env())->put('/testRoute/1', '{"key":"value"}');
        $this->checkEnv('PUT', '/testRoute/1', '', '{"key":"value"}');
    }

    //Utils

    private function checkEnv($method, $route, $queryString = '', $content = '') {
        $slim = SlimEnv::getInstance();
        $this->assertEquals($method, $slim['REQUEST_METHOD']);
        $this->assertEquals($route, $slim['PATH_INFO']);
        $this->assertEquals($queryString, $slim['QUERY_STRING']);
        $this->assertEquals($content, $slim['slim.input']);
    }
}