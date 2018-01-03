<?php

namespace MerakiDashboard;

use MerakiDashboard\Client as ApiClient;

final class ConfigTemplate extends ApiClient
{
    /**
     * @var dashboard Dashboard instance
     */
    protected $_dashboard;

    /**
     * @var id ConfigTemplate name
     */
    public $id;

    /**
     * @var name ConfigTemplate name
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

}