<?php

use app\classes\Url;

function redirect($page, $permanent) {
    $url = Url::get();
    header('Location: ' . 'http://' . $url . $page, true, $permanent ? 301 : 302);
    exit();
}