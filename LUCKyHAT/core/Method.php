<?php

namespace core;

use app\classes\Uri;
use app\exceptions\MethodNotExistException;

class Method {
    
    private $uri;

    public function __construct() {
        $this->uri = Uri::get();
    }

    public function load($controller) {
        $method = $this->getName();
        if(!method_exists($controller, $method)) {
            throw new MethodNotExistException('404');
        }
        return $method;
    }

    private function getName() {
        $method = explode('/', $this->uri);
        if(isset($method[2]) && $method[2] != null) return $method[2];
        return 'index';
    }
}