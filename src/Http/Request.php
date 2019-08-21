<?php

namespace Batel\Bitrix24\Http;

class Request
{

    protected $client;

    protected $resource;

    protected $method;

    public function __construct(Client $client)
    {

        $this->client = $client;
    }

    protected function handleRequest($type, $options = [])
    {
        $endpoint = $this->buildEndpoint();
        $args     = $this->buildArgs($type, $options);

        return call_user_func_array([ $this->client, $type ], [ $endpoint, $args ]);
    }

    protected function buildEndpoint()
    {
        return "crm.$this->resource.$this->method";
    }

    protected function buildArgs($type, $options = [])
    {
        $args  = [];

        if (! empty($options)) {
            switch ($type) {
                case "get":
                    isset($args[ "query" ]) ? array_merge($args[ "query" ], $options) : $args[ "query" ] = $options;
                    break;
                case "post":
                    isset($args[ "json" ]) ? array_merge($args[ "json" ], $options) : $args[ "json" ] = $options;
                    break;
                default:
            }
        }

        return $args;
    }

  // protected function getQueryVars( $parameters ) {

  //   if( empty( $parameters ) ) {

  //     return null;
  //   }
    
  //   return explode( ",", $parameters );
  // }

    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    public function addResource($resource)
    {
        $this->resource .= "." . $resource;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function __call($name, $args = [])
    {
        if (in_array($name, [ "get", "post" ])) {
            $options = ! empty($args[ 0 ]) ? $args[ 0 ] : [];

            return $this->handleRequest($name, $options);
        }
    }
}
