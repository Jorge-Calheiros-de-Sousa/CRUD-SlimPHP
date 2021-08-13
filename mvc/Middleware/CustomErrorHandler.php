<?php

namespace Mvc\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Psr7\Response;

class CustomErrorHandler
{
  public function __invoke(Request $request, Handler $handler)
  {
    try {
      return $handler->handle($request);
    } catch (\Exception $e) {
      $errorResponse = [
        "Message" => "erro desconhecido, tente mais tarde"
      ];

      if ($_ENV["APP_ENV"] == "DEV") {
        $errorResponse["DevMessage"] = $e->getMessage();
      }

      $response = new Response();
      $response->withHeader("Content-Type", "application/json");
      $response->getBody()->write(json_encode($errorResponse));
      return $response;
    }
  }
}
