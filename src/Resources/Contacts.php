<?php

namespace Batel\Bitrix24\Resources;

use Batel\Bitrix24\Resources\Basics\Entity;
use Batel\Bitrix24\Util\Builder;

class Contacts extends Entity {
  
  function __get( $name ) {

    if( in_array( $name, [] ) ) {

      return Builder::getExtension( $name, $this->request );
    } else {
      
      throw new Bitrix24Exception( 'Invalid Resource' );
    }
  }
}