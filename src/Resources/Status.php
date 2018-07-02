<?php

namespace Batel\Bitrix24\Resources;

use Batel\Bitrix24\Resources\Basics\Entity;
use Batel\Bitrix24\Exception\Bitrix24Exception;

class Status extends Entity {

  function __get( $name ) {

    if( in_array( $name, [ 'entity' ] ) ) {

      return $this->create( $name );
    } else {
      
      throw new Bitrix24Exception( 'Invalid Resource' );
    }
  }
}