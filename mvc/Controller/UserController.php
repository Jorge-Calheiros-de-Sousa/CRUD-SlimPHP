<?php

namespace Mvc\Controller;

use DI\Container;
use Mvc\Model\UserModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController extends BaseController
{
  private $userModel;

  public function __construct()
  {
    $this->userModel = new UserModel;
  }

  /**
   * 
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
    $data = $this->userModel->list();
    return $this->jsonResponse($response, $data);
  }

  /**
   * get a user by id
   */
  public function show(Response $response, $id)
  {
    $this->userModel->setId($id);
    $data = $this->userModel->list();
    return $this->jsonResponse($response, $data);
  }

  /**
   * create a new user
   */
  public function create(Request $request, Response $response)
  {
    $created = $this->userModel
      ->setName($this->request($request, "Name"))
      ->setYearOld($this->request($request, "YearOld"))
      ->create();
    if ($created) {
      return $this->jsonResponse($response, null, 201);
    }
  }

  /**
   * update user data
   */
  public function update(Request $request, Response $response, $id)
  {
    $updated = $this->userModel
      ->setName($this->request($request, "Name"))
      ->setYearOld($this->request($request, "YearOld"))
      ->setId($id)
      ->update();
    if ($updated) {
      return $this->jsonResponse($response, null, 202);
    }
  }

  /**
   * delete user data
   */
  public function destroy(Response $response, $id)
  {
    $deleted = $this->userModel
      ->setId($id)
      ->destroy();
    if ($deleted) {
      return $this->jsonResponse($response, null, 204);
    }
  }
}
