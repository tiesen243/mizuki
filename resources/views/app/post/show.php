<main class="container py-4">
  <h1 class="sr-only">Post Details</h1>

  <article class="max-w-prose mx-auto">
    <h2 class="text-2xl font-semibold mb-2"><?= htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8'); ?></h2>
    <p class="text-sm text-muted-foreground mb-4">
      By <?= htmlspecialchars($author->username, ENT_QUOTES, 'UTF-8'); ?> on <?= htmlspecialchars($post->createdAt, ENT_QUOTES, 'UTF-8'); ?>
    </p>

    <div>
      <?= nl2br(htmlspecialchars($post->content, ENT_QUOTES, 'UTF-8')); ?>
    </div>
  </article>
</main>
