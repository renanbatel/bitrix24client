<?php

namespace Batel\Bitrix\Http;

class Response {

  protected $statusCode;

  protected $content;

  protected $headers;

  function __construct( $statusCode, $content, $headers = array() ) {

    $this->statusCode = $statusCode;
    $this->content    = $content;
    $this->headers    = $headers;
  }

  public function getContent() {

    return $this->content;
  }
}