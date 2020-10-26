<?php

namespace App\Exception;

use App\Response\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class InternalErrorException extends \Exception implements ExceptionInterface, ResponseInterface
{
  private \Error $error;
  public int $status;
  public string $type;
  public $detail;

  public function __construct($message = null, $status = Response::HTTP_INTERNAL_SERVER_ERROR, $previous = null)
  {
    $this->status = $status;
    $this->type = Response::$statusTexts[$status];

    if ($message == null)
    {
      $this->detail = 'check documentation for contacts';
    }
    else
    {
      $this->detail = $message;
    }


    parent::__construct($message, $status, $previous);
  }

  public function setError(\Error $error)
  {
    $this->error = $error;
  }

  public function getLogContent()
  {
    // TODO: Implement getLogContent() method.
  }

  public function getNotificationContent()
  {
    // TODO: Implement getNotificationContent() method.
  }

  public function getResponseData()
  {
    // TODO: Implement getResponseData() method.
  }
}