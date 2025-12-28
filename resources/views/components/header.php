<?php
$navItems = [
  ['label' => 'Home', 'url' => '/'],
  ['label' => 'About', 'url' => '/about'],
  ['label' => 'Posts', 'url' => '/posts'],
];
?>

<header class="bg-background/70 h-14 flex items-center border-b sticky backdrop-blur-2xl backdrop-saturate-150 inset-0">
  <nav class="container flex items-center justify-between gap-4">
    <a href="/" class="text-lg font-bold"><?= getConfig()['app']['name']; ?></a>

    <ul class="flex-1 flex items-center justify-center gap-4 text-sm font-medium">
      <?php foreach ($navItems as $item) { ?>
        <li>
          <a href="<?= $item['url']; ?>" class="hover:underline"><?= $item['label']; ?></a>
        </li>
      <?php } ?>
    </ul>

    <div class="flex items-center gap-2 text-sm font-medium">
      <?php if (isset($_SESSION['user'])) { ?>
        <form action="/logout" method="POST" onsubmit="return confirm('Are you sure you want to logout?');">
          <button><?= $_SESSION['user']->username; ?></button>
        </form>
      <?php } else { ?>
        <a href="/login" class="hover:underline">Login</a>
        <span>/</span>
        <a href="/register" class="hover:underline">Register</a>
      <?php } ?>
    </div>
    <button id="toggle-theme" class="inline-flex items-center justify-center size-8 rounded-md [&_svg]:size-4 hover:bg-accent dark:hover:bg-input hover:text-accent-foreground dark:hover:text-foreground transition-colors">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sun-icon lucide-sun"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-moon-icon lucide-moon"><path d="M20.985 12.486a9 9 0 1 1-9.473-9.472c.405-.022.617.46.402.803a6 6 0 0 0 8.268 8.268c.344-.215.825-.004.803.401"/></svg>
      <span class="sr-only">Toggle Theme</span>
    </button>
  </nav>
</header>
