<main class="container py-4">
  <h1 class="sr-only">Post Details</h1>

  <div class="flex items-center justify-between mb-6">
    <?php $as = 'a';
    $slot = 'Back to Posts';
    $variant = 'link';
    $size = 'sm';
    $attributes = ['href' => '/posts'];
    include __DIR__.'/../../components/ui/button.php';
    ?>

    <?php if ($this->isAuthenticated() && $this->getUser()->id === $post->author['id']) {
      $as = 'a';
      $slot = 'Edit Post';
      $attributes = ['href' => '/posts/'.$post->id.'/edit'];
      include __DIR__.'/../../components/ui/button.php';
    } ?>
  </div>

  <article class="max-w-prose mx-auto">
    <h2 class="my-5 scroll-m-20 text-3xl font-bold tracking-tight text-balance first:mt-0">
      <?= htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8'); ?>
    </h2>
    <p class="leading-7 text-pretty [&:not(:first-child)]:mt-2 text-sm text-muted-foreground">
      By <?= htmlspecialchars($post->author['username'], ENT_QUOTES, 'UTF-8'); ?> on <?= htmlspecialchars($post->createdAt, ENT_QUOTES, 'UTF-8'); ?>
    </p>

    <hr class="my-6" />

    <section>
      <?= nl2br(htmlspecialchars($post->content, ENT_QUOTES, 'UTF-8')); ?>
    </div>
  </article>
</main>
