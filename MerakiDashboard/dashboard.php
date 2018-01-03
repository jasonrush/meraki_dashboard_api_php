<?php

namespace MerakiDashboard;

use MerakiDashboard\Client as ApiClient;
use MerakiDashboard\Organization as ApiOrganization;
use MerakiDashboard\Network as ApiNetwork;

final class Dashboard extends ApiClient
{

    public function get_organizations()
    {
        $request_data = $this->_request( 'GET', 'organizations' );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        $orgs_objects = array();

        foreach( $request_data['content_decoded'] as $org_data ){
            $org = New ApiOrganization( $this, $org_data );
            $orgs_objects[] = $org;
        }

        return $orgs_objects;
    }

    public function get_organization( $id )
    {
        $request_data = $this->_request( 'GET', 'organizations/'.$id );

        if( 200 != $request_data['http_code'] ){
            return false;
        }
        return New ApiOrganization( $this, $request_data['content_decoded'] );
    }

    public function get_network( $id )
    {
        $request_data = $this->get( 'networks/'.$id );

        if( 200 != $request_data['http_code'] ){
            return false;
        }

        $return_objects = array();


        return New ApiNetwork( $this, $request_data['content_decoded'] );
    }

}
