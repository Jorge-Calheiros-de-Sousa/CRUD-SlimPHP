<?php

namespace Tests\Feature;

use Mvc\Enums\HttpStatus;
use Tests\BaseTests;

class AuthControllerTest extends BaseTests
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
  public function shouldReturnValidLoginOfUser()
  {
    $response = $this->request("POST", "api/v1/auth", [
      "nome" => "Jorge Calheiros de Sousa",
      "senha" => "jorge"
    ]);

    $this->assertEquals(HttpStatus::OK, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function shouldReturnErrorLoginOfUser()
  {
    $response = $this->request("POST", "api/v1/auth", [
      "nome" => "Jorge Calheiros de Sousa",
      "senha" => "senhaERRO"
    ]);

    $this->assertEquals(HttpStatus::BAD_REQUEST, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function shouldReturnValidCreate()
  {
    $response = $this->request("POST", "api/v1/auth/cadastrar/", [
      "nome" => "Jorge teste",
      "email" => "Jorge@gmail.com",
      "senha" => "teste"
    ]);

    $this->assertEquals(HttpStatus::CREATED, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function shouldReturnErrorCreate()
  {
    $response = $this->request("POST", "api/v1/auth/cadastrar/", [
      "nome" => "Jorge teste",
      "email" => "Jorge@gmail.com",
      "senha" => "teste"
    ]);

    $this->assertEquals(HttpStatus::CREATED, $response->getStatusCode());
  }
}
