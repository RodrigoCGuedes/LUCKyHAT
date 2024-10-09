<?php

require "../bootstrap.php";

use core\Controller;
use core\Method;
use core\Parameters;
use app\exceptions\ContainerException;

try {
    $controller = new Controller;
    $controller = $controller->load();
    
    $method = new Method;
    $method = $method->load($controller);

    $parameters = new Parameters;
    $parameters = $parameters->load();

    $controller->$method($parameters);

} catch(ContainerException $e) {
    redirect('/error/show/404', true);
} catch(Exception $e) {
    error_log($e->getMessage());
    redirect('/error/show/500', true);
}