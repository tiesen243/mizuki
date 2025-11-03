<?php

namespace App\Controller;

use App\Contract\Service\IAuthService;
use App\Entity\User;
use Core\Abstract\Controller;
use Core\Http\Response;

class AuthController extends Controller
{
    public function login(IAuthService $authService): Response
    {
        if ($this->request->method() === 'GET') {
            return $this->render('auth/login', [
                'title' => 'Login'
            ]);
        }

        $user = new User();
        $user->username = $this->request->getPost('username', '');
        $user->password = $this->request->getPost('password', '');
        $errors = $user->validate(['username', 'password']);
        if (!empty($errors)) {
            return $this->redirect('/login', [
              'errors' => $errors,
              'old' => [
                  'username' => $user->username
              ]
            ]);
        }

        try {
            $authService->login([
                'username' => $user->username,
                'password' => $user->password
            ]);
            return $this->redirect('/');
        } catch (\Exception $e) {
            $this->setFlash('error', $e->getMessage());
            return $this->redirect('/login', [
                'old' => [
                    'username' => $user->username
                ]
            ]);
        }
        return $this->redirect('/login');
    }

    public function logout(IAuthService $authService): Response
    {
        $authService->logout();
        return $this->redirect('/login');
    }
}
