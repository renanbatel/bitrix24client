<?php

namespace Batel\Bitrix24\Resources\Basics;

use Batel\Bitrix24\Http\Request;
use Batel\Bitrix24\Util\Builder;

abstract class Extension {
  
  protected $request;

  function __construct( Request $request ) {

    $request->addResource( Builder::getName( $this, false ) );

    $this->request = $request;
  }

  function __call( $name, $arguments ) {

    $options = ! empty( $arguments[ 0 ] ) ? $arguments[ 0 ] : [];

    return call_user_func_array( [ $this, '_' . $name ], [ $options ] );
  }
}