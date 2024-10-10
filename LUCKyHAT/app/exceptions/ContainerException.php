<?php

namespace app\exceptions;

use Exception;

abstract class ContainerException extends Exception {
    private $error;
    public function getError() {
        return $this->error;
    }
    protected function setError($error) {
        $this->error = $error;
    }
}