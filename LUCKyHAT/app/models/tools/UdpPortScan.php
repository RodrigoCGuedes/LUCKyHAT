<?php

namespace app\models\tools;

class UdpPortScan
{

    public static function result($ips)
    {
        if(empty($ips)) {
            return [];
        }

        $output = [];

        $results = include "../app/data/udp_ports.php";

        $socket = @socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

        foreach ($ips as $ip) {
            $buffer = [];

            foreach ($results as $result) {
                if (@socket_connect($socket, $ip, $result['port'])) {
                    $buffer[] = $result['port'] . " - " . $result['service'];
                }
            }
            if (!empty($buffer)) $output[$ip] = $buffer;
        }

        @socket_close($socket);

        return $output;
    }
}
