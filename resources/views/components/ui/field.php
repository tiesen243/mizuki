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

  <?php if (isset($error) && $error) { ?>
    <p class="text-destructive text-sm font-normal"><?= htmlspecialchars($error); ?></p>
  <?php } ?>
</div>
