<?php

namespace Mvc\Controller;

use Mvc\Enums\HttpStatus;
use DI\Container;
use Mvc\Repository\Contracts\UserRepositoryContracts;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use tidy;

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

  public static function renderloginadm(Response $response, Container $container)
  {
    $twig = $container->get("view");
    return $twig->render($response, "loginadm.twig", ['baseURL' => $_ENV['APP_URL']]);
  }

  public static function rendernadmhome(Response $response, Container $container)
  {
    $twig = $container->get("view");
    return $twig->render($response, "adm.twig", ['baseURL' => $_ENV['APP_URL']]);
  }

  public static function rendercadastro(Response $response, Container $container)
  {
    $twig = $container->get("view");
    return $twig->render($response, "cadastro.twig", ['baseURL' => $_ENV['APP_URL']]);
  }

  public static function renderlogin(Response $response, Container $container)
  {
    $twig = $container->get("view");
    return $twig->render($response, "login.twig", ['baseURL' => $_ENV['APP_URL']]);
  }

  public static function rendereditarnome(Response $response, Container $container)
  {
    $twig = $container->get("view");
    return $twig->render($response, "editarnome.twig", ['baseURL' => $_ENV['APP_URL']]);
  }
  public static function rendereditaremail(Response $response, Container $container)
  {
    $twig = $container->get("view");
    return $twig->render($response, "editaremail.twig", ['baseURL' => $_ENV['APP_URL']]);
  }
  public static function rendereditarsenha(Response $response, Container $container)
  {
    $twig = $container->get("view");
    return $twig->render($response, "editarsenha.twig", ['baseURL' => $_ENV['APP_URL']]);
  }


  /**
   * get Header
   */
  public function header(Request $request, Response $response)
  {
    return $this->jsonResponse($response, $request->getHeaders());
  }

  /**
   * get all user
   */
  public function list(Response $response)
  {
    $data = $this->respository->list();
    if ($data == null) {
      return $this->jsonResponse($response, $data, HttpStatus::NO_CONTENT);
    }
    return $this->jsonResponse($response, $data);
  }

  /**
   * get a user by id
   */
  public function show(Response $response, $user)
  {
    $data = $this->respository->list($user);
    return $this->jsonResponse($response, $data);
  }

  /**
   * update user data
   */
  public function update_user(Request $request, Response $response, $id)
  {
    $nome = $this->request($request, "nome");
    $senha = $this->request($request, "senha");

    $verifik = $this->respository->verifik_user($nome);

    $verifik_password = $this->respository->verifik_password($id, $senha);

    if ($verifik_password != true) {
      return $this->jsonResponse($response, null, HttpStatus::BAD_REQUEST);
    };

    $model = $this->userModel->setUser($nome);

    if ($verifik == true) {
      $updated = $this->respository->update_name($id, $model);

      if ($updated) {
        return $this->jsonResponse($response, null, HttpStatus::ACCEPTED);
      } else {
        return $this->jsonResponse($response, null, HttpStatus::INTERNAL_SERVER_ERROR);
      }
    }
    return $this->jsonResponse($response, null, HttpStatus::INTERNAL_SERVER_ERROR);
  }

  /**
   * update email data
   */
  public function update_email(Request $request, Response $response, $id)
  {
    $senha = $this->request($request, "senha");

    $verifik_password = $this->respository->verifik_password($id, $senha);

    if ($verifik_password != true) {
      return $this->jsonResponse($response, null, HttpStatus::BAD_REQUEST);
    };

    $model = $this->userModel->setEmail($this->request($request, "email"));

    $updated = $this->respository->update_email($id, $model);

    if ($updated) {
      return $this->jsonResponse($response, null, HttpStatus::ACCEPTED);
    } else {
      return $this->jsonResponse($response, null, HttpStatus::INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * update password data
   */
  public function update_senha(Request $request, Response $response, $id)
  {
    $senha = $this->request($request, "senha");

    $verifik_password = $this->respository->verifik_password($id, $senha);

    if ($verifik_password != true) {
      return $this->jsonResponse($response, null, HttpStatus::BAD_REQUEST);
    };

    $model = $this->userModel->setPassword(password_hash($this->request($request, "senhaNova"), PASSWORD_DEFAULT));

    $updated = $this->respository->update_password($id, $model);

    if ($updated) {
      return $this->jsonResponse($response, null, HttpStatus::ACCEPTED);
    }
    return $this->jsonResponse($response, null, HttpStatus::INTERNAL_SERVER_ERROR);
  }

  /**
   * delete user data
   */
  public function destroy(Response $response, $id)
  {
    $deleted = $this->respository->destroy($id);
    if ($deleted) {
      return $this->jsonResponse($response, null, HttpStatus::NO_CONTENT);
    }

    return $this->jsonResponse($response, null, HttpStatus::INTERNAL_SERVER_ERROR);
  }
}
