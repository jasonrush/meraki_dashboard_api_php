<?php

namespace MerakiDashboard;

use MerakiDashboard\Client as ApiClient;
use MerakiDashboard\Network as ApiNetwork;
use MerakiDashboard\ConfigTemplate as ApiConfigTemplate;
use MerakiDashboard\Admin as ApiAdmin;

final class Organization extends ApiClient
{
    /**
     * @var dashboard Dashboard instance
     */
    protected $_dashboard;
    
    /**
     * @var id Organization name
     */
    public $id;
    
    /**
     * @var name Organization name
     */
    public $name;
    
    public function __construct( &$dashboard, $data )
    {
        $this->_dashboard = &$dashboard;
        $this->id = $data->id;
        $this->name = $data->name;

        $this->_apiKey = $dashboard->_apiKey;
        $this->_workaroundURL = $dashboard->_workaroundURL;
    }

    public function get_networks()
    {
        $request_data = $this->get( 'organizations/'.$this->id.'/networks' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }

        $return_objects = array();

        foreach( $request_data['content_decoded'] as $data ){
            $return_objects[] = New ApiNetwork( $this->_dashboard, $data );
        }

        return $return_objects;
    }

    public function get_configTemplates()
    {
        $request_data = $this->_dashboard->get( 'organizations/'.$this->id.'/configTemplates' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        $return_objects = array();

        foreach( $request_data['content_decoded'] as $data ){
            $return_objects[] = New ApiConfigTemplate( $this, $data );
        }

        return $return_objects;
    }

    public function get_vpnFirewallRules()
    {
        $request_data = $this->_dashboard->get( 'GET', 'organizations/'.$this->id.'/vpnFirewallRules' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }

        return $request_data['content_decoded'];
    }

    public function get_admins()
    {
        $request_data = $this->_dashboard->get( 'organizations/'.$this->id.'/admins' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        $return_objects = array();

        foreach( $request_data['content_decoded'] as $data ){
            $return_objects[] = New ApiAdmin( $this, $data );
        }

        return $return_objects;
    }

    public function get_licenseState()
    {
        $request_data = $this->_dashboard->get( 'organizations/'.$this->id.'/licenseState' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        return $request_data['content_decoded'];
    }

    public function get_inventory()
    {
        $request_data = $this->_dashboard->get( 'organizations/'.$this->id.'/inventory' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        return $request_data['content_decoded'];
    }

    public function get_snmp_settings()
    {
        $request_data = $this->_dashboard->get( 'organizations/'.$this->id.'/snmp' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        return $request_data['content_decoded'];
    }

    public function get_thirdPartyVPNPeers()
    {
        $request_data = $this->_dashboard->get( 'organizations/'.$this->id.'/thirdPartyVPNPeers' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        return $request_data['content_decoded'];
    }

}