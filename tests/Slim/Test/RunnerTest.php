<?php

use Slim\Test\Runner;
use Slim\Test\Environment;

class RunnerTest extends PHPUnit_Framework_TestCase {

    public function testPrepareRunnerWhenAppNotExists() {
        $this->setExpectedException('\InvalidArgumentException');
        $request = new Runner('notExistsFile.php');
    }

    public function testPrepareRequest() {
        $request = new Runner('tests/testApp.php');
    }

    public function testRunAppAndCheckIfResponseIsset() {
        (new Environment)->get('/');
        $request = new Runner('tests/testApp.php');
        $this->assertInstanceof('\Slim\Http\Response', $request->run());
    }

    public function testBodyAfterRun() {
        (new Environment)->get('/');
        $request = new Runner('tests/testApp.php');
        $this->assertEquals('test', $request->run()->getBody());
    }

}