<?php

namespace Batel\Bitrix24\Resources\Basics;

use Batel\Bitrix24\Http\Request;
use Batel\Bitrix24\Util\Builder;

abstract class Resource {

  protected $request;
  protected $builder;

  function __construct( Request $request ) {

    $request->setResource( Builder::getName( $this ) );
    
    $this->request = $request;
  }

  protected function _add( array $values ) {

    $this->request->setMethod( 'add' );

    return $this->request->post( $values );
  }

  protected function _get( array $values ) {

    $this->request->setMethod( 'get' );
    
    return $this->request->get( $values );
  }

  protected function _update( array $values ) {

    $this->request->setMethod( 'update' );

    return $this->request->post( $values );
  }

  protected function _delete( array $values ) {

    $this->request->setMethod( 'delete' );

    return $this->request->post( $values );
  }

  protected function _list( array $values ) {

    $this->request->setMethod( 'list' );

    return $this->request->get( $values );
  }

  function __call( $name, $arguments ) {

    $options = ! empty( $arguments[ 0 ] ) ? $arguments[ 0 ] : [];

    return call_user_func_array( [ $this, '_' . $name ], [ $options ] );
  }
}