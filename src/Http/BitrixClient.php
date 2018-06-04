<?php

namespace Batel\Bitrix\Http;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Batel\Bitrix\Http\Response;

class BitrixClient implements Client {
  
  protected $client;

  function __construct( $uri ) {

    $this->client = new GuzzleClient( array (
      'base_uri'        => $uri,
      'allow_redirects' => false,
      'verify'          => false
    ) );
  }

  public function get( $url, $parameters = array() ) {

    return $this->response( $this->client->get( $url, $parameters ) );
  }

  public function post( $url, $parameters = array() ) {

    return $this->response( $this->client->post( $url, $parameters ) );
  }

  protected function response( $response ) {

    $content = json_decode( $response->getBody() );

    return new Response( $response->getStatusCode(), $content, $response->getHeaders() );
  }

}