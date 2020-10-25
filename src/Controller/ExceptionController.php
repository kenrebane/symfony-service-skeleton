<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionController extends AbstractController
{
  private ExceptionEvent $event;
  private Response $response;

  public function setEvent(ExceptionEvent $event) : self
  {
    $this->event = $event;

    return $this;
  }

  public function process() : self
  {
    $this->response = new JsonResponse([
      'status' => 500,
      'type' => 'Implementation error',
      'title' => 'Exception handling',
      'detail' => 'Exception handling not implemented, set up error handling at ExceptionController',
    ]);

    return $this;
  }

  public function getResponse() : Response
  {
    return $this->response;
  }

}
