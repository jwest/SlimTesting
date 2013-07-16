#Integration tests for Slim Framework

If you doing integration tests for your app writen in slim framework, you must use this package ;)

##How it works?

1. Name for your test with sufix *ItTest.php (for readibility),
2. Test class extends with Slim\Test\Testing,
3. Field $app in class showing where your app started (public/index.php),
4. Use five magic methods for create and send request to your app:

    * get($route) - send request via GET
    * delete($route) - send request via DELETE
    * post($route, $params) - send request via POST with parameters encoded with http params format
    * postJson($route, $params) - send request via POST with json as request body
    * put($route, $params) - send request via PUT with parameters encoded with http params format
    * putJson($route, $params) - send request via PUT with json as request body

5. Use query string in routes.

Example in: tests/Slim/Test/TestingItTest.php

```php
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
```
