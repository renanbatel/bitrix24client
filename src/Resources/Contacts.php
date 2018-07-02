<?php

namespace Batel\Bitrix24\Resources;

use Batel\Bitrix24\Resources\Basics\Entity;

class Contacts extends Entity {
  
  function __get( $name ) {

    if( in_array( $name, [] ) ) {

      return $this->create( $name );
    } else {
      
      throw new Bitrix24Exception( 'Invalid Resource' );
    }
  }
}