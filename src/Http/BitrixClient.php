<?php

namespace Batel\Bitrix\Http;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request as GuzzleRequest; 

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

    return json_decode( $this->client->get( 'crm.lead.get?id=1' )->getBody() );
  }

  public function post( $url, $parameters = array() ) {
    
  }

  protected function execute( GuzzleRequest $request, $options = array() ) {

    
  }

}