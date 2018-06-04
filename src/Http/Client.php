<?php

namespace Batel\Bitrix\Http;

interface Client {

  public function get( $url, $parameters = array() );

  public function post( $url, $parameters = array() );

}