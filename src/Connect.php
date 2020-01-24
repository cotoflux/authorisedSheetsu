<?php

namespace Sheetsu;
use Curl\Curl;

class Connect
{
    private $http;


    public function makeCall()
    {

            
            $ch = curl_init("https://jsonplaceholder.typicode.com/");
            echo($ch);
    
    }
    public function setConfig(array $config)
    {
        $this->config = array_merge($config, $this->config);
    }
    public function getConfig()
    {
        return $this->config;
    }
}