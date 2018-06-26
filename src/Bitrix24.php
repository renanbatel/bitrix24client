<?php

namespace Batel\Bitrix24;

use Batel\Bitrix24\Http\Bitrix24Client;
use Batel\Bitrix24\Http\Request;

class Bitrix24 {

  protected $uri;

  function __construct( $params ) {

    $uri   = $params[ 'uri' ];
    $user  = $params[ 'user' ];
    $token = $params[ 'token' ];

    $this->uri = "$uri/rest/$user/$token/";
  }

  protected function create( $name ) {

    $class = $this->getClassPath( $name );

    return new $class( $this->getRequest() );
  }

  protected function getClassPath( $name ) {

    return 'Batel\\Bitrix24\\Resources\\' . ucfirst( $name );
  }

  protected function getRequest() {

    return new Request( $this->getClient() );
  }

  protected function getClient() {
    
    return new Bitrix24Client( $this->uri );
  }

  function __get( $name ) {

    return $this->create( $name );
  }
}