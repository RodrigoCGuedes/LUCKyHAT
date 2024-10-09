<?php

namespace app\exceptions;

use app\exceptions\ContainerException;

class ControllerNotExistException extends ContainerException {
    public function __contruct($error) {
        parent::setError($error);
    }
}