<?php

namespace App\EventSubscriber;

use App\Controller\ExceptionController;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
  private ?Request $request;
  private ExceptionController $controller;

  public function __construct(RequestStack $requestStack, ExceptionController $controller, LoggerInterface $logger)
  {
    $this->request = $requestStack->getCurrentRequest();
    $controller->setLogger($logger);
    $this->controller = $controller;
  }

  public static function getSubscribedEvents()
  {
    return [
      KernelEvents::EXCEPTION => [
        ['process', 20],
      ]
    ];
  }

  public function process(ExceptionEvent $event)
  {
    if ($this->request->debug == 0)
    {
      $this->controller->setThrowable($event->getThrowable());
      $this->controller->process();

      $response = $this->controller->getResponse();

      $event->setResponse($response);
      $event->stopPropagation();
    }
  }

}