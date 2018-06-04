<?php

namespace Batel\Bitrix\Resources\Basics;

use Batel\Bitrix\Http\Request;
use Illuminate\Support\Str;
use ReflectionClass;

abstract class Resource {

  protected $request;

  function __construct( Request $request ) {

    $request->setResource( $this->getName() );
    
    $this->request = $request;
  }

  public function get( $id ) {

    $this->request->setMethod( 'get' );
    
    return $this->request->get( compact( 'id' ) );
  }

  public function add( array $values ) {

  }

  public function getName() {
    
    $reflectionClass = new ReflectionClass( $this );

    return Str::lower( Str::singular( $reflectionClass->getShortName() ) );
  }

}