<?php

namespace app\controllers\portal;

use app\controllers\ContainerController;

class IntroductionController extends ContainerController
{

    private $topics = [
        'About' => [
            'Credits',
        ],
        'DomainReconnaissance' => [
            'SubdomainScan',
            'DnsLookup',
            'WhoIs',
        ],
        'IpAndLocationAnalysis' => [
            'GetIP',
            'GeoLocalization',
        ],
        'PortScanning' => [
            'TcpPortScan',
            'UdpPortScan',
        ],
        'SSLVerifications' => [
            'SslScan',
        ],
    ];

    public function index()
    {
        $this->view([
            'title' => 'Introduction',
            'page' => 'Home',
            'topics' => $this->topics,
        ], 'portal/introduction/indexIntroduction');
    }

    public function about($paramter)
    {
        switch ($paramter) {
            case "index":
                $this->view([
                    'title' => 'About',
                    'page' => 'Introduction',
                ], 'portal/introduction/About');
                break;
            case "Credits":
                $this->view([
                    'title' => 'Credits',
                    'page' => 'Introduction',
                ], 'portal/introduction/About/Credits');
                break;
        }
    }

    public function domainReconnaissance($paramter)
    {
        switch ($paramter) {
            case "index":
                $this->view([
                    'title' => 'Domain Reconnaissance',
                    'page' => 'Introduction',
                ], 'portal/introduction/Domain-Reconnaissance');
                break;
            case "SubdomainScan":
                $this->view([
                    'title' => 'SubdomainScan',
                    'page' => 'Introduction',
                ], 'portal/introduction/Domain-Reconnaissance/SubdomainScan');
                break;
            case "DnsLookup":
                $this->view([
                    'title' => 'DnsLookup',
                    'page' => 'Introduction',
                ], 'portal/introduction/Domain-Reconnaissance/DnsLookup');
                break;
            case "WhoIs":
                $this->view([
                    'title' => 'WhoIs',
                    'page' => 'Introduction',
                ], 'portal/introduction/Domain-Reconnaissance/WhoIs');
                break;
        }
    }

    public function ipAndLocationAnalysis($paramter)
    {
        switch ($paramter) {
            case "index":
                $this->view([
                    'title' => 'IP and Location Analysis',
                    'page' => 'Introduction',
                ], 'portal/introduction/IP-and-Location-Analysis');
                break;
            case "GetIP":
                $this->view([
                    'title' => 'GetIP',
                    'page' => 'Introduction',
                ], 'portal/introduction/IP-and-Location-Analysis/GetIP');
                break;
            case "GeoLocalization":
                $this->view([
                    'title' => 'GeoLocalization',
                    'page' => 'Introduction',
                ], 'portal/introduction/IP-and-Location-Analysis/GeoLocalization');
                break;
        }
    }

    public function portScanning($paramter)
    {
        switch ($paramter) {
            case "index":
                $this->view([
                    'title' => 'Port Scanning',
                    'page' => 'Introduction',
                ], 'portal/introduction/Port-Scanning');
                break;
            case "TcpPortScan":
                $this->view([
                    'title' => 'TcpPortScan',
                    'page' => 'Introduction',
                ], 'portal/introduction/Port-Scanning/TcpPortScan');
                break;
            case "UdpPortScan":
                $this->view([
                    'title' => 'UdpPortScan',
                    'page' => 'Introduction',
                ], 'portal/introduction/Port-Scanning/UdpPortScan');
                break;
        }
    }

    public function sslVerifications($paramter)
    {
        switch ($paramter) {
            case "index":
                $this->view([
                    'title' => 'SSL verifications',
                    'page' => 'Introduction',
                ], 'portal/introduction/SSL-verifications');
                break;
            case "SslScan":
                $this->view([
                    'title' => 'SslScan',
                    'page' => 'Introduction',
                ], 'portal/introduction/SSL-verifications/SslScan');
                break;
        }
    }
}
