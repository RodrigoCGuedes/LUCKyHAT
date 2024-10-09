<?php

namespace app\models\tools;

class GetIP {

    public static function result($urls) {
        $ips = [];
        foreach($urls as $url) $ips[] = gethostbyname($url);
        return $ips;
    }
}