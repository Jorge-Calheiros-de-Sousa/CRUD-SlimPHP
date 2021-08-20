<?php

namespace Mvc\Controller;

use DI\Container;
use Mvc\Repository\Contracts\UserRepositoryContracts;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController extends BaseController
{
  private $userModel;
  private UserRepositoryContracts $respository;

  public function __construct(Container $container, UserRepositoryContracts $respository)
  {
    $this->userModel = $container->get("userModel");
    $this->respository = $respository;
  }

  /**
   * render page.twig
   */
  public static function render(Response $response, Container $container)
  {
    $twig = $container->get("view");
    return $twig->render($response, "home.twig", ['baseURL' => $_ENV['APP_URL']]);
  }

  /**
   * get all user
   */
  public function list(Response $response)
  {
    $data = $this->respository->list();
    return $this->jsonResponse($response, $data);
  }

  /**
   * get a user by id
   */
  public function show(Response $response, $id)
  {
    $data = $this->respository->list($id);
    return $this->jsonResponse($response, $data);
  }

  /**
   * create a new user
   */
  public function create(Request $request, Response $response)
  {
    $userModel = $this->userModel
      ->setName($this->request($request, "Name"))
      ->setYearOld($this->request($request, "YearOld"));
    $created = $this->respository->create($userModel);
    if ($created) {
      return $this->jsonResponse($response, null, 201);
    }
  }

  /**
   * update user data
   */
  public function update(Request $request, Response $response, $id)
  {
    $userModel = $this->userModel
      ->setName($this->request($request, "Name"))
      ->setYearOld($this->request($request, "YearOld"));
    $updated = $this->respository->update($id, $userModel);
    if ($updated) {
      return $this->jsonResponse($response, null, 202);
    }
  }

  /**
   * delete user data
   */
  public function destroy(Response $response, $id)
  {
    $deleted = $this->respository->destroy($id);
    if ($deleted) {
      return $this->jsonResponse($response, null, 204);
    }
  }
}
