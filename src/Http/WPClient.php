<?php

namespace Batel\Bitrix24\Http;

use WP_Http;

class WPClient
{

    protected $http;
    protected $baseUri;

    public function __construct($options)
    {
        $this->http    = new WP_Http();
        $this->baseUri = $options[ "base_uri" ];
    }

    public function get($endpoint, $args = [])
    {
        $query = isset($args[ "query" ])
        ? build_query($args[ "query" ])
        : "";

        return $this->http->get("{$this->baseUri}{$endpoint}?{$query}");
    }

    public function post($endpoint, $args = [])
    {
        $body = isset($args[ "json" ])
        ? $args[ "json" ]
        : null;
    
        return $this->http->post("{$this->baseUri}{$endpoint}", compact(
            "body"
        ));
    }
}
