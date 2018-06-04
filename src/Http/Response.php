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

  public function getStatusCode() {

    return $this->statusCode;
  }

  public function isSuccess() {

    if( ! empty( $this->getStatusCode() ) && $this->getStatusCode() == 200 && ! empty( $this->getContent() ) ) {

      return true;
    }
    
    return false;
  }
}