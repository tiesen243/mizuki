<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- SEO -->
    <title><?php
      if (isset($title) && $title) {
          echo $title . ' | ' . getConfig()['app']['name'];
      } else {
          echo getConfig()['app']['name'];
      }
    ?></title>
    <meta name="description" content="<?php
      if (isset($meta_description) && $meta_description) {
          echo $meta_description;
      } else {
          echo getConfig()['app']['description'];
      }
    ?>">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Geist:wght@100..900&display=swap" rel="stylesheet">

    <!-- vite -->
    <?php echo vite_entry_client(); ?>
    <?php echo vite_entry_script('main'); ?>
    <?php echo vite_entry_link('main'); ?>
  </head>

  <body class="flex flex-col min-h-dvh antialiased font-sans">
    <header class="bg-background/70 h-14 flex items-center border-b sticky inset-0">
      <div class="container flex items-center justify-between gap-4">
        <a href="/" class="text-lg font-bold"><?php echo getConfig()['app']['name']; ?></a>
        <nav class="flex-1 flex items-center justify-end gap-4 text-sm font-medium [&_a]:hover:underline">
          <a href="/">Home</a>
          <a href="/?controller=post&action=index">Posts</a>
        </nav>
        <button id="toggle-theme" class="inline-flex items-center justify-center size-9 rounded-md [&_svg]:size-4 hover:bg-accent hover:text-accent-foreground transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sun-icon lucide-sun"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
          <span class="sr-only">Toggle Theme</span>
        </button>
      </div>
    </header>

    <?php echo $content; ?>
  </body>
</html>
