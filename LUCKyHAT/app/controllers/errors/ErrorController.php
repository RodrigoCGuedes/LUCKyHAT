<?php

namespace app\controllers\errors;

use app\controllers\ContainerController;
use app\traits\View;

class ErrorController extends ContainerController {
    use View;

    private $errors = [
        '403' => '403 - Forbidden',
        '404' => '404 - Not Found',
        '500' => '500 - Internal Server Error',
        '503' => '503 - Bad Gateway',
    ];

    public function show($error) {
        if($error == null) $error = '404';
        $this->view([
            'title' => 'OSINT - Error',
            'error' => $this->errors[$error]
        ], "errors/error");
    }
}