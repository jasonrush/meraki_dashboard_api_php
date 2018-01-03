<?php

namespace MerakiDashboard;

use MerakiDashboard\Client as ApiClient;

final class Admin extends ApiClient
{
    /**
     * @var dashboard Dashboard instance
     */
    protected $_organization;

    /**
     * @var id Admin name
     */
    public $id;

    /**
     * @var name Admin name
     */
    public $name;

    /**
     * @var name Admin email
     */
    public $email;

    /**
     * @var name Admin orgAccess
     */
    public $orgAccess;

    /**
     * @var name Admin tags
     */
    public $tags;

    /**
     * @var name Admin networks
     */
    public $networks;

    public function __construct( &$organization, $data )
    {
        $this->_organization = &$organization;
        $this->id = $data->id;
        $this->name = $data->name;
        $this->email = $data->email;
        $this->orgAccess = $data->orgAccess;
        $this->tags = $data->tags;
        $this->networks = $data->networks;

        $this->_apiKey = $organization->_apiKey;
        $this->_workaroundURL = $organization->_workaroundURL;
    }

    public function update()
    {
        $result = $this->put(
            '/organizations/' . $this->_organization->id . '/admins/' . $this->id,
            [
                'email' => $this->email,
                'name' => $this->name,
                'orgAccess' => $this->orgAccess,
                'tags' => $this->tags,
                'networks' => $this->networks,
            ]
        );

        if( isset( $result['content_decoded'], $result['content_decoded']['email'] ) ){
            $this->name = $result['content_decoded']['name'];
            $this->orgAccess = $result['content_decoded']['orgAccess'];
            $this->networks = $result['content_decoded']['networks'];
            $this->tags = $result['content_decoded']['tags'];
        }

        return $result;
    }

}