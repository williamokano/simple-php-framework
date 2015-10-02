<?php

namespace App;

/**
 * Handle the request data
 */
class Request
{
    private $request_data;
    private $read_only_keys = array();
    private $headers = array();

    public function __construct(array $server)
    {
        $this->request_data = new \stdClass();
        foreach ($server as $key => $value) {
            $this->request_data->{$key} = $value;
            $this->read_only_keys[] = $key;
        }
    }

    public function sendHeaders()
    {
        foreach ($this->headers as $header => $value) {
            header(sprintf("%s: %s", $header, $value));
        }
    }

    public function setHeader($header, $value)
    {
        $this->headers[$header] = $value;
    }

    public function __get($name)
    {
        if (property_exists($this->request_data, $name)) {
            return $this->request_data->$name;
        }
    }

    public function __set($name, $value)
    {
        if (!in_array($this->read_only_keys)) {
            $this->request_data->$name = $value;
        }
    }
}
