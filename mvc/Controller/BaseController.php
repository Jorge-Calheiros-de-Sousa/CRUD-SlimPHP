<?php

namespace Mvc\Controller;

use Mvc\Enums\HttpStatus;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BaseController
{
  /**
   * Download values ​​in json and transforms them into PHP classes
   */
  protected function request(Request $request, string $key)
  {
    $json = $request->getParsedBody();
    return $json[$key];
  }

  /**
   * Returns php results in json
   */
  protected function jsonResponse(Response $response, $data = null, int $status = HttpStatus::OK)
  {
    $newResponse = $response;
    if ($data != null) {
      $response->getBody()->write(json_encode($data));
      $newResponse = $response->withHeader('Content-Type', 'application/json');
    }
    $newResponse = $newResponse->withStatus($status);

    return $newResponse;
  }
}
