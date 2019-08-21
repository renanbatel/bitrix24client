<?php

namespace Batel\Bitrix24\Resources\Extension;

use Batel\Bitrix24\Resources\Basics\Extension;
use Batel\Bitrix24\Http\Request;
use Batel\Bitrix24\Util\Builder;

class Contact extends Extension
{

    protected function _fields()
    {

        $this->request->setMethod("fields");

        return $this->request->get("");
    }

    protected function _add(array $values)
    {

        $this->request->setMethod("add");

        return $this->request->post($values);
    }

    protected function _delete(array $values)
    {

        $this->request->setMethod("delete");

        return $this->request->post($values);
    }

    public function __get($name)
    {

        if (in_array($name, [ "items" ])) {
            return Builder::getExtension($name, $this->request);
        } else {
            throw new Bitrix24Exception("Invalid Resource");
        }
    }
}
