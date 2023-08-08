<?php

namespace Youremailapi\PhpSdk\Exceptions;

use Youremailapi\PhpSdk\Exceptions\YouremailapiException;

/**
 * @author Federico Juretich <fedejuret@gmail.com>
 */
class FileNotFoundException extends YouremailapiException
{

    public function __construct(?string $message = null)
    {
        parent::__construct('FILE_NOT_FOUND', $message ?? 'File not found', 0);
    }
}
