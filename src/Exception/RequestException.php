<?php

namespace App\Exception;

use App\Enum\ExceptionDetail;
use Symfony\Component\HttpFoundation\Response;

class RequestException extends \Exception
{
  protected string $type;

  public function __construct($message = ExceptionDetail::CHECK_DOC, $status = Response::HTTP_BAD_REQUEST, $previous = null)
  {
    parent::__construct($message, $status, $previous);
    $this->type = Response::$statusTexts[$status];
  }

  public function getType()
  {
    return $this->type;
  }
}