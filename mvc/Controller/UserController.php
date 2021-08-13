<?php

namespace Mvc\Controller;


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
   * get all user
   */
  public function list(Request $request, Response $response)
  {
    $data = $this->userModel->list();
    return $this->jsonResponse($response, $data);
  }

  /**
   * get a user by id
   */
  public function show(Request $request, Response $response, array $args)
  {
    $this->userModel->setId($args["id"]);
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
  public function update(Request $request, Response $response, array $args)
  {
    $updated = $this->userModel
      ->setName($this->request($request, "Name"))
      ->setYearOld($this->request($request, "YearOld"))
      ->setId($args["id"])
      ->update();
    if ($updated) {
      return $this->jsonResponse($response, null, 202);
    }
  }

  /**
   * delete user data
   */
  public function destroy(Request $request, Response $response, array $args)
  {
    $deleted = $this->userModel
      ->setId($args["id"])
      ->destroy();
    if ($deleted) {
      return $this->jsonResponse($response, null, 204);
    }
  }
}
