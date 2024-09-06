<?php

namespace Mohammedmanssour\TrattaLaravelSdk\Exceptions;

class ApiRequestException extends \Exception
{
    public function __construct(string $context, string $error, ?string $errorCode)
    {
        $message = "API Request \"{$context}\" has failed with error \"{$error}\"";
        if ($errorCode) {
            $message .= " and errorCode \"{$errorCode}\"";
        }
        parent::__construct($message);
    }
}
