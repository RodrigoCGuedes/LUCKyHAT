<?php

namespace app\traits;

use core\Twig;

trait View {

    private function twig() {
        $twig = new Twig;
        return $twig->load();
    }

    public function view($data, $view) {
        $template = $this->twig()->load($view . ".html");
        return $template->display($data);
    }
}

