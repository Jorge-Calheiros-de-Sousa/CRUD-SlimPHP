<?php

namespace Tests;

use DI\Container;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use Mvc\Enums\HttpStatus;
use Mvc\Repository\Contracts\UserRepositoryContracts;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Tests\Utils\TestContainers;

class BaseTests extends TestCase
{
  protected Container $container;

  public function setUp(): void
  {
    $this->container = new Container();
    TestContainers::init($this->container);
  }

  public function request(string $method, string $url, $data = null, $headers = []): ResponseInterface
  {
    $client = new Client(["base_uri" => $_ENV["APP_URL"]]);

    $options = [];

    if ($data) {
      $options['json'] = $data;
    }

    if ($headers) {
      foreach ($headers as $headerName => $headerValue) {
        $options["headers"][$headerName] = $headerValue;
      }
    }
    return $client->request($method, $url, $options);
  }
  public function fakeAuth()
  {
    try {
      $user = "Teste";
      $password = "teste";

      $encoded = JWT::encode([
        "iat" => strtotime("now"),
        'exp' => strtotime('+1 day'),
        "user" => $user,
        "password" => $password,
      ], $_ENV["JWT_SECRET"]);

      return ["token" => $encoded];
    } catch (\Throwable $th) {
      return HttpStatus::INTERNAL_SERVER_ERROR;
    }
  }
}
