<?php if (isset($flash) && $flash) { ?>
<div
  id="toast-message"
  class="fixed top-4 right-4 border rounded-lg transition-[opacity,translate] ease-linear z-50 p-3 cursor-pointer shadow-lg flex items-center gap-2 [&_svg]:size-4 bg-(--toast-bg) border-(--toast-border) text-(--toast-text)"
  style="<?php switch ($flash['type']) {
    case 'success':
      echo '--toast-bg: color-mix(in oklab, var(--success) 20%, var(--background)); --toast-border: color-mix(in oklab, var(--success) 40%, var(--background)); --toast-text: var(--success);';
      break;
    case 'error':
      echo '--toast-bg: color-mix(in oklab, var(--destructive) 20%, var(--background)); --toast-border: color-mix(in oklab, var(--destructive) 40%, var(--background)); --toast-text: var(--destructive);';
      break;
    case 'info':
      echo '--toast-bg: color-mix(in oklab, var(--info) 20%, var(--background)); --toast-border: color-mix(in oklab, var(--info) 40%, var(--background)); --toast-text: var(--info);';
      break;
    case 'warn':
      echo '--toast-bg: color-mix(in oklab, var(--warning) 20%, var(--background)); --toast-border: color-mix(in oklab, var(--warning) 40%, var(--background)); --toast-text: var(--warning);';
      break;
    default:
      echo '--toast-bg: var(--popover); --toast-border: var(--border); --toast-text: var(--popover-foreground);';
      break;
  } ?>"
>
  <?php if ('success' === $flash['type']) { ?>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
  <?php } elseif ('error' === $flash['type']) { ?>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert-icon lucide-circle-alert"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
  <?php } elseif ('info' === $flash['type']) { ?>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
  <?php } elseif ('warn' === $flash['type']) { ?>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert-icon lucide-triangle-alert"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
  <?php } ?>

  <p class="text-sm font-medium"><?= htmlspecialchars($flash['message'], ENT_QUOTES, 'UTF-8'); ?></p>
</div>
<?php } ?>
