<?php

namespace app\classes;

class Uri {
    public static function get() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $prefix = '/luckyhat';
        if (strpos($uri, $prefix) === 0) {
            $uri = substr($uri, strlen($prefix));
        }
        return $uri ? $uri : '/';
    }
}
