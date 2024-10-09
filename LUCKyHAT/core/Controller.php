<?php

namespace core;

use app\classes\Uri;
use app\exceptions\ControllerNotExistException;

class Controller {

    private $uri;
    private $controller;
    private $nameSpace;

    private $folders = [
        'app\controllers\errors',
        'app\controllers\portal',
        'app\controllers\tools',
    ];

    public function __construct() {
        $this->uri = Uri::get();
    }

    public function load() {
        if($this->isHome()) {
            return $this->controllerHome();
        }
        return $this->controllerNotHome();
    }

    private function isHome() {
        return ($this->uri == '/');
    }

    private function controllerHome() {
        if(!$this->controllerExist('HomeController')) {
            throw new ControllerNotExistException('404');
        }
        return $this->instantiateController();
    }

    private function controllerNotHome() {
        $controller = $this->getControllerNotHome();
        if(!$this->controllerExist($controller)) {
            throw new ControllerNotExistException('404');
        }
        return $this->instantiateController();
    }

    private function getControllerNotHome() {
        $controller = explode('/', $this->uri);
        return ucfirst($controller[1]) . 'Controller';
    }

    private function controllerExist($controller) {
        foreach ($this->folders as $folder) {
            if(class_exists($folder . '\\' . $controller)) {
                $this->nameSpace = $folder;
                $this->controller = $controller;
                return true;
            }
        }
        return false;
    }

    private function instantiateController() {
        $controller = $this->nameSpace . '\\' . $this->controller;
        return new $controller;
    }

}