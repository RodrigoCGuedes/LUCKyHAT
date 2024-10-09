<?php

namespace app\models\tools;

class SslScan
{
    public static function result($host)
    {
        if (empty($host)) {
            return [];
        }

        $port = 443;

        $connection = @fsockopen($host, $port, $errno, $errstr, 30);

        if (!$connection) {
            return [];
        }

        $streamContext = stream_context_create([
            'ssl' => [
                'capture_peer_cert' => true,
                'allow_self_signed' => true,
                'verify_peer' => false
            ]
        ]);

        $connection = stream_socket_client("ssl://$host:$port", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $streamContext);

        if (!$connection) {
            return [];
        }

        $cont = stream_context_get_params($connection);
        $cert = $cont['options']['ssl']['peer_certificate'] ?? null;

        if ($cert === null) {
            fclose($connection);
            return ['error' => ''];
        }

        $result = openssl_x509_parse($cert);

        if ($result === false) {
            fclose($connection);
            return [];
        }

        $result['purposes'] = SslScan::purposes($result['purposes']);

        $result['extensions']['ct_precert_scts'] = SslScan::ct_precert_scts($result['extensions']['ct_precert_scts']);

        fclose($connection);
        return $result;
    }

    private static function purposes($purposes)
    {
        $output = [];
        foreach ($purposes as $porpose) {
            $output[$porpose[2]] = "";
            if ($porpose[0] == true) {
                $output[$porpose[2]] .= "Critical";
            } else {
                $output[$porpose[2]] .= "Not Critical";
            }
            if ($porpose[1] == true) {
                $output[$porpose[2]] .= " - Supported by Default";
            } else {
                $output[$porpose[2]] .= " - Not Supported by Default";
            }
        }
        return $output;
    }

    private static function ct_precert_scts($text)
    {
        $output = [];

        $text = preg_replace('/\s+/', ' ', trim($text));

        $text = explode(" ", $text);

        $j = 1;

        for ($i = 0; $i < count($text); $i++) {
            for($i = $i; $i < count($text) && $text[$i] != "Version"; $i++);
            for($i = $i + 2; $i < count($text) && $text[$i] != "Log"; $i++) {
                $output['Certificate Transparency ' . $j]['Version'] .= $text[$i] . " - "; 
            }
            for($i = $i + 3; $i < count($text) && $text[$i] != "Timestamp"; $i++) {
                $output['Certificate Transparency ' . $j]['Log ID'] .= $text[$i] . " - "; 
            }
            for($i = $i + 2; $i < count($text) && $text[$i] != "Extensions:"; $i++) {
                $output['Certificate Transparency ' . $j]['Timestamp'] .= $text[$i] . " - "; 
            }
            for($i = $i + 1; $i < count($text) && $text[$i] != "Signature"; $i++) {
                $output['Certificate Transparency ' . $j]['Extensions'] .= $text[$i] . " - ";
            }
            for($i = $i + 2; $i < count($text) && $text[$i] != "Signed"; $i++) {
                $output['Certificate Transparency ' . $j]['Signature'] .= $text[$i] . " - ";
            }
            $j++;
        }

        return $output;
    }
}
