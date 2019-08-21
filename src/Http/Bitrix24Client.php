<?php

namespace Batel\Bitrix24\Http;

use Batel\Bitrix24\Http\WPClient;
use Batel\Bitrix24\Http\Response;

class Bitrix24Client implements Client
{
  
    protected $client;

    public function __construct($uri)
    {
        $this->client = new WPClient([
        "base_uri"        => $uri,
        ]);
    }

    public function get($url, $args = [])
    {

        return $this->response($this->client->get($url, $args));
    }

    public function post($url, $args = [])
    {

        return $this->response($this->client->post($url, $args));
    }

    protected function response($response)
    {
        $content = json_decode($response[ "body" ]);
        $status  = $response[ "response" ][ "code" ];
        $headers = $response[ "headers" ]->getAll();

        return new Response($status, $content, $headers);
    }
}
