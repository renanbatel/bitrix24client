<?php

namespace Batel\Bitrix24\Http;

class Response
{

    protected $statusCode;

    protected $content;

    protected $headers;

    public function __construct($statusCode, $content, $headers = [])
    {

        $this->statusCode = $statusCode;
        $this->content    = $content;
        $this->headers    = $headers;
    }

    public function isSuccess()
    {

        if (! empty($this->getStatusCode()) && $this->getStatusCode() == 200 && ! empty($this->getContent())) {
            return true;
        }
    
        return false;
    }

    public function getStatusCode()
    {

        return $this->statusCode;
    }

    public function getContent()
    {

        return $this->content;
    }

    public function getHeaders()
    {

        return $this->headers;
    }
}
