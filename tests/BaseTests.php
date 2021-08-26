<?php

namespace Tests;

use DI\Container;
use GuzzleHttp\Client;
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

  public function request(string $method, string $url, $data = null): ResponseInterface
  {
    $client = new Client(["base_uri" => $_ENV["APP_URL"]]);

    $options = [];

    if ($data) {
      $options['json'] = $data;
    }
    return $client->request($method, $url, $options);
  }
}
