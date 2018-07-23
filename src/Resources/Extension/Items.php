<?php

namespace Batel\Bitrix24\Resources\Extension;

use Batel\Bitrix24\Resources\Basics\Extension;
use Batel\Bitrix24\Http\Request;
use Batel\Bitrix24\Util\Builder;

class Items extends Extension {

  protected function _get( array $values ) {

    $this->request->setMethod( 'get' );

    return $this->request->get( $values );
  }

  protected function _set( array $values ) {

    $this->request->setMethod( 'set' );

    return $this->request->post( $values );
  }

  protected function _delete( array $values ) {

    $this->request->setMethod( 'delete' );

    return $this->request->post( $values );
  }
  
}
