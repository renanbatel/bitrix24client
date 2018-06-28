<?php

namespace Batel\Bitrix24\Resources\Extension;

use Batel\Bitrix24\Http\Request;
use Batel\Bitrix24\Util\Builder;

class Entity {

  protected $request;

  function __construct( Request $request ) {

    $request->addResource( Builder::getName( $this ) );

    $this->request = $request;
  }

  protected function _items( array $values ) {

    $this->request->setMethod( 'items' );

    return $this->request->get( $values );
  }

  protected function _types() {

    $this->request->setMethod( 'types' );

    return $this->request->get( '' );
  }

  function __call( $name, $arguments ) {

    $options = ! empty( $arguments[ 0 ] ) ? $arguments[ 0 ] : [];

    return call_user_func_array( [ $this, '_' . $name ], [ $options ] );
  }
}