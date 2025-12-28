<?php

namespace App\Controller;

use Core\Abstract\Controller;
use Core\Http\Response;

class HomeController extends Controller
{
  public function index(): Response {
    return $this->render('home/index', [
      'title' => 'Home Page',
    ]);
  }

  public function about(): Response {
    return $this->render('home/about', [
      'title' => 'About Us',
    ]);
  }
}
