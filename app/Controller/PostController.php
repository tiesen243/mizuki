<?php

namespace App\Controller;

use App\Contract\Repository\IPostRepository;
use App\Entity\Post;
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

  public function show(string $id, IPostRepository $postRepo): Response {
    $post = $postRepo->findWithAuthor($id);

    if (!$post) {
      $this->setFlash('error', 'Post not found.');

      return $this->redirect('/posts');
    }

    return $this->render('app/post/show', [
      'title' => $post->title,
      'post' => $post,
    ]);
  }

  public function create(IPostRepository $postRepo): Response {
    if (!$this->isAuthenticated()) {
      $this->setFlash('error', 'You must be logged in to create a post.');

      return $this->redirect('/login');
    }

    if ('GET' === $this->request->method()) {
      return $this->render('app/post/create', [
        'title' => 'Create Post',
      ]);
    }

    $post = new Post();
    $post->title = $this->request->getPost('title', '');
    $post->content = $this->request->getPost('content', '');
    $post->authorId = $this->getUser()->id;
    $errors = $post->validate(['title', 'content']);
    if (!empty($errors)) {
      return $this->render('app/post/create', [
        'title' => 'Create Post',
        'errors' => $errors,
        'old' => ['title' => $post->title, 'content' => $post->content],
      ]);
    }

    $postRepo->store($post);
    $this->setFlash('success', 'Post created successfully.');

    return $this->redirect('/posts');
  }

  public function edit(string $id, IPostRepository $postRepo): Response {
    if (!$this->isAuthenticated()) {
      $this->setFlash('error', 'You must be logged in to edit a post.');

      return $this->redirect('/login');
    }

    $post = $postRepo->find($id);
    if (!$post) {
      $this->setFlash('error', 'Post not found.');

      return $this->redirect('/posts');
    }

    if ($post->authorId !== $this->getUser()->id) {
      $this->setFlash('error', 'You are not authorized to edit this post.');

      return $this->redirect('/posts');
    }

    if ('GET' === $this->request->method()) {
      return $this->render('app/post/edit', [
        'title' => 'Edit Post',
        'post' => $post,
      ]);
    }

    $post->title = $this->request->getPost('title', '');
    $post->content = $this->request->getPost('content', '');
    $errors = $post->validate(['title', 'content']);
    if (!empty($errors)) {
      return $this->render('app/post/edit', [
        'title' => 'Edit Post',
        'errors' => $errors,
        'post' => $post,
      ]);
    }

    $postRepo->store($post);
    $this->setFlash('success', 'Post updated successfully.');

    return $this->redirect('/posts');
  }

  public function delete(string $id, IPostRepository $postRepo): Response {
    if ('GET' === $this->request->method()) {
      $this->setFlash('error', 'Invalid request method.');

      return $this->redirect('/posts');
    }

    if (!$this->isAuthenticated()) {
      $this->setFlash('error', 'You must be logged in to delete a post.');

      return $this->redirect('/login');
    }

    $post = $postRepo->find($id);
    if (!$post) {
      $this->setFlash('error', 'Post not found.');

      return $this->redirect('/posts');
    }

    if ($post->authorId !== $this->getUser()->id) {
      $this->setFlash('error', 'You are not authorized to delete this post.');

      return $this->redirect('/posts');
    }

    $postRepo->delete($id);
    $this->setFlash('success', 'Post deleted successfully.');

    return $this->redirect('/posts');
  }
}
