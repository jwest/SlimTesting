<?php

use Slim\Test\Testing;

class TestingTest extends Testing {

    public $app = 'tests/testApp.php';

    public function testIndex() {
        $this->assertEquals('test', $this->get('/')->getBody());
    }

    public function testNotExistsPage() {
        $response = $this->get('/notExistsPage');
        $this->assertContains('404 Page Not Found', $response->getBody());
        $this->assertEquals(404, $response->getStatus());
    }

    public function testDeleteProduct() {
        $this->assertEquals('ok', $this->delete('/product')->getBody());
    }

    public function testDrawApi() {
        $response = $this->post('/api/draw', array('key' => 'value'));
        $this->assertEquals('value', json_decode($response->getBody())->code);
    }

    public function testDrawApiWithSendJSON() {
        $response = $this->postJson('/api/draw.json', array('key' => 'value'));
        $this->assertEquals('value', json_decode($response->getBody())->code);
    }

    public function testPutNewOrder() {
        $response = $this->put('/api/order?force=true', 'orderValue');

        $this->assertEquals(
            (object) array(
                'force' => 'true',
                'order' => (object) array('orderKey' => 'orderValue'),
            ),
            json_decode($response->getBody())
        );
    }

    public function testPutNewOrderWithSendJSON() {
        $response = $this->putJson('/api/order.json?force=true', array('orderKey' => 'orderValue'));

        $this->assertEquals(
            (object) array(
                'force' => 'true',
                'order' => (object) array('orderKey' => 'orderValue'),
            ),
            json_decode($response->getBody())
        );
    }
}