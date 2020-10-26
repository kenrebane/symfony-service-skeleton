<?php

use App\Controller\ExceptionController;
use App\Exception\InternalErrorException;
use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

require dirname(__DIR__) . '/vendor/autoload.php';

( new Dotenv() )->bootEnv(dirname(__DIR__) . '/.env');

$env = $_SERVER[ 'APP_ENV' ];
$debug = $_SERVER[ 'APP_DEBUG' ];
$proxies = $_SERVER[ 'TRUSTED_PROXIES' ];
$hosts = $_SERVER[ 'TRUSTED_HOSTS' ];

if ($trustedProxies = $proxies ?? false)
{
  Request::setTrustedProxies(explode(',', $trustedProxies), Request::HEADER_X_FORWARDED_ALL ^ Request::HEADER_X_FORWARDED_HOST);
}

if ($trustedHosts = $hosts ?? false)
{
  Request::setTrustedHosts([$trustedHosts]);
}

$kernel = new Kernel($env, (bool) $debug);
$request = Request::createFromGlobals();
$request->debug = $debug;

if ($debug)
{
  umask(0000);
  Debug::enable();
  $response = $kernel->handle($request);
}
else
{
  try
  {
    $response = $kernel->handle($request);
  }
  catch (\Error $error)
  {
    $throwable = new InternalErrorException();
    $throwable->setError($error);

    $controller = new ExceptionController;
    $controller->setThrowable($throwable);
    $controller->process();

    $response = $controller->getResponse();
  }
}

$response->send();
$kernel->terminate($request, $response);

