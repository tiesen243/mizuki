<?php

namespace App\Controller;

use App\Contract\Repository\{IPostRepository, IUserRepository};
use Core\Abstract\Controller;
use Core\Http\Response;

class PostController extends Controller
{
  public function index(IPostRepository $postRepo): Response {
    $posts = $postRepo->allWithAuthor();

    return $this->render('app/post/index', [
      'title' => 'Posts',
      'posts' => $posts,
    ]);
  }

  public function show(int $id, IPostRepository $postRepo, IUserRepository $userRepo): Response {
    $post = $postRepo->find($id);

    if (!$post) {
      $this->setFlash('error', 'Post not found.');

      return $this->redirect('/posts');
    }

    $author = $userRepo->find($post->authorId);

    return $this->render('app/post/show', [
      'title' => $post->title,
      'post' => $post,
      'author' => $author,
    ]);
  }

  public function create(): Response {
    if (!$this->isAuthenticated()) {
      $this->setFlash('error', 'You must be logged in to create a post.');

      return $this->redirect('/login');
    }

    return $this->render('app/post/create', [
      'title' => 'Create Post',
    ]);
  }
}
