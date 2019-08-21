<?php

namespace Batel\Bitrix24\Resources\Extension;

use Batel\Bitrix24\Resources\Basics\Extension;
use Batel\Bitrix24\Http\Request;
use Batel\Bitrix24\Util\Builder;

class Entity extends Extension
{

    protected function _items(array $values)
    {

        $this->request->setMethod("items");

        return $this->request->get($values);
    }

    protected function _types()
    {

        $this->request->setMethod("types");

        return $this->request->get("");
    }
}
