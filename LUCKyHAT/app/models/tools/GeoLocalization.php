<?php

namespace app\models\tools;

class GeoLocalization
{

    public static function result($ips)
    {
        if(empty($ips)) {
            return [];
        }

        $output = [];

        foreach ($ips as $ip) {
            $url = "http://ipinfo.io/{$ip}/json";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($response, true);

            $output[$ip] = $data;
        }

        return $output;
    }
}
