<?php

namespace App\Controller;

use Core\Abstract\Controller;
use Core\Http\Response;

class PostController extends Controller
{
  public function index(): Response {
    return $this->render('post/index', [
      'title' => 'Posts',
    ]);
  }
}
