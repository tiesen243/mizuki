<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- SEO -->
    <title><?php
      if (isset($title) && $title) {
        echo $title.' | '.getConfig()['app']['name'];
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
    <?= vite_entry_client(); ?>
    <?= vite_entry_script('main'); ?>
    <?= vite_entry_link('main'); ?>
  </head>

  <body class="flex flex-col min-h-dvh antialiased font-sans">
    <?php include __DIR__.'/../components/header.php'; ?>

    <?= $content; ?>

    <?php include __DIR__.'/../components/toaster.php'; ?>
  </body>
</html>
