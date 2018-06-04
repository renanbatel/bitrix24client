<?php

namespace Batel\Bitrix;

use Batel\Bitrix\Http\BitrixClient;
use Batel\Bitrix\Http\Request;

class Bitrix {

  protected $uri;

  function __construct( $uri ) {

    $this->uri = $uri;
  }

  protected function create( $name ) {

    $class = $this->getClassPath( $name );

    return new $class( $this->getRequest() );
  }

  protected function getClassPath( $name ) {

    return 'Batel\\Bitrix\\Resources\\' . ucfirst( $name );
  }

  protected function getRequest() {

    return new Request( $this->getClient() );
  }

  protected function getClient() {
    
    return new BitrixClient( $this->uri );
  }

  function __get( $name ) {

    return $this->create( $name );
  }
}