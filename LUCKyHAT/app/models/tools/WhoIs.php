<?php

namespace app\models\tools;

use Iodev\Whois\Factory;

class WhoIs
{
    public static function result($domains)
    {
        if(empty($domains)) {
            return [];
        }
        
        $output = [];
        $whois = Factory::get()->createWhois();

        foreach ($domains as $domain) {
            $response = $whois->lookupDomain($domain);
            $lockupText = $response->text ?? 'N/A';
            $output[$domain] = WhoIs::parseWhoisResponse($lockupText);
        }

        return $output;
    }

    private static function parseWhoisResponse($response)
    {
        $result = [];
        $lines = explode("\n", $response);

        foreach ($lines as $line) {

            if (trim($line) == '' || strpos($line, '%') === 0 || strpos($line, '#') === 0) {
                continue;
            }

            if (strpos($line, ':') !== false) {
                list($key, $value) = explode(":", $line, 2);
                $key[0] = strtoupper($key[0]);
                $result[trim($key)] = trim($value);
            }
        }

        return $result;
    }
}
