<?php

namespace app\controllers\tools;

use app\controllers\ContainerController;
use app\models\tools\GeoLocalization;
use app\models\tools\SubdomainScan;
use app\models\tools\GetIP;
use app\models\tools\TcpPortScan;
use app\models\tools\UdpPortScan;
use app\models\tools\WhoIs;
use app\models\tools\DnsLookup;
use app\models\tools\SslScan;

class ToolsController extends ContainerController {

    private $tools = [
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
        'SslVerifications' => [
            'SslScan',
        ],
    ];
    
    public function index() {
        $this->view([
            'title' => 'Tools',
            'page' => 'Home',
            'tools' => $this->tools
        ], 'tools/indexTools');
    }

    public function subdomainScan() {
        $url = "";
        if(isset($_POST['domain'])) $url = $_POST['domain'];
        $this->view([
            'title' => 'SubdomainScan',
            'page' => 'Tools',
            'urls' => SubdomainScan::result($url)
        ], 'tools/SubdomainScan');
    }

    public function whoIs() {
        $domains = [];
        if(isset($_POST['domains'])) $domains = $_POST['domains'];
        
        $this->view([
            'title' => 'WhoIs',
            'page' => 'Tools',
            'results' => WhoIs::result($domains)
        ], 'tools/WhoIs');
    }

    public function DnsLookup() {
        if(isset($_POST['Host'])) $domain = $_POST['Host'];
        
        $this->view([
            'title' => 'DnsLookup',
            'page' => 'Tools',
            'results' => DnsLookup::result($domain)
        ], 'tools/DnsLookup');
    }

    public function getIP() {
        $urls = [];
        if(isset($_POST['urls'])) $urls = $_POST['urls'];

        $this->view([
            'title' => 'GetIP',
            'page' => 'Tools',
            'urls' => $urls,
            'ips' => GetIP::result($urls),
        ], 'tools/getIP');
    }

    public function tcpPortScan() {
        $urls = [];
        if(isset($_POST['urls'])) $urls = $_POST['urls'];
        
        $ips = [];
        if(isset($_POST['ips'])) $ips = $_POST['ips'];

        $this->view([
            'title' => 'TcpPortScan',
            'page' => 'Tools',
            'urls' => $urls,
            'ips' => $ips,
            'ports' => TcpPortScan::result($ips),
        ], 'tools/TcpPortScan');
    }

    public function udpPortScan() {
        $urls = [];
        if(isset($_POST['urls'])) $urls = $_POST['urls'];
        
        $ips = [];
        if(isset($_POST['ips'])) $ips = $_POST['ips'];

        $this->view([
            'title' => 'UdpPortScan',
            'page' => 'Tools',
            'urls' => $urls,
            'ips' => $ips,
            'ports' => UdpPortScan::result($ips),
        ], 'tools/UdpPortScan');
    }

    public function geoLocalization() {
        $urls = [];
        if(isset($_POST['urls'])) $urls = $_POST['urls'];

        $ips = [];
        if(isset($_POST['ips'])) $ips = $_POST['ips'];

        $this->view([
            'title' => 'GeoLocalization',
            'page' => 'Tools',
            'urls' => $urls,
            'ips' => $ips,
            'results' => GeoLocalization::result($ips),
        ], 'tools/GeoLocalization');
    }

    public function SslScan() {
        if(isset($_POST['Host'])) $domain = $_POST['Host'];

        $this->view([
            'title' => 'SslScan',
            'page' => 'Tools',
            'results' => SslScan::result($domain)
        ], 'tools/SslScan');
    }
}