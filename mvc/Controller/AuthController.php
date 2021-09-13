<?php

namespace Mvc\Controller;

use DI\Container;
use Firebase\JWT\JWT;
use Mvc\DTO\AuthUserDTO;
use Mvc\Enums\HttpStatus;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Mvc\Repository\Contracts\UserRepositoryContracts as Repository;
use Slim\Exception\HttpBadRequestException;

class AuthController extends BaseController
{
  private $userModel;
  private Repository $respository;

  public function __construct(Container $container, Repository $respository)
  {
    $this->userModel = $container->get("userModel");
    $this->respository = $respository;
  }

  /**
   * login user
   */
  public function login(Request $request, Response $response)
  {
    try {
      if (!$secret = $_ENV["JWT_SECRET"]) {
        throw new \Exception("JWT secret not defined");
      }

      $user = $this->request($request, "nome");
      $password = $this->request($request, "senha");

      if (!$user || !$password) {
        throw new HttpBadRequestException($request);
      }

      /**
       * @var AuthUserDTO $userDTO
       */
      if (!$userDTO = $this->respository->auth($user, $password)) {
        throw new HttpBadRequestException($request);
      }

      $encoded = JWT::encode([
        "iat" => strtotime("now"),
        'exp' => strtotime('+1 day'),
        "user" => $userDTO->getUser(),
        "password" => $userDTO->getPassword(),
      ], $secret);

      return $this->jsonResponse($response, ["token" => $encoded]);
    } catch (HttpBadRequestException $e) {
      return $this->jsonResponse($response, ["Mensagem" => "Usuário ou senha incorreto"], HttpStatus::BAD_REQUEST);
    } catch (\Throwable $th) {
      return $this->jsonResponse($response, null, HttpStatus::INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * create user
   */
  public function cadastrar(Request $request, Response $response)
  {
    $nome = $this->request($request, "nome");
    $email = $this->request($request, "email");
    $password = $this->request($request, "senha");

    /**
     * @var AuthUserDTO $userDTO
     */
    if ($userDTO = $this->respository->auth($nome, $password)) {
      return $this->jsonResponse($response, null, HttpStatus::BAD_REQUEST);
    }

    $model = $this->userModel->setUser($nome)
      ->setEmail($email)
      ->setPassword(password_hash($password, PASSWORD_DEFAULT));

    $created = $this->respository->create($model);

    if ($created > 0) {
      return $this->jsonResponse($response, $created, HttpStatus::CREATED);
    }
    return $this->jsonResponse($response, null, HttpStatus::INTERNAL_SERVER_ERROR);
  }

  /**
   * login admin
   */
  public function loginAdmin(Request $request, Response $response)
  {
    try {
      if (!$secret = $_ENV["JWT_SECRET"]) {
        throw new \Exception("JWT secret not defined");
      }

      $user = $this->request($request, "nome");
      $password = $this->request($request, "senha");

      if (!$user || !$password) {
        throw new HttpBadRequestException($request);
      }


      if (!$userDTO = $this->respository->authAdmin($user, $password)) {
        throw new HttpBadRequestException($request);
      }

      $encoded = JWT::encode([
        "iat" => strtotime("now"),
        'exp' => strtotime('+1 day'),
        "user" => $userDTO->getUser(),
        "password" => $userDTO->getPassword(),
      ], $secret);

      return $this->jsonResponse($response, ["token" => $encoded]);
    } catch (HttpBadRequestException $e) {
      return $this->jsonResponse($response, ["Mensagem" => "Usuário ou senha incorreto"], HttpStatus::BAD_REQUEST);
    } catch (\Throwable $th) {
      return $this->jsonResponse($response, null, HttpStatus::INTERNAL_SERVER_ERROR);
    }
  }
}
