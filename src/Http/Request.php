<?php

namespace Batel\Bitrix24\Http;

class Request {

  protected $client;

  protected $resource;

  protected $method;

  function __construct( Client $client ) {

    $this->client = $client;
  }

  protected function handleRequest( $type, $parameters, $options = array() ) {

    $endpoint = $this->buildEndpoint();
    $args     = $this->buildArgs( $type, $this->getQueryVars( $parameters ), $options );
    // return $args;
    return call_user_func_array( [ $this->client, $type ], [ $endpoint, $args ] );
  }

  protected function buildEndpoint() {

    return "crm.$this->resource.$this->method";
  }

  protected function buildArgs( $type, $parameters, $options = [] ) {

    $query = [];
    $args  = [];

    if( $parameters ) {

      foreach( $parameters as $parameter ) {

        $query[ $parameter ] = $options[ $parameter ];
        unset( $options[ $parameter ] );
      }

      isset( $args[ 'query' ] ) ? array_merge( $args[ 'query' ], $query ) : $args[ 'query' ] = $query;
    }

    if( ! empty( $options ) ) {

      if( $type == 'get' )
        isset( $args[ 'query' ] ) ? array_merge( $args[ 'query' ], $options ) : $args[ 'query' ] = $options;
      else if( $type == 'post' )
        isset( $args[ 'json' ] ) ? array_merge( $args[ 'json' ], $options ) : $args[ 'json' ] = $options;
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