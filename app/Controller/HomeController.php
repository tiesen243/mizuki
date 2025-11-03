<?php

namespace App\Controller;

use App\Contract\Controller\IHomeController;
use Core\Abstract\Controller;
use Core\Http\Response;

class HomeController extends Controller implements IHomeController
{
  public function index(): Response {
    return $this->render('app/home/index', [
      'title' => 'Home Page',
    ]);
  }
}
