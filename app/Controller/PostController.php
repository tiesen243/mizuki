<?php

namespace App\Controller;

use App\Contract\Repository\IPostRepository;
use App\Entity\Post;
use Core\Http\Response;
use Core\Kernel\Controller;

class PostController extends Controller
{
    public function index(IPostRepository $postRepo): Response
    {
        $posts = $postRepo->all();
        return $this->render('post/index', [
            'title' => 'All Posts',
            'posts' => $posts
        ]);
    }

    public function show(string $id, IPostRepository $postRepo): Response
    {
        $post = $postRepo->find($id);

        if (!$post) {
            return $this->json(['message' => 'Post not found'], 404);
        } else {
            return $this->render('post/show', [
                'title' => $post->title,
                'post' => $post
            ]);
        }
    }

    public function create(IPostRepository $postRepo): Response
    {
        if ($this->request->method() === 'GET') {
            return $this->render('post/create', [
                'title' => 'Create New Post'
            ]);
        }

        $post = new Post();
        $post->title = $this->request->getPost('title');
        $post->content = $this->request->getPost('content');
        $errors = $post->validate();
        if (!empty($errors)) {
            return $this->redirect('/posts/create', [
                'errors' => $errors,
                'old' => ['title' => $post->title, 'content' => $post->content]
            ]);
        }

        $this->db->beginTransaction();
        try {
            $postRepo->store($post);
            $this->db->commit();
            $this->setFlash('success', 'Post created successfully.');
            return $this->redirect("/posts/{$post->id}");
        } catch (\Throwable $e) {
            $this->db->rollBack();
            $this->setFlash('error', 'Failed to create post: ' . $e->getMessage());
            return $this->redirect('/posts/create');
        }
    }

    public function edit(string $id, IPostRepository $postRepo): Response
    {
        $post = $postRepo->find($id);
        if (!$post) {
            return $this->json(['message' => 'Post not found'], 404);
        }

        if ($this->request->method() === 'GET') {
            return $this->render('post/edit', [
                'title' => 'Edit Post',
                'post' => $post
            ]);
        }

        $post->title = $this->request->getPost('title');
        $post->content = $this->request->getPost('content');
        $errors = $post->validate();
        if (!empty($errors)) {
            return $this->redirect("/posts/{$id}/edit", [
                'errors' => $errors,
                'old' => ['title' => $post->title, 'content' => $post->content]
            ]);
        }

        $this->db->beginTransaction();
        try {
            $postRepo->store($post);
            $this->db->commit();
            $this->setFlash('success', 'Post updated successfully.');
            return $this->redirect("/posts/{$post->id}");
        } catch (\Throwable $e) {
            $this->db->rollBack();
            $this->setFlash('error', 'Failed to update post: ' . $e->getMessage());
            return $this->redirect("/posts/{$id}/edit");
        }
    }

    public function delete(string $id, IPostRepository $postRepo): Response
    {
        $this->db->beginTransaction();
        try {
            $postRepo->delete($id);
            $this->db->commit();
            $this->setFlash('success', 'Post deleted successfully.');
            return $this->redirect('/posts');
        } catch (\Throwable $e) {
            $this->db->rollBack();
            $this->setFlash('error', 'Failed to delete post: ' . $e->getMessage());
            return $this->redirect('/posts');
        }
    }
}
