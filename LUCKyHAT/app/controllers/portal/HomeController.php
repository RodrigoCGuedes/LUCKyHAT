<?php

namespace app\controllers\portal;

use app\controllers\ContainerController;

class HomeController extends ContainerController {

    private $pages = [
        'Tools',
        'Introduction',
    ];

    public function index() {
        $this->view([
            'title' => 'Home',
            'pages' => $this->pages,
        ], 'portal/home');
    }

}