<?php

namespace App\Controllers;

use App\Controllers\Controller;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};
use App\Models\User;

class HomeController extends Controller
{
    public function index(Request $request, Response $response, $args)
    {
      $user = User::find(1);
      echo env('APP_NAME');
      dump($user);
      die();
      return $response->withJson(['works' => true]);
    }
}
