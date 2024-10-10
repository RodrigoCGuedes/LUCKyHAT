<?php

namespace core;

use app\classes\Uri;

class Parameters {

    private $uri;

    public function __construct() {
        $this->uri = Uri::get();
    }

    public function load() {
        return $this->getName(3);
    }

    private function getName($i) {
        $parameters = explode('/', $this->uri);
        if(isset($parameters[$i + 1])) {
            return (object) [
                'parameter' => filter_var($parameters[$i]),
                'next' => $this->getName($i + 1)
            ];
        }
        if(isset($parameters[$i])) return filter_var($parameters[$i]);
        return 'index';
    }
}