<?php

namespace App\Error;

class RequestValidationError extends CustomError
{
  public $message;
  public function __construct(string $message)
  {
    $this->message = $message;
  }

  public function getErrors(): string
  {
    return "bla";
  }
}