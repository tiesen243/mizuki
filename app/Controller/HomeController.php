<?php

namespace App\Controller;

use Core\Abstract\Controller;
use Core\Http\Response;

class HomeController extends Controller
{
  public function index(): Response {
    return $this->render('app/home/index', [
      'title' => 'Home Page',
    ]);
  }
}
