<?php

namespace Tests\Unit;

use Mvc\Controller\UserController;
use Mvc\Enums\HttpStatus;
use Mvc\Repository\Contracts\UserRepositoryContracts;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;
use Tests\BaseTests;
use Tests\Mocks\RequestMock;

class UserControllerTest extends BaseTests
{
  private ResponseInterface $response;

  private RequestInterface $request;

  private UserController $controller;

  public function setUp(): void
  {
    parent::setUp();

    $this->response = new Response();

    $respository = $this->container->get(UserRepositoryContracts::class);

    $this->controller = new UserController($this->container, $respository);
  }

  /**
   * @test
   */
  public function shouldListReturnValidResponse()
  {
    $response = $this->controller->list($this->response);

    $this->assertEquals(HttpStatus::OK, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function shouldShowReturnValidResponse()
  {
    $response = $this->controller->show($this->response, 1);

    $this->assertEquals(HttpStatus::OK, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function shouldCreateReturnValidResponse()
  {
    $fixtureFile = __DIR__ . "/../fixtures/createNewUser.json";

    $request = (new RequestMock("POST", "api/v1/users", $fixtureFile))->getInstance();

    $response = $this->controller->create($request, $this->response);

    $this->assertEquals(HttpStatus::CREATED, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function shouldUpdateValidResponse()
  {
    $fixtureFile = __DIR__ . "/../fixtures/createNewUser.json";

    $request = (new RequestMock("POST", "api/v1/users", $fixtureFile))->getInstance();

    $response = $this->controller->update($request, $this->response, 1);

    $this->assertEquals(HttpStatus::ACCEPTED, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function shouldDestroyValidResponse()
  {
    $response = $this->controller->destroy($this->response, 1);

    $this->assertEquals(HttpStatus::NO_CONTENT, $response->getStatusCode());
  }
}
