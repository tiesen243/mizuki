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

    public function all(IPostRepository $postRepo): Response
    {
        $posts = $postRepo->all();
        return $this->json(['message' => 'Posts retrieved successfully', 'posts' => array_map(fn ($post) => $post->toArray(), $posts)]);
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

    public function one(string $id, IPostRepository $postRepo): Response
    {
        $post = $postRepo->find($id);

        if (!$post) {
            return $this->json(['message' => 'Post not found'], 404);
        } else {
            return $this->json(['message' => 'Post found', 'post' => $post->toArray()]);
        }
    }

    public function create(IPostRepository $postRepo): Response
    {
        if ($this->request->method() === 'POST') {
            $post = new Post();
            $post->title = $this->request->getPost('title');
            $post->content = $this->request->getPost('content');
            $postRepo->store($post);

            $this->setFlash('success', 'Post created successfully.');
            return $this->redirect("/posts/{$post->id}");
        }

        return $this->render('post/create', [
            'title' => 'Create New Post'
        ]);
    }

    public function store(IPostRepository $postRepo): Response
    {
        $post = new Post();
        $post->title = $this->request->getPost('title');
        $post->content = $this->request->getPost('content');
        $postRepo->store($post);
        return $this->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }

    public function update(string $id, IPostRepository $postRepo): Response
    {
        $post = $postRepo->find($id);

        if (!$post) {
            return $this->json(['message' => 'Post not found'], 404);
        }

        $post->title = $this->request->getPost('title', $post->title);
        $post->content = $this->request->getPost('content', $post->content);
        $postRepo->store($post);

        return $this->json(['message' => 'Post updated successfully', 'post' => $post]);
    }

    public function delete(string $id, IPostRepository $postRepo): Response
    {
        $postRepo->delete($id);
        $this->setFlash('success', 'Post deleted successfully.');
        return $this->redirect('/posts');
    }

    public function destroy(string $id, IPostRepository $postRepo): Response
    {
        $postRepo->delete($id);
        return $this->json(['message' => 'Post deleted successfully']);
    }
}
