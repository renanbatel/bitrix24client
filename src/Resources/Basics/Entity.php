<?php

namespace Batel\Bitrix24\Resources\Basics;

abstract class Entity extends Resource {
  
  protected function create( $name ) {

    $class = $this->getClassPath( $name );

    return new $class( $this->request );
  }

  protected function getClassPath( $name ) {

    return 'Batel\\Bitrix24\\Resources\\Extension\\' . ucfirst( $name );
  }
  
}