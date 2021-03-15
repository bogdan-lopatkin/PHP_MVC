<?php

namespace Core;

class Request
{
    private $data;
    private $server;

    public function __construct(array $params = [])
    {
        $this->data = array_merge($params['data'], $_POST, $_GET);
        $this->server = $_SERVER;
    }

    public function __get($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }

        if ((isset($this->server[$name]))) {
            return $this->server[$name];
        }

        return null;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
