<?php

namespace App\Controller;

use App\Contract\Service\IAuthService;
use App\Entity\User;
use Core\Abstract\Controller;
use Core\Http\Response;

class AuthController extends Controller
{
  public function register(IAuthService $authService): Response {
    if ('GET' === $this->request->method()) {
      return $this->render('app/auth/register', [
        'title' => 'Register',
      ]);
    }

    $user = new User();
    $user->username = $this->request->getPost('username', '');
    $user->password = $this->request->getPost('password', '');
    $user->email = $this->request->getPost('email', '');
    $errors = $user->validate(['username', 'password', 'email']);
    if ($user->password !== $this->request->getPost('confirm_password', '')) {
      $errors['confirm_password'] = 'Password confirmation does not match.';
    }
    if (!empty($errors)) {
      return $this->redirect('/register', [
        'errors' => $errors,
        'old' => ['username' => $user->username, 'email' => $user->email],
      ]);
    }

    $this->db->beginTransaction();
    try {
      $authService->register($user);
      $this->db->commit();
      $this->setFlash('success', 'Registration successful. Please log in.');

      return $this->redirect('/login');
    } catch (\Exception $e) {
      $this->db->rollBack();
      $this->setFlash('error', $e->getMessage());

      return $this->redirect('/register', [
        'old' => ['username' => $user->username, 'email' => $user->email],
      ]);
    }
  }

  public function login(IAuthService $authService): Response {
    if ('GET' === $this->request->method()) {
      return $this->render('auth/login', ['title' => 'Login']);
    }

    $user = new User();
    $user->username = $this->request->getPost('identifier', '');
    $user->email = $this->request->getPost('identifier', '');
    $user->password = $this->request->getPost('password', '');
    $errors = $user->validate(['identifier', 'password']);
    if (!empty($errors)) {
      return $this->redirect('/login', [
        'errors' => $errors,
        'old' => ['identifier' => $user->username],
      ]);
    }

    $this->db->beginTransaction();
    try {
      $authService->login($user);
      $this->db->commit();
      $this->setFlash('success', 'Login successful.');

      return $this->redirect('/');
    } catch (\Exception $e) {
      $this->db->rollBack();
      $this->setFlash('error', $e->getMessage());

      return $this->redirect('/login', [
        'old' => ['identifier' => $user->username],
      ]);
    }

    return $this->redirect('/login');
  }

  public function logout(IAuthService $authService): Response {
    if ('POST' !== $this->request->method()) {
      $this->setFlash('error', 'Invalid request method for logout.');

      return $this->redirect('/');
    }

    if (!isset($_SESSION['user'])) {
      $this->setFlash('error', 'You are not logged in.');

      return $this->redirect('/login');
    }

    $authService->logout();

    return $this->redirect('/login');
  }
}
