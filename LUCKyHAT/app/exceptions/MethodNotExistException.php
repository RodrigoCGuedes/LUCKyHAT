<?php

namespace app\exceptions;

use app\exceptions\ContainerException;

class MethodNotExistException extends ContainerException {
    public function __contruct($error) {
        parent::setError($error);
    }
}