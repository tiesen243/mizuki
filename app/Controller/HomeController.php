<?php

namespace App\Controller;

use Core\Http\Response;
use Core\Kernel\Controller;

class HomeController extends Controller
{
    public function index(): Response
    {
        return $this->render('home/index');
    }
}
