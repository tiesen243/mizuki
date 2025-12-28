<main class="container py-4 flex min-h-[calc(100dvh-3.5rem)] items-center justify-center">
  <h1 class="sr-only">Create Post Page</h1>

  <form class="max-w-2xl w-full md:bg-card md:p-4 rounded-xl md:border md:shadow-sm" method="post">
    <fieldset class="gap-4 has-[>[data-slot=checkbox-group]]:gap-3 has-[>[data-slot=radio-group]]:gap-3 flex flex-col">
      <legend class="mb-1.5 font-medium data-[variant=label]:text-sm data-[variant=legend]:text-base">Create a New Post</legend>
      <p class="text-muted-foreground text-left text-sm [[data-variant=legend]+&]:-mt-1.5 leading-normal font-normal group-has-[[data-orientation=horizontal]]/field:text-balance">
        Share your thoughts by creating a new post.
      </p>

      <div class="gap-5 data-[slot=checkbox-group]:gap-3 [&>[data-slot=field-group]]:gap-4 group/field-group @container/field-group flex w-full flex-col">
        <?php $id = 'title';
        $label = 'Title';
        $name = 'title';
        $value = isset($old['title']) ? htmlspecialchars($old['title'], ENT_QUOTES, 'UTF-8') : '';
        $placeholder = 'Enter post title';
        $error = isset($errors['title']) ? $errors['title'] : null;
        include __DIR__.'/../../components/ui/field.php';
        ?>

        <?php $id = 'content';
        $label = 'Content';
        $name = 'content';
        $type = 'textarea';
        $value = isset($old['content']) ? htmlspecialchars($old['content'], ENT_QUOTES, 'UTF-8') : '';
        $placeholder = 'Write your post content here...';
        $error = isset($errors['content']) ? $errors['content'] : null;
        include __DIR__.'/../../components/ui/field.php';
        ?>
      </div>

      <div class="data-[invalid=true]:text-destructive gap-2 group/field flex w-full flex-col [&>*]:w-full [&>.sr-only]:w-auto">
        <?php
        $type = 'submit';
        $slot = 'Create Post';
        include __DIR__.'/../../components/ui/button.php';
        ?>
      </div>
    </fieldset>
  </form>
</main>
