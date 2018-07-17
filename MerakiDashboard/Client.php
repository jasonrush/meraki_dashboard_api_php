<?php

namespace MerakiDashboard;

class Client
{
    /**
     * @var apiKey Dashboard API key
     */
    protected $_apiKey;

    /**
     * @var workaroundURL Listing orgs via default URL may give wrong redirect and/or 404
     *      if api acct doesn't have full admin on all orgs the account has access to
     *      per Meraki Support
     */
    protected $_workaroundURL;


    public function __construct( $apiKey, $workaroundURL = "https://n120.meraki.com/api/v0/" )
    {
        $this->_apiKey = $apiKey;
        $this->_workaroundURL = $workaroundURL;
    }

    protected function _request($requestMethod, $page, $data = array())
    {
        $headers = array();
        $headers[] = 'X-Cisco-Meraki-API-Key: '.$this->_apiKey;
        $headers[] = 'Content-Type: application/json';

        $url = "https://dashboard.meraki.com/api/v0/$page";

        if( "organizations" == $page ){
            // Work around. Listing orgs via default URL may give wrong redirect and/or 404
            // if api acct doesn't have full admin on all orgs the account has access to
            $url = $this->_workaroundURL . $page;
        }

        $curl = curl_init(); 

        switch( strtoupper( $requestMethod ) ){
            case 'PUT':
                $data_json = json_encode( $data );
    
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data_json);
                $headers[] = "Content-Length: " . strlen($data_json);
                break;
            case 'POST':
                $data_json = json_encode( $data );
    
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS,$data_json);
                break;
            case 'DELETE':
                $data_json = json_encode( $data );
    
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data_json);
                break;
            default:
                break;
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // return the results instead of outputting it
        curl_setopt($curl, CURLOPT_URL, $url );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        // Don't verify SSL
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);
        return array(
            "http_code" => intval( curl_getinfo($curl, CURLINFO_HTTP_CODE) ),
            "content" => $result,
            "content_decoded" => json_decode($result),
            "request_headers" => $headers,
            "request_url" => $url,
        );
    }

    public function get($page, $data = array())
    {
        return $this->_request( 'GET', $page, $data);
    }

    public function put($page, $data = array())
    {
        return $this->_request( 'PUT', $page, $data);
    }

}
