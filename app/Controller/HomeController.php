<?php

namespace App\Controller;

use Core\Abtract\Controller;
use Core\Http\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        return $this->render('home/index', []);
    }
}
