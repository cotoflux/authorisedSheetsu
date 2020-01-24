<?php

namespace Sheetsu;
use Curl\Curl;
use \Sheetsu\Interfaces\ConnectionInterface;
class Connection implements ConnectionInterface
{
    private $http;
    private $config;
    function __construct($config = array())
    {
        $this->config = $config;
        $this->http = new Curl();

    }
    /**
     * This public function prepares the query parameters, sets the final url, checks for json headers and adds parameters as json string.
     * Then, it uses Curl for making the call and returns a Response object.
     * @return Response
     */
    public function makeCall()
    {
        if ($this->_isValidCall()) {
            $method = $this->config['method'];
            if ($this->_hasLimit()) {
                $this->_prepareLimitInQueryParams();
            }
            if ($this->_hasIgnoreCase()) {
                $this->_prepareIgnoreCaseInQueryParams();
            }
            if ($this->_hasConditions()) {
                $this->_prepareConditionsInQueryParams();
            }
            if ($this->_hasQueryParams()) {
                $this->_prepareUrlForCall();
            }
            if ($this->_needsJsonHeaders()) {
                $this->_setJsonHeaders();
            }
            $this->_setParametersInConfig();
            $this->http->$method(
                $this->config['url'],
                $this->config['params'],
                true
            );
            return $this->_createResponse($this->http);
        }
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