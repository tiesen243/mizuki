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

    public function show(IPostRepository $postRepo): Response
    {
        $id = $this->request->getQuery('id');
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
        if ($this->request->method() === 'POST') {
            $post = new Post();
            $post->title = $this->request->getPost('title');
            $post->content = $this->request->getPost('content');
            $postRepo->create($post);
            return $this->redirect('?controller=post&action=index');
        }

        return $this->render('post/create', [
            'title' => 'Create New Post'
        ]);
    }

    public function delete(IPostRepository $postRepo): Response
    {
        $id = $this->request->getQuery('id');
        $postRepo->delete($id);
        return $this->redirect('?controller=post&action=index');
    }
}
