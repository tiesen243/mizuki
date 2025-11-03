<main class="container py-4">
  <h1 class="sr-only">Create Post Page</h1>

  <form class="max-w-2xl mx-auto" method="post">
    <fieldset class="flex flex-col gap-6">
      <legend class="mb-4 font-medium">Edit Post</legend>
      <p class="text-muted-foreground text-sm leading-normal font-normal group-has-[[data-orientation=horizontal]]/field:text-balance">
        Update your post details below.
      </p>

      <div class="group/field-group @container/field-group flex w-full flex-col gap-7 data-[slot=checkbox-group]:gap-3 [&>[data-slot=field-group]]:gap-4">
        <?php
        $id = 'title';
        $label = 'Title';
        $name = 'title';
        $value = isset($old['title']) ? htmlspecialchars($old['title'], ENT_QUOTES, 'UTF-8') : $post->title;
        $placeholder = 'Enter post title';
        $error = isset($errors['title']) ? $errors['title'] : null;
        include __DIR__.'/../../components/ui/field.php';
        ?>

        <?php
        $id = 'content';
        $label = 'Content';
        $name = 'content';
        $type = 'textarea';
        $value = isset($old['content']) ? htmlspecialchars($old['content'], ENT_QUOTES, 'UTF-8') : $post->content;
        $placeholder = 'Write your post content here...';
        $error = isset($errors['content']) ? $errors['content'] : null;
        include __DIR__.'/../../components/ui/field.php';
        ?>
      </div>

      <div class="group/field flex w-full gap-3 data-[invalid=true]:text-destructive flex-col [&>*]:w-full [&>.sr-only]:w-auto">
        <?php
        $type = 'submit';
        $slot = 'Save Changes';
        include __DIR__.'/../../components/ui/button.php';
        ?>
      </div>
    </fieldset>
  </form>
</main>
