<main class="container py-4">
  <form method="post">
    <fieldset class="flex flex-col gap-6">
      <legend class="mb-3 font-medium">Create New Post</legend>
      <p class="text-muted-foreground text-sm leading-normal font-normal group-has-[[data-orientation=horizontal]]/field:text-balance">Fill in the details below to create a new blog post.</p>

      <div class="group/field-group @container/field-group flex w-full flex-col gap-7 data-[slot=checkbox-group]:gap-3 [&>[data-slot=field-group]]:gap-4">
        <div class="group/field flex w-full gap-3 data-[invalid=true]:text-destructive flex-col [&>*]:w-full [&>.sr-only]:w-auto">
          <label for="title" class="group/field-label peer/field-label flex w-fit gap-2 leading-snug group-data-[disabled=true]/field:opacity-50">Title</label>
          <input type="text" class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]" id="title" name="title" required>
        </div>

        <div class="group/field flex w-full gap-3 data-[invalid=true]:text-destructive flex-col [&>*]:w-full [&>.sr-only]:w-auto">
          <label for="content" class="group/field-label peer/field-label flex w-fit gap-2 leading-snug group-data-[disabled=true]/field:opacity-50">Content</label>
          <textarea class="border-input placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive dark:bg-input/30 flex field-sizing-content min-h-16 w-full rounded-md border bg-transparent px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" id="content" name="content" rows="5" required></textarea>
        </div>

        <div class="group/field flex w-full gap-3 data-[invalid=true]:text-destructive flex-col [&>*]:w-full [&>.sr-only]:w-auto">
          <button type="submit" class="inline-flex items-center justify-center h-9 px-3 rounded-md bg-primary text-primary-foreground text-sm font-medium hover:bg-primary/90 transition-colors">Create Post</button>
        </div>
      </div>
    </fieldset>
  </form>
</main>
