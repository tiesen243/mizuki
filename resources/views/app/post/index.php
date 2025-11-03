<main class="container py-4">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-semibold">All Posts</h1>
    <?php
    $slot = 'Create Post';
    $as = 'a';
    $attributes = ['href' => '/posts/create'];
    include __DIR__.'/../../components/ui/button.php';
    ?>
  </div>

  <section class="grid gap-4 mb-6 md:grid-cols-2 lg:grid-cols-3">
    <?php foreach ($posts as $post) { ?>
      <article class="bg-card text-card-foreground flex flex-col gap-6 rounded-xl border py-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-2 px-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6">
          <h2 class="leading-none font-semibold"><?= $post->title; ?></h2>
          <p class="text-muted-foreground text-sm"><?= $post->author['username']; ?> - <?= $post->createdAt; ?></p>
          <form action="/posts/<?= $post->id; ?>/delete" method="post" class="col-start-2 row-span-2 row-start-1 self-start justify-self-end">
            <?php
              if ($this->isAuthenticated() && $this->getUser()->id === $post->author['id']) {
                $slot = 'X';
                $type = 'submit';
                $variant = 'ghost';
                $size = 'icon';
                include __DIR__.'/../../components/ui/button.php';
              }
      ?>
          </form>
        </div>
        <div class="px-6">
          <p class="text-sm leading-normal line-clamp-2">
            <?= nl2br(htmlspecialchars($post->content, ENT_QUOTES, 'UTF-8')); ?>
          </p>
        </div>
        <div class="flex items-center justify-end px-6 [.border-t]:pt-6">
      <?php
      $slot = 'Read More';
      $as = 'a';
      $variant = 'link';
      $attributes = ['href' => '/posts/'.$post->id];
      include __DIR__.'/../../components/ui/button.php';
      ?>
        </div>
      </article>
    <?php } ?>
  </section>
</main>
