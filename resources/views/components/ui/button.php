<?php

if (isset($__data) && is_array($__data)) {
  extract($__data, EXTR_SKIP);
}

$baseClasses = "focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive dark:aria-invalid:border-destructive/50 rounded-lg border border-transparent bg-clip-padding text-sm font-medium focus-visible:ring-[3px] aria-invalid:ring-[3px] [&_svg:not([class*='size-'])]:size-4 inline-flex items-center justify-center whitespace-nowrap transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none shrink-0 [&_svg]:shrink-0 outline-none group/button select-none";

$variants = [
  'default' => 'bg-primary text-primary-foreground [a]:hover:bg-primary/80',
  'outline' => 'border-border bg-background hover:bg-muted hover:text-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 aria-expanded:bg-muted aria-expanded:text-foreground',
  'secondary' => 'bg-secondary text-secondary-foreground hover:bg-secondary/80 aria-expanded:bg-secondary aria-expanded:text-secondary-foreground',
  'ghost' => 'hover:bg-muted hover:text-foreground dark:hover:bg-muted/50 aria-expanded:bg-muted aria-expanded:text-foreground',
  'success' => 'bg-success/10 hover:bg-success/20 focus-visible:ring-success/20 dark:focus-visible:ring-success/40 dark:bg-success/20 text-success focus-visible:border-success/40 dark:hover:bg-success/30',
  'info' => 'bg-info/10 hover:bg-info/20 focus-visible:ring-info/20 dark:focus-visible:ring-info/40 dark:bg-info/20 text-info focus-visible:border-info/40 dark:hover:bg-info/30',
  'destructive' => 'bg-destructive/10 hover:bg-destructive/20 focus-visible:ring-destructive/20 dark:focus-visible:ring-destructive/40 dark:bg-destructive/20 text-destructive focus-visible:border-destructive/40 dark:hover:bg-destructive/30',
  'warning' => 'bg-warning/10 hover:bg-warning/20 focus-visible:ring-warning/20 dark:focus-visible:ring-warning/40 dark:bg-warning/20 text-warning focus-visible:border-warning/40 dark:hover:bg-warning/30',
  'link' => 'text-primary underline-offset-4 hover:underline',
];

$sizes = [
  'default' => 'h-8 gap-1.5 px-2.5 has-data-[icon=inline-end]:pr-2 has-data-[icon=inline-start]:pl-2',
  'xs' => "h-6 gap-1 rounded-[min(var(--radius-md),10px)] px-2 text-xs in-data-[slot=button-group]:rounded-lg has-data-[icon=inline-end]:pr-1.5 has-data-[icon=inline-start]:pl-1.5 [&_svg:not([class*='size-'])]:size-3",
  'sm' => "h-7 gap-1 rounded-[min(var(--radius-md),12px)] px-2.5 text-[0.8rem] in-data-[slot=button-group]:rounded-lg has-data-[icon=inline-end]:pr-1.5 has-data-[icon=inline-start]:pl-1.5 [&_svg:not([class*='size-'])]:size-3.5",
  'lg' => 'h-9 gap-1.5 px-2.5 has-data-[icon=inline-end]:pr-3 has-data-[icon=inline-start]:pl-3',
  'icon' => 'size-8',
  'icon-xs' => "size-6 rounded-[min(var(--radius-md),10px)] in-data-[slot=button-group]:rounded-lg [&_svg:not([class*='size-'])]:size-3",
  'icon-sm' => 'size-7 rounded-[min(var(--radius-md),12px)] in-data-[slot=button-group]:rounded-lg',
  'icon-lg' => 'size-9',
];

$variantClass = isset($variant) && array_key_exists($variant, $variants) ? $variants[$variant] : $variants['default'];
$sizeClass = isset($size) && array_key_exists($size, $sizes) ? $sizes[$size] : $sizes['default'];
$additionalClasses = isset($class) ? ' '.htmlspecialchars($class) : '';
$finalClasses = $baseClasses.' '.$variantClass.' '.$sizeClass.$additionalClasses;
$comp = isset($as) ? $as : 'button';

?>

<?= "<{$comp}"; ?>
  type="<?= isset($type) ? htmlspecialchars($type) : 'button'; ?>"
  class="<?= $finalClasses; ?>"
  <?= isset($disabled) && $disabled ? 'disabled' : ''; ?>
  <?php if (isset($attributes) && is_array($attributes)) {
    foreach ($attributes as $attrName => $attrValue) {
      echo htmlspecialchars($attrName).'="'.htmlspecialchars($attrValue).'" ';
    }
  } ?>
>
  <?= isset($slot) ? $slot : ''; ?>
</<?= $comp; ?>>

<?php
unset($variant, $size, $class, $type, $disabled, $as, $attributes, $slot);
?>
