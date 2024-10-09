<?php

namespace app\models\tools;

class SubdomainScan
{

    public static function result($domain)
    {
        if(empty($domain)) {
            return [];
        }

        $output = [];

        $prefixes = include "../app/data/prefixes.php";

        $multiCurl = curl_multi_init();
        $curlHandles = [];

        foreach ($prefixes as $prefix) {
            $url = $prefix . "." . $domain;
            $curlHandle = curl_init();
            curl_setopt($curlHandle, CURLOPT_URL, $url);
            curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curlHandle, CURLOPT_TIMEOUT, 1);
            curl_setopt($curlHandle, CURLOPT_NOBODY, true);

            curl_multi_add_handle($multiCurl, $curlHandle);

            $curlHandles[] = [
                'curlHandle' => $curlHandle,
                'url' => $url
            ];
        }

        $running = null;
        do {
            curl_multi_exec($multiCurl, $running);
            usleep(10000);
        } while ($running > 0);

        foreach ($curlHandles as $ch) {
            $httpCode = curl_getinfo($ch['curlHandle'], CURLINFO_HTTP_CODE);
            if ($httpCode >= 200 && $httpCode < 400) $output[] = $ch['url'];

            curl_multi_remove_handle($multiCurl, $ch['curlHandle']);
            curl_close($ch['curlHandle']);
        }

        curl_multi_close($multiCurl);
        return $output;
    }
}
