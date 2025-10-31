<main class="container py-4">
  <a href="/" class="inline-flex items-center justify-center h-9 px-3 rounded-md text-sm font-medium hover:bg-accent hover:text-accent-foreground mb-6">
    &larr; Back to Home
  </a>

  <h1 class="sr-only">Blog Posts</h1>

  <div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold">Blog Posts</h2>
    <a href="/?controller=post&action=create" class="inline-flex items-center justify-center h-9 px-3 bg-primary text-primary-foreground text-sm font-medium rounded-md hover:bg-primary/80 transition-colors">
      Create New Post
    </a>
  </div>

  <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($posts as $post): ?>
      <div class="bg-card text-card-foreground flex flex-col gap-6 py-6 rounded-xl shadow-md border">
        <div class="px-6 flex flex-col">
          <h3 class="font-medium text-lg"><?php echo htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8'); ?></h3>
          <p class="text-sm text-muted-foreground line-clamp-1"><?php echo nl2br(htmlspecialchars($post->content, ENT_QUOTES, 'UTF-8')); ?></p>
        </div>
        <div class="px-6 grid grid-cols-2 gap-4">
          <a
            href="/?controller=post&action=show&id=<?php echo $post->id; ?>"
            class="inline-flex items-center justify-center h-9 px-3 rounded-md bg-secondary text-secondary-foreground text-sm font-medium hover:bg-secondary/80 transition-colors"
          >
            Read More
          </a>
          <a
            href="/?controller=post&action=delete&id=<?php echo $post->id; ?>"
            class="inline-flex items-center justify-center h-9 px-3 rounded-md bg-destructive text-white text-sm font-medium hover:bg-destructive/80 transition-colors"
            onclick="return confirm('Are you sure you want to delete this post?');"
          >
            Delete
          </a>
        </div>
      </div>
    <?php endforeach; ?>
  </section>
</main>
