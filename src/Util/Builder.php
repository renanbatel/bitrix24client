<?php

namespace Batel\Bitrix24\Util;

use Batel\Bitrix24\Http\Request;
use ReflectionClass;

class Builder
{

    public static function getSingular($name)
    {
        $lower = strtolower($name);
        $names = [
        "companies" => "company",
        "contacts" => "contact",
        "deals" => "deal",
        "leads" => "lead",
        "status" => "status",
        "entities" => "entity",
        "items" => "item"
        ];

        return isset($names[ $lower ])
        ? $names[ $lower ]
        : $name;
    }

    public static function getName($class, $singular = true)
    {
    
        $reflectionClass = new ReflectionClass($class);

        return strtolower(
            $singular
            ? Builder::getSingular($reflectionClass->getShortName())
            : $reflectionClass->getShortName()
        );
    }

    public static function getExtension($name, Request $request)
    {
    
        $class = "Batel\\Bitrix24\\Resources\\Extension\\" . ucfirst($name);

        return new $class($request);
    }
}
