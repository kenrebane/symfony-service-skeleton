<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
  /**
   * @Route("/test", name="test")
   */
  public function index() : Response
  {
    return $this->json([
      'message' => 'Welcome to your new controller!',
      'path' => 'src/Controller/TestController.php',
    ]);
  }
}
