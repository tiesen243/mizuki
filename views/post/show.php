<main class="container py-4">
  <article class="card p-4">
    <h1><?php echo htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8'); ?></h1>
    <small><?php echo htmlspecialchars($post->createdAt, ENT_QUOTES, 'UTF-8'); ?></small>
    <p><?php echo nl2br(htmlspecialchars($post->content, ENT_QUOTES, 'UTF-8')); ?></p>
    <a href="/?controller=post&action=index" class="btn btn-secondary">Back to Posts</a>
  </article>
</main>
