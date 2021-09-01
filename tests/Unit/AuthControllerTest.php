<?php

namespace Tests\Unit;

use Mvc\Controller\AuthController;
use Mvc\Enums\HttpStatus;
use Mvc\Repository\Contracts\UserRepositoryContracts;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;
use Tests\BaseTests;
use Tests\Mocks\RequestMock;

class AuthControllerTest extends BaseTests
{
  private ResponseInterface $response;

  private AuthController $controller;

  private AuthController $controllerError;


  public function setUp(): void
  {
    parent::setUp();

    $this->response = new Response();

    $respository = $this->container->get(UserRepositoryContracts::class);
    $respositoryError = $this->container->get("Error");

    $this->controller = new AuthController($this->container, $respository);
    $this->controllerError = new AuthController($this->container, $respositoryError);
  }

  /**
   * @test
   */
  public function shouldLoginReturnValidResponse()
  {
    $fixtureFile = __DIR__ . "/../fixtures/createNewUser.json";

    $request = (new RequestMock("POST", "api/v1/auth/", $fixtureFile))->getInstance();

    $response = $this->controller->login($request, $this->response);

    $this->assertEquals(HttpStatus::OK, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function shouldCreateReturnValidResponse()
  {
    $fixtureFile = __DIR__ . "/../fixtures/createNewUser.json";

    $request = (new RequestMock("POST", "api/v1/auth/cadastrar/", $fixtureFile))->getInstance();

    $response = $this->controller->cadastrar($request, $this->response);

    $this->assertEquals(HttpStatus::CREATED, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function shouldLoginReturnErrorResponse()
  {
    $fixtureFile = __DIR__ . "/../fixtures/createNewUser.json";

    $request = (new RequestMock("POST", "api/v1/auth/", $fixtureFile))->getInstance();

    $response = $this->controllerError->login($request, $this->response);

    $this->assertEquals(HttpStatus::INTERNAL_SERVER_ERROR, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function shouldCreateReturnErrorResponse()
  {
    $fixtureFile = __DIR__ . "/../fixtures/createNewUser.json";

    $request = (new RequestMock("POST", "api/v1/auth/cadastrar/", $fixtureFile))->getInstance();

    $response = $this->controllerError->cadastrar($request, $this->response);

    $this->assertEquals(HttpStatus::INTERNAL_SERVER_ERROR, $response->getStatusCode());
  }
}
