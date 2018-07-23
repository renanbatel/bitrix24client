<?php

namespace Batel\Bitrix24\Resources;

use Batel\Bitrix24\Resources\Basics\Entity;
use Batel\Bitrix24\Exception\Bitrix24Exception;
use Batel\Bitrix24\Util\Builder;

class Status extends Entity {

  function __get( $name ) {

    if( in_array( $name, [ 'entity' ] ) ) {

      return Builder::getExtension( $name, $this->request );
    } else {
      
      throw new Bitrix24Exception( 'Invalid Resource' );
    }
  }
}