<?php

namespace App\Exceptions;

use Exception;

class InvalidUserException extends Exception
{
    public function __construct($message = 'Invalid User', $code = 403)
    {
        parent::__construct($message, $code);
    }
}
