<?php

namespace core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class Twig {

    private $twig;
    private $functions = [];

    public function __construct() {
        $this->functions = include "../app/twig/twigFunctions.php";
    }

    public function load() {
        $this->twig = new \Twig\Environment($this->loadViews(), [
            'debug' => true,
            // 'cache' => '/cache',
            'auto_reload' => true
        ]);

        $this->addFunctions($this->functions);

        return $this->twig;
    }

    private function loadViews() {
        return new \Twig\Loader\FilesystemLoader('../app/views');
    }

    private function addFunctions($functions) {
        foreach ($functions as $name => $function) {
            $this->twig->addFunction(new TwigFunction($name, $function));  
        }
    }
}