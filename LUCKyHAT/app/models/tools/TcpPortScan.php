<?php

namespace app\models\tools;

class TcpPortScan
{
    public static function result($ips)
    {
        if(empty($ips)) {
            return [];
        }

        $output = [];

        $results = include "../app/data/tcp_ports.php";

        $multiCurl = curl_multi_init();
        $curlHandles = [];

        $timeOut = 1;

        foreach ($ips as $ip) {
            foreach ($results as $result) {
                $curlHandle = curl_init();
                $url = "telnet://{$ip}:{$result['port']}";

                curl_setopt($curlHandle, CURLOPT_URL, $url);
                curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curlHandle, CURLOPT_TIMEOUT, $timeOut);
                curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, $timeOut);
                curl_setopt($curlHandle, CURLOPT_NOBODY, true);

                curl_multi_add_handle($multiCurl, $curlHandle);

                $curlHandles[] = [
                    'curlHandle' => $curlHandle,
                    'ip' => $ip,
                    'port' => $result['port'],
                    'service' => $result['service'],
                ];
            }
        }

        $running = null;
        do {
            curl_multi_exec($multiCurl, $running);
            usleep(10000);
        } while ($running > 0);

        foreach ($curlHandles as $i) {
            $curlHandle = $i['curlHandle'];
            $ip = $i['ip'];

            if (curl_getinfo($curlHandle, CURLINFO_CONNECT_TIME) > 0) {
                if (!isset($output[$ip])) $output[$ip] = [];
                
                $buffer = $i['port'] . " - " . $i['service'];

                if (!in_array($buffer, $output[$ip])) $output[$ip][] = $buffer;
            }

            curl_multi_remove_handle($multiCurl, $curlHandle);
            curl_close($curlHandle);
        }

        curl_multi_close($multiCurl);

        return $output;
    }
}
