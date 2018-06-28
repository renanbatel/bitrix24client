<?php

namespace Batel\Bitrix24\Util;

use Illuminate\Support\Str;
use ReflectionClass;

class Builder {

  public static function getName( $class ) {
    
    $reflectionClass = new ReflectionClass( $class );

    return Str::lower( Str::singular( $reflectionClass->getShortName() ) );
  }
}