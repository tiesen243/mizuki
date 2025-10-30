<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- SEO -->
    <title><?php echo $title ? "$title | ".getConfig()['app']['name'] : getConfig()['app']['name']; ?></title>
    <meta name="description" content="<?php echo $description ? $description : getConfig()['app']['description']; ?>">

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
    <?php echo $content; ?>
  </body>
</html>
