<?php

namespace Mvc\Middleware;

use Firebase\JWT\JWT;
use Mvc\Enums\HttpStatus;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Psr7\Response;

class AuthMiddleware
{
  public function __invoke(Request $request, Handler $handler)
  {
    try {
      $secret = $_ENV["JWT_SECRET"];

      if ($secret == "") {
        throw new \Exception("JWL is not defined");
      };
      $authorization = $request->getHeader("Authorization");

      if (!isset($authorization[0])) {
        throw new \Exception("Token not found");
      }


      $authHeader = str_replace("Bearer ", "", $authorization[0]);

      $decoded = JWT::decode($authHeader, $secret, ["HS256"]);

      if (strtotime('now') > $decoded->exp) {
        throw new \Exception('Token expired');
      }

      $newRequest = $request->withHeader("jwt", json_encode($decoded));

      return $handler->handle($newRequest);
    } catch (\Throwable $e) {
      $errorResponse = [
        "Message" => "Acesso não autorizado"
      ];

      if ($_ENV["APP_ENV"] == "DEV") {
        $errorResponse["DevMessage"] = $e->getMessage();
        $errorResponse["DevTrace"] = $e->getTraceAsString();
      }

      $response = new Response();
      $response->getBody()->write(json_encode($errorResponse));
      return $response->withHeader("Content-Type", "application/json")
        ->withStatus(HttpStatus::UNAUTHORIZED);
    }
  }
}
