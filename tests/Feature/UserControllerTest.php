<?php

namespace Tests\Feature;

use Mvc\Enums\HttpStatus;
use Tests\BaseTests;

class UserControllerTest extends BaseTests
{

  private array $headers;

  public function setUp(): void
  {
    parent::setUp();

    $token = $this->fakeAuth();

    $this->headers = ["Authorization" => "Bearer " . $token["token"]];
  }
  /**
   * @test
   */
  public function shouldReturnHeaderOfUser()
  {
    $response = $this->request("GET", "api/v1/users", null, $this->headers);

    $this->assertStringContainsString("jwt", $response->getBody()->getContents(), "not found");
    $this->assertEquals(HttpStatus::OK, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function shouldReturnShowUsers()
  {
    $response = $this->request("GET", "api/v1/users/Jorge Calheiros de Sousa", null, $this->headers);

    $this->assertEquals(HttpStatus::OK, $response->getStatusCode());
    $this->assertStringContainsString("user", $response->getBody()->getContents(), "not found");
  }
  /**
   * @test
   */
  public function shouldReturnUpdateNameOfUser()
  {
    $response = $this->request("PUT", "api/v1/users/editar-nome/3", [
      "nome" => "teste",
      "senha" => "fulano"
    ], $this->headers);

    $this->assertEquals(HttpStatus::ACCEPTED, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function shouldReturnUpdateEmailOfUser()
  {
    $response = $this->request("PUT", "api/v1/users/editar-email/3", [
      "email" => "teste@teste.com",
      "senha" => "123456"
    ], $this->headers);

    $this->assertEquals(HttpStatus::ACCEPTED, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function shouldReturnUpdateSenhaOfUser()
  {
    $response = $this->request("PUT", "api/v1/users/editar-senha/3", [
      "senhaNova" => "jorge2",
      "senha" => "123456"
    ], $this->headers);

    $this->assertEquals(HttpStatus::ACCEPTED, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function shouldReturnViewOfUsers()
  {
    $response = $this->request("GET", "/CRUD-SlimPHP/");

    $this->assertStringContainsString("Slim PHP", $response->getBody()->getContents(), "not found");
  }
}
