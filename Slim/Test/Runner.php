<?php

namespace Slim\Test;

use InvalidArgumentException;

class Runner {

    private $file;

    public function __construct($file) {
        if (!is_file($file))
            throw new InvalidArgumentException('File '.$file.' not exists');
        $this->file = $file;
    }

    public function run() {
        ob_start();
        require $this->file;
        ob_get_clean();
        return $app->response;
    }

}