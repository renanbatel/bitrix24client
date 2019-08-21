<?php

namespace Batel\Bitrix24\Http;

interface Client
{

    public function get($url, $parameters = []);

    public function post($url, $parameters = []);
}
