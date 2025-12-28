<main class="container py-4">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-semibold">All Posts</h1>

    <?php if ($this->isAuthenticated()) {
      $slot = 'Create Post';
      $as = 'a';
      $attributes = ['href' => '/posts/create'];
      include __DIR__.'/../../components/ui/button.php';
    } ?>
  </div>

  <ul class="grid gap-4 mb-6 md:grid-cols-2 lg:grid-cols-3">
    <?php foreach ($posts as $post) { ?>
      <li class="ring-foreground/10 bg-card text-card-foreground gap-4 overflow-hidden rounded-xl py-4 text-sm ring-1 has-[>img:first-child]:pt-0 data-[size=sm]:gap-3 data-[size=sm]:py-3 *:[img:first-child]:rounded-t-xl *:[img:last-child]:rounded-b-xl group/card flex flex-col">
        <div class="gap-1 rounded-t-xl px-4 group-data-[size=sm]/card:px-3 [.border-b]:pb-4 group-data-[size=sm]/card:[.border-b]:pb-3 group/card-header @container/card-header grid auto-rows-min items-start has-data-[slot=card-action]:grid-cols-[1fr_auto] has-data-[slot=card-description]:grid-rows-[auto_auto]">
          <h2 class="text-base leading-snug font-medium group-data-[size=sm]/card:text-sm"><?= $post->title; ?></h2>
          <p class="text-muted-foreground text-sm"><?= $post->author['username']; ?> - <?= $post->createdAt; ?></p>

          <form action="/posts/<?= $post->id; ?>/delete" method="post" class="col-start-2 row-span-2 row-start-1 self-start justify-self-end">
            <?php if ($this->isAuthenticated() && $this->getUser()->id === $post->author['id']) {
              $slot = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>';
              $type = 'submit';
              $variant = 'ghost';
              $size = 'icon';
              include __DIR__.'/../../components/ui/button.php';
            } ?>
          </form>
        </div>
        <div class="px-4 group-data-[size=sm]/card:px-3">
          <p class="text-sm leading-7 line-clamp-2">
            <?= nl2br(htmlspecialchars($post->content, ENT_QUOTES, 'UTF-8')); ?>
          </p>
        </div>
        <div class="rounded-b-xl px-4 group-data-[size=sm]/card:px-3 [.border-t]:pt-4 group-data-[size=sm]/card:[.border-t]:pt-3 flex items-center justify-end">
          <?php $slot = 'Read More';
      $as = 'a';
      $variant = 'link';
      $attributes = ['href' => '/posts/'.$post->id];
      $class = 'px-0';
      include __DIR__.'/../../components/ui/button.php';
      ?>
        </div>
      </li>
    <?php } ?>
  </ul>
</main>
