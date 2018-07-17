<?php

namespace MerakiDashboard;

use MerakiDashboard\Client as ApiClient;

final class Network extends ApiClient
{
    /**
     * @var dashboard Dashboard instance
     */
    protected $_dashboard;

    /**
     * @var id Network name
     */
    public $id;

    /**
     * @var name Network name
     */
    public $name;

    /**
     * @var timeZone Network timeZone
     */
    public $timeZone;

    /**
     * @var tags Network tags
     */
    public $tags;

    /**
     * @var type Network type
     */
    public $type;

    public function __construct( &$dashboard, $data )
    {
        $this->_dashboard = &$dashboard;
        $this->id = $data->id;
        $this->name = $data->name;
        $this->timeZone = $data->timeZone;
        $this->tags = $data->tags;
        $this->type = $data->type;
//     'organizationId' => '135825',

        $this->_apiKey = $dashboard->_apiKey;
        $this->_workaroundURL = $dashboard->_workaroundURL;
    }

    public function get_devices()
    {
        $request_data = $this->_dashboard->get( 'networks/'.$this->id.'/devices' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        return $request_data['content_decoded'];
    }

    public function get_device( $serial )
    {
        $request_data = $this->_dashboard->get( 'networks/'.$this->id.'/devices/'.$serial );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        return $request_data['content_decoded'];
    }

    public function get_cellularFirewallRules()
    {
        $request_data = $this->_dashboard->get( 'networks/'.$this->id.'/cellularFirewallRules' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        return $request_data['content_decoded'];
    }

    public function get_l3FirewallRules()
    {
        $request_data = $this->_dashboard->get( 'networks/'.$this->id.'/l3FirewallRules' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        return $request_data['content_decoded'];
    }

    public function set_l3FirewallRules( $rules )
    {
        $result = $this->put(
            'networks/'.$this->id.'/l3FirewallRules',
            $rules
        );

        if( isset( $result['content_decoded'] ) && is_array( $result['content_decoded'] ) ){
            return true;
        }

        return false;
    }

    public function get_groupPolicies()
    {
        $request_data = $this->_dashboard->get( 'networks/'.$this->id.'/groupPolicies' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        return $request_data['content_decoded'];
    }

    public function get_siteToSiteVpn()
    {
        $request_data = $this->_dashboard->get( 'networks/'.$this->id.'/siteToSiteVpn' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        return $request_data['content_decoded'];
    }

    public function get_traffic()
    {
        $request_data = $this->_dashboard->get( 'networks/'.$this->id.'/traffic' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        return $request_data['content_decoded'];
    }

    public function get_accessPolicies()
    {
        $request_data = $this->_dashboard->get( 'networks/'.$this->id.'/accessPolicies' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        return $request_data['content_decoded'];
    }

    public function get_airMarshal()
    {
        $request_data = $this->_dashboard->get( 'networks/'.$this->id.'/airMarshal' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        return $request_data['content_decoded'];
    }

    public function get_bluetoothSettings()
    {
        $request_data = $this->_dashboard->get( 'networks/'.$this->id.'/bluetoothSettings' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        return $request_data['content_decoded'];
    }

    public function get_phoneContacts()
    {
        $request_data = $this->_dashboard->get( 'networks/'.$this->id.'/phoneContacts' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        return $request_data['content_decoded'];
    }

}