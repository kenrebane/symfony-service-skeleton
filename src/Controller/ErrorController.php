<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController
{
  private \Error $error;
  private Response $response;

  public function setError(\Error $error) : self
  {
    $this->error = $error;

    return $this;
  }

  public function process() : self
  {
    dd($this->error);
    $this->response = new JsonResponse([
      'status' => 500,
      'type' => 'Internal error',
      'title' => 'Something went wrong',
      'detail' => 'PHP error',
    ]);

    return $this;
  }

  public function getResponse() : Response
  {
    return $this->response;
  }
}
