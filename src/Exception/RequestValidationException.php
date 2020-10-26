<?php

namespace App\Exception;

use App\Enum\ExceptionDetail;
use App\Response\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RequestValidationException extends RequestException implements ExceptionInterface, ResponseInterface
{
  public function __construct($message = ExceptionDetail::VALIDATION,
                              $status = Response::HTTP_BAD_REQUEST,
                              $previous = null)
  {
    parent::__construct($message, $status, $previous);
  }

  public function getResponseData()
  {
    // TODO: Implement getResponseData() method.
  }
}