<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
  public static function getSubscribedEvents()
  {
    return [
      KernelEvents::EXCEPTION => [
        ['process', 20],
        ['log', 20],
        ['notify', 20],
        ['respond', 20],
      ]
    ];
  }

  public function log(ExceptionEvent $event)
  {
  }

  public function notify(ExceptionEvent $event)
  {
  }

  public function process(ExceptionEvent $event)
  {
  }

  public function respond(ExceptionEvent $event)
  {
  }
}