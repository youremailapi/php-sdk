<?php

namespace Youremailapi\PhpSdk\Exceptions;

use Exception;

/**
 * @author Federico Juretich <fedejuret@gmail.com>
 */
abstract class YouremailapiException extends Exception
{

    private string $customErrorCode;

    public function __construct(string $customErrorCode, string $message, int $code)
    {
        $this->customErrorCode = $customErrorCode;
        parent::__construct($message, $code);
    }

    /**
     * @return string
     */
    public function getCustomErrorCode(): string
    {
        return $this->customErrorCode;
    }
}
