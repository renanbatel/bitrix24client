<?php

namespace Batel\Bitrix\Http;

class Request {

  protected $client;

  protected $resource;

  protected $method;

  function __construct( Client $client ) {

    $this->client = $client;
  }

  protected function handleRequest( $type, $parameters, $options = array() ) {

    $endpoint = $this->buildEndpoint();
    $args     = $this->buildArgs( $this->getQueryVars( $parameters ), $options );

    return call_user_func_array( array( $this->client, $type ), array( $endpoint, $args ) );
  }

  protected function buildEndpoint() {

    return "crm.$this->resource.$this->method";
  }

  protected function buildArgs( $parameters, $options = array() ) {

    $query = array();
    $args  = array();

    if( $parameters ) {

      foreach( $parameters as $parameter ) {

        $query[ $parameter ] = $options[ $parameter ];
        unset( $options[ $parameter ] );
      }

      $args[ 'query' ] = $query;
    }

    if( ! empty( $options ) ) {

      $args[ 'json' ]  = $options;
    }

    return $args;
  }

  protected function getQueryVars( $parameters ) {

    if( empty( $parameters ) ) {

      return null;
    }
    
    return explode( ',', $parameters );
  }

  public function setResource( $resource ) {

    $this->resource = $resource;
  }

  public function setMethod( $method ) {

    $this->method = $method;
  }

  function __call( $name, $args = array() ) {

    if( in_array( $name, array( 'get', 'post' ) ) ) {

        $options = ! empty( $args[ 1 ] ) ? $args[ 1 ] : array();

        return $this->handleRequest( $name, $args[ 0 ], $options );
    }

  }

}