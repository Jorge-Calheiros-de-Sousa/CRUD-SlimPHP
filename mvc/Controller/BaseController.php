<?php

namespace Mvc\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BaseController
{
  /**
   * Download values ​​in json and transforms them into PHP classes
   */
  protected function request(Request $request, string $key)
  {
    $json = json_decode($request->getBody());
    return $json->$key;
  }

  /**
   * Obter valores de verbo GET
   */
  protected function get(string $key): ?string
  {
    return isset($_GET[$key]) ? $_GET[$key] : null;
  }

  /**
   * Returns php results in json
   */
  protected function jsonResponse(Response $response, $data = null, int $status = 200)
  {
    if ($data != null) {
      $response->withHeader('Content-Type', 'application/json');
      $response->getBody()->write(json_encode($data));
    }
    return $response->withStatus($status);
  }
}
