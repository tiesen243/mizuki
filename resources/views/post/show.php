<main class="container py-4">
  <div class="flex items-center justify-between mb-4">
    <a href="/posts" class="inline-flex items-center justify-center h-9 px-3 rounded-md text-sm font-medium hover:bg-accent hover:text-accent-foreground mb-6">
      &larr; Back to Posts
    </a>
    <a href="/posts/<?= urlencode($post->id); ?>/edit" class="inline-flex items-center justify-center h-9 px-3 rounded-md bg-primary text-primary-foreground text-sm font-medium hover:bg-primary/90 transition-colors">
      Edit Post
    </a>
  </div>

  <article class="max-w-prose mx-auto flex flex-col gap-4">
    <h1 class="text-2xl font-bold"><?= htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8'); ?></h1>
    <small class="text-sm text-muted-foreground"><?= htmlspecialchars($post->createdAt, ENT_QUOTES, 'UTF-8'); ?></small>
    <hr class="my-4">

    <p><?= nl2br(htmlspecialchars($post->content, ENT_QUOTES, 'UTF-8')); ?></p>
  </article>
</main>
