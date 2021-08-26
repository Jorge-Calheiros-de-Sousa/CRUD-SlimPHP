<?php

namespace Tests\Feature;

use Mvc\Enums\HttpStatus;
use Tests\BaseTests;

class UserControllerTest extends BaseTests
{

  /**
   * @test
   */
  public function shouldReturnListOfUsers()
  {
    $response = $this->request("GET", "api/v1/users");

    $this->assertEquals(HttpStatus::OK, $response->getStatusCode());
    $this->assertEquals("application/json", $response->getHeader("Content-Type")[0]);
  }

  /**
   * @test
   */
  public function shouldReturnShowOfUsers()
  {
    $response = $this->request("GET", "api/v1/users/5");

    $this->assertEquals(HttpStatus::OK, $response->getStatusCode());
    $this->assertEquals("application/json", $response->getHeader("Content-Type")[0]);
  }

  /**
   * @test
   */
  public function shouldReturnUpdateOfUsers()
  {
    $response = $this->request("PUT", "api/v1/users/5", [
      "Name" => "teste",
      "YearOld" => "12"
    ]);

    $this->assertEquals(HttpStatus::ACCEPTED, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function shouldReturnCreateOfUsers()
  {
    $response = $this->request("POST", "api/v1/users", [
      "Name" => "Criado",
      "YearOld" => "12"
    ]);

    $this->assertEquals(HttpStatus::CREATED, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function shouldReturnViewOfUsers()
  {
    $response = $this->request("GET", "/CRUD-SlimPHP/");

    $this->assertStringContainsString("Cadastrar usuario", $response->getBody()->getContents(), "not found");
  }
}
