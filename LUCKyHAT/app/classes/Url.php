<?php

namespace app\classes;

class Url {
    public static function get() {
        return $_SERVER['HTTP_HOST'];
    }
}