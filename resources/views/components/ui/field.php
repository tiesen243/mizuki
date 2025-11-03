<?php
if (isset($__data) && is_array($__data)) {
  extract($__data, EXTR_SKIP);
}
?>

<div
  data-invalid="<?= isset($error) && $error ? 'true' : 'false'; ?>"
  class="group/field flex w-full gap-3 data-[invalid=true]:text-destructive flex-col [&>*]:w-full [&>.sr-only]:w-auto <?= isset($containerClass) ? htmlspecialchars($containerClass) : ''; ?>"
>
  <label
    for="<?= isset($id) ? htmlspecialchars($id) : ''; ?>"
    class="group/field-label peer/field-label flex w-fit gap-2 leading-snug group-data-[disabled=true]/field:opacity-50 <?= isset($labelClass) ? htmlspecialchars($labelClass) : ''; ?>"
  >
    <?= isset($label) ? htmlspecialchars($label) : ''; ?>
  </label>

  <?php if ('textarea' === $type) { ?>
    <textarea
      id="<?= isset($id) ? htmlspecialchars($id) : ''; ?>"
      name="<?= isset($name) ? htmlspecialchars($name) : ''; ?>"
      placeholder="<?= isset($placeholder) ? htmlspecialchars($placeholder) : ''; ?>"
      aria-invalid="<?= isset($error) && $error ? 'true' : 'false'; ?>"
      class="border-input placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive dark:bg-input/30 flex field-sizing-content min-h-16 w-full rounded-md border bg-transparent px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
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
      class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive <?= isset($inputClass) ? htmlspecialchars($inputClass) : ''; ?>"
      <?= isset($required) && $required ? 'required' : ''; ?>
    />
  <?php } ?>

  <?php if (isset($error) && $error) { ?>
    <p class="text-destructive text-sm font-normal"><?= htmlspecialchars($error); ?></p>
  <?php } ?>
</div>

<?php
unset($id, $label, $name, $type, $value, $placeholder, $error, $containerClass, $labelClass, $inputClass);
?>
