<?php

namespace App\EventSubscriber;

use App\Controller\ExceptionController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
  private ExceptionController $controller;

  public function __construct(ExceptionController $controller)
  {
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

    $event->setResponse((new ExceptionController)->setEvent($event)->process()->getResponse());
    $event->stopPropagation();
  }

}