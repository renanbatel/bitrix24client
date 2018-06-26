<?php

namespace Batel\Bitrix24\Resources\Basics;

use Batel\Bitrix24\Http\Request;
use Illuminate\Support\Str;
use ReflectionClass;

abstract class Resource {

  protected $request;

  function __construct( Request $request ) {

    $request->setResource( $this->getName() );
    
    $this->request = $request;
  }

  private function _add( array $values ) {

    $this->request->setMethod( 'add' );

    return $this->request->post( '', $values );
  }

  private function _get( $id ) {

    $this->request->setMethod( 'get' );
    
    return $this->request->get( 'id', compact( 'id' ) );
  }

  private function _list( array $values ) {

    $this->request->setMethod( 'list' );

    return $this->request->get( '', $values );
  }

  public function getName() {
    
    $reflectionClass = new ReflectionClass( $this );

    return Str::lower( Str::singular( $reflectionClass->getShortName() ) );
  }

  function __call( $name, $arguments ) {

    $options = ! empty( $arguments[ 0 ] ) ? $arguments[ 0 ] : [];

    return call_user_func_array( [ $this, '_' . $name ], [ $options ] );
  }
}