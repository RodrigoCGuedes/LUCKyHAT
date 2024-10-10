<?php

namespace app\exceptions;

use app\exceptions\ContainerException;

class ParameterNotExistException extends ContainerException {
    public function __contruct($error) {
        parent::setError($error);
    }
}