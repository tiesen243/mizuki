<?php
$features = [
  [
    'title' => 'Feature One',
    'description' => 'Discover powerful tools to organize your workflow efficiently.',
  ],
  [
    'title' => 'Feature Two',
    'description' => 'Collaborate with your team and achieve more together.',
  ],
  [
    'title' => 'Feature Three',
    'description' => 'Track your progress and reach your goals with ease.',
  ],
];
?>
<main class="container py-8">
  <h1 class="sr-only">Mizuki Home Page</h1>

  <section class="text-center">
    <h2 class="text-4xl font-bold mb-4">Welcome to Mizuki</h1>
    <p class="text-lg text-muted-foreground">Your one-stop platform for productivity and creativity.</p>

    <section class="grid grid-cols-1 md:grid-cols-3 gap-8 my-12">
      <?php foreach ($features as $feature) { ?>
        <div class="bg-card text-card-foreground hover:border-primary hover:bg-primary/10 hover:text-primary transition-colors flex flex-col gap-2 rounded-xl shadow-sm border p-4">
          <h3 class="text-2xl font-semibold"><?= htmlspecialchars($feature['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
          <p class="text-muted-foreground"><?= htmlspecialchars($feature['description'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
      <?php } ?>
    </section>

    <section class="flex flex-col md:flex-row items-center justify-between bg-primary/10 border-primary border rounded-lg p-8">
      <div class="mb-6 md:mb-0 flex flex-col items-center md:items-start">
        <h3 class="text-xl font-bold text-primary mb-2">Ready to get started?</h3>
        <p class="text-muted-foreground">Sign up now and boost your productivity!</p>
      </div>
      <a href="/posts" class="inline-flex items-center justify-center gap-2 h-9 bg-primary hover:bg-primary/80 text-primary-foreground px-3 rounded-lg font-medium transition-colors">
        Get Started
      </a>
    </section>
  </section>
</main>
