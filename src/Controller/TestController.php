<?php

namespace App\Controller;

use App\Exception\BadRequestException;
use App\Exception\InternalErrorException;
use App\Exception\RequestValidationException;
use App\Responder;
use App\Response\TestResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TestController extends AbstractController
{
  private Responder $responder;

  public function __construct(Responder $responder)
  {
    $this->responder = $responder;
  }

  /**
   * @Route("/test", name="test")
   */
  public function index() : Response
  {
    $ve = new RequestValidationException();

    $arr = [new TestResponse(), new TestResponse()];

    return $this->responder->getResponse($arr);
  }
}
