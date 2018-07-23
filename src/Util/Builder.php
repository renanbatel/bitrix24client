<?php

namespace Batel\Bitrix24\Util;

use Illuminate\Support\Str;
use Batel\Bitrix24\Http\Request;
use ReflectionClass;

class Builder {

  public static function getName( $class, $singular = true ) {
    
    $reflectionClass = new ReflectionClass( $class );

    return Str::lower( $singular ? Str::singular( $reflectionClass->getShortName() ) : $reflectionClass->getShortName() );
  }

  public static function getExtension( $name, Request $request ) {
    
    $class = 'Batel\\Bitrix24\\Resources\\Extension\\' . ucfirst( $name );

    return new $class( $request );
  }
}