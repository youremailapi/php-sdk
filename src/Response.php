<?php

namespace Youremailapi\PhpSdk;

/**
 * @author Federico Juretich <fedejuret@gmail.com>
 */
class Response
{

    private int $code;
    private $data;

    public function __construct(int $code, $data)
    {
        $this->code = $code;
        $this->data = $data;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getData($array = false)
    {
        return $array ? json_decode($this->data, true) : json_decode($this->data);
    }
}
