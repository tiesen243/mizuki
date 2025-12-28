<?php
if (isset($__data) && is_array($__data)) {
  extract($__data, EXTR_SKIP);
}

$type ??= 'text';
?>

<div
  data-invalid="<?= isset($error) && $error ? 'true' : 'false'; ?>"
  class="data-[invalid=true]:text-destructive gap-2 group/field flex w-full flex-col [&>*]:w-full [&>.sr-only]:w-auto <?= isset($containerClass) ? htmlspecialchars($containerClass) : ''; ?>"
>
  <label
    for="<?= isset($id) ? htmlspecialchars($id) : ''; ?>"
    class="has-data-checked:bg-primary/5 has-data-checked:border-primary dark:has-data-checked:bg-primary/10 gap-2 group-data-[disabled=true]/field:opacity-50 has-[>[data-slot=field]]:rounded-lg has-[>[data-slot=field]]:border [&>*]:data-[slot=field]:p-2.5 group/field-label peer/field-label flex w-fit leading-snug has-[>[data-slot=field]]:w-full has-[>[data-slot=field]]:flex-col <?= isset($labelClass) ? htmlspecialchars($labelClass) : ''; ?>"
  >
    <?= isset($label) ? htmlspecialchars($label) : ''; ?>
  </label>

  <?php if ('textarea' === $type) { ?>
    <textarea
      id="<?= isset($id) ? htmlspecialchars($id) : ''; ?>"
      name="<?= isset($name) ? htmlspecialchars($name) : ''; ?>"
      placeholder="<?= isset($placeholder) ? htmlspecialchars($placeholder) : ''; ?>"
      aria-invalid="<?= isset($error) && $error ? 'true' : 'false'; ?>"
      class="border-input dark:bg-input/30 focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive dark:aria-invalid:border-destructive/50 disabled:bg-input/50 dark:disabled:bg-input/80 rounded-lg border bg-transparent px-2.5 py-2 text-base transition-colors focus-visible:ring-[3px] aria-invalid:ring-[3px] md:text-sm placeholder:text-muted-foreground flex field-sizing-content min-h-16 w-full outline-none disabled:cursor-not-allowed disabled:opacity-50 <?= isset($inputClass) ? htmlspecialchars($inputClass) : ''; ?>"
      <?= isset($required) && $required ? 'required' : ''; ?>
    ><?= isset($value) ? htmlspecialchars($value) : ''; ?></textarea>
  <?php } else { ?>
    <input
      id="<?= isset($id) ? htmlspecialchars($id) : ''; ?>"
      name="<?= isset($name) ? htmlspecialchars($name) : ''; ?>"
      type="<?= isset($type) ? htmlspecialchars($type) : 'text'; ?>"
      value="<?= isset($value) ? htmlspecialchars($value) : ''; ?>"
      placeholder="<?= isset($placeholder) ? htmlspecialchars($placeholder) : ''; ?>"
      aria-invalid="<?= isset($error) && $error ? 'true' : 'false'; ?>"
      class="dark:bg-input/30 border-input focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive dark:aria-invalid:border-destructive/50 disabled:bg-input/50 dark:disabled:bg-input/80 h-8 rounded-lg border bg-transparent px-2.5 py-1 text-base transition-colors file:h-6 file:text-sm file:font-medium focus-visible:ring-[3px] aria-invalid:ring-[3px] md:text-sm file:text-foreground placeholder:text-muted-foreground w-full min-w-0 outline-none file:inline-flex file:border-0 file:bg-transparent disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 <?= isset($inputClass) ? htmlspecialchars($inputClass) : ''; ?>"
      <?= isset($required) && $required ? 'required' : ''; ?>
    />
  <?php } ?>

  <?php if (isset($error) && $error) { ?>
    <p class="text-destructive text-sm font-normal"><?= htmlspecialchars($error); ?></p>
  <?php } ?>
</div>

<?php
unset($type, $containerClass, $labelClass, $inputClass, $id, $name, $placeholder, $value, $error, $label, $required);
?>
