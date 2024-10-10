<?php

namespace app\models\tools;

class DnsLookup {

    public static function result($host) {
        if(empty($host)) {
            return [];
        }
        
        $output = [];

        $output['IPv4'] =  dns_get_record($host, DNS_A);

        $output['IPv6'] =  dns_get_record($host, DNS_AAAA);
        
        $output['Mail Exchange'] =  dns_get_record($host, DNS_MX);

        $output['CNAME'] =  dns_get_record($host, DNS_CNAME);

        $output['TXT'] =  dns_get_record($host, DNS_TXT);

        $output['Start of Authority'] =  dns_get_record($host, DNS_SOA);

        $output['Nameserver'] =  dns_get_record($host, DNS_NS);

        $output['Service'] =  dns_get_record($host, DNS_SRV);

        $output['Naming Authority Pointer'] =  dns_get_record($host, DNS_NAPTR);

        return $output;
    }
}