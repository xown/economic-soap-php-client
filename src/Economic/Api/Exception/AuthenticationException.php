<?php


namespace Economic\Api\Exception;


use Exception;

class AuthenticationException extends EconomicException
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
