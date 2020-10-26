<?php

namespace App\Controller;

use App\Enum\ExceptionName;
use App\Exception\InternalErrorException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ExceptionController extends AbstractController
{
  private LoggerInterface $logger;
  private \Throwable $throwable;

  public function setLogger(LoggerInterface $logger)
  {
    $this->logger = $logger;
  }

  public function setThrowable(\Throwable $throwable) : self
  {
    $this->throwable = $throwable;

    return $this;
  }

  public function process() : self
  {
    $this->log();

    if ($this->getThrowableParentName($this->throwable) != ExceptionName::REQUEST_EXCEPTION)
    {
      $this->notify();
    }

    return $this;
  }

  public function getResponse() : JsonResponse
  {
    /*
    $this->response = new JsonResponse([
      'status' => 500,
      'type' => 'Implementation error',
      'title' => 'ExceptionName handling',
      'detail' => 'ExceptionName handling not implemented, set up error handling at ExceptionController',
    ]);
    */
    return new JsonResponse($this->throwable);
  }

  private function getThrowableParentName(\Throwable $throwable) : string
  {
    try
    {
      return (new \ReflectionClass($throwable))->getParentClass()->getShortName();
    }
    catch (\Error $error)
    {
      $exception = new InternalErrorException();
      $exception->setError($error);

      return $this->getThrowableParentName($exception);
    }
  }

  private function log()
  {
    dump('log');
  }

  private function notify()
  {
    dump('notification');
  }

}
