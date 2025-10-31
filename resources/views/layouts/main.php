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
    <meta name="author" content="<?php echo getConfig()['app']['author']; ?>">
    <meta name="keywords" content="blog, blogging, mizuki, php, lightweight, open-source">
    <meta name="robots" content="index, follow">

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
    <header class="bg-background/70 h-14 flex items-center border-b sticky backdrop-blur-2xl backdrop-saturate-150 inset-0">
      <div class="container flex items-center justify-between gap-4">
        <a href="/" class="text-lg font-bold"><?php echo getConfig()['app']['name']; ?></a>
        <nav class="flex-1 flex items-center justify-end gap-4 text-sm font-medium [&_a]:hover:underline [&_a]:underline-offset-4">
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

    <?php if (isset($flash) && $flash): ?>
      <div id="toast-message" class="fixed backdrop-blur-xl top-4 right-4 border rounded-lg transition-[opacity,translate] ease-linear z-50 px-4 py-3 cursor-pointer shadow-lg flex items-center gap-2 [&_svg]:size-5 <?php
        switch ($flash['type']) {
            case 'success':
                echo "bg-success/10 border-success text-success";
                break;
            case 'error':
                echo "bg-destructive/10 border-destructive text-destructive";
                break;
            case 'info':
                echo "bg-info/10 border-info text-info";
                break;
            case 'warn':
                echo "bg-warn/10 border-warning text-warning";
                break;
            default:
                echo "bg-muted-foreground/10 border-muted-foreground text-muted-foreground";
                break;
        }?>">
        <?php if ($flash['type'] === 'success'): ?>
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
        <?php elseif ($flash['type'] === 'error'): ?>
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert-icon lucide-circle-alert"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
        <?php elseif ($flash['type'] === 'info'): ?>
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
        <?php elseif ($flash['type'] === 'warn'): ?>
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert-icon lucide-triangle-alert"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
        <?php endif; ?>
        <p class="text-sm font-medium">
          <?php echo htmlspecialchars($flash['message'], ENT_QUOTES, 'UTF-8'); ?>
        </p>
      </div>
    <?php endif; ?>
  </body>
</html>
