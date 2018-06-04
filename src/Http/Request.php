<?php

namespace Batel\Bitrix\Http;

class Request {

  protected $client;

  protected $resource;

  protected $method;

  function __construct( Client $client ) {

    $this->client = $client;
  }

  protected function handleRequest( $type, $options = array() ) {

    $endpoint = $this->buildEndpoint();
    $args     = $this->buildRequestArgs( $options );

    return $this->client->get( $endpoint, $args );
  }

  protected function buildEndpoint() {

    return "crm.$this->resource.$this->method";
  }

  protected function buildRequestArgs( $options = array() ) {

    return array ( 'query' => $options );
  }

  public function setResource( $resource ) {

    $this->resource = $resource;
  }

  public function setMethod( $method ) {

    $this->method = $method;
  }

  function __call( $name, $args = array() ) {

    if( in_array( $name, array( 'get', 'post' ) ) ) {
        $options = ! empty( $args[ 0 ] ) ? $args[ 0 ] : array();

        return $this->handleRequest( $name, $options );
    }

  }

}