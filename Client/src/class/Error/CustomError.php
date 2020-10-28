<?php

namespace App\Error;

abstract class CustomError extends \Exception
{
    public $message;
    public $statusCode;

    public function __construct(string $message, int $statusCode)
    {
        $this->message = $message;
        $this->statusCode = $statusCode;
    }

    abstract public function getErrors(): string;
}