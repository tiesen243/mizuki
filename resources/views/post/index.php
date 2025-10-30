<main class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="m-0">Blog Posts</h2>
    <a href="/?controller=post&action=create" class="btn btn-success">Create New Post</a>
  </div>

  <section class="d-flex flex-column gap-4">
    <?php foreach ($posts as $post): ?>
      <div class="card p-4">
        <h1><?php echo htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8'); ?></h1>
        <p><?php echo nl2br(htmlspecialchars($post->content, ENT_QUOTES, 'UTF-8')); ?></p>
        <div class="d-flex gap-4">
          <a href="/?controller=post&action=show&id=<?php echo $post->id; ?>" class="w-100 btn btn-primary">Read More</a>
          <a href="/?controller=post&action=delete&id=<?php echo $post->id; ?>" class="w-100 btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
        </div>
      </div>
    <?php endforeach; ?>
  </section>
</main>
