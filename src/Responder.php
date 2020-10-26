<?php

namespace App;

use App\Response\ResponseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class Responder
{
  private SerializerInterface $serializer;
  private int $status;
  private $data;

  public function __construct(SerializerInterface $serializer)
  {
    $this->serializer = $serializer;
  }

  public function getResponse($data = '{}') : Response
  {
    $this->data = $data;

    return new Response('asd');
  }
}