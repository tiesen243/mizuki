<main class="container py-4 min-h-[calc(100dvh-3.5rem)] flex items-center justify-center">
  <h1 class="sr-only">Login Page</h1>

  <form class="max-w-2xl w-full md:bg-card md:p-4 rounded-xl md:border md:shadow-sm" method="post">
    <fieldset class="gap-4 has-[>[data-slot=checkbox-group]]:gap-3 has-[>[data-slot=radio-group]]:gap-3 flex flex-col">
      <legend class="mb-1.5 font-medium data-[variant=label]:text-sm data-[variant=legend]:text-base">Login to Your Account</legend>
      <p class="text-muted-foreground text-left text-sm [[data-variant=legend]+&]:-mt-1.5 leading-normal font-normal group-has-[[data-orientation=horizontal]]/field:text-balance">
        Welcome back! Please enter your credentials to access your account.
      </p>

      <div class="gap-5 data-[slot=checkbox-group]:gap-3 [&>[data-slot=field-group]]:gap-4 group/field-group @container/field-group flex w-full flex-col">
        <?php $id = 'identifier';
        $label = 'Username or Email';
        $name = 'identifier';
        $value = isset($old['identifier']) ? htmlspecialchars($old['identifier'], ENT_QUOTES, 'UTF-8') : '';
        $placeholder = 'Enter your username or email';
        $error = isset($errors['identifier']) ? $errors['identifier'] : null;
        include __DIR__.'/../../components/ui/field.php';
        ?>

        <?php $id = 'password';
        $label = 'Password';
        $name = 'password';
        $type = 'password';
        $placeholder = 'Enter your password';
        $error = isset($errors['password']) ? $errors['password'] : null;
        include __DIR__.'/../../components/ui/field.php';
        ?>
      </div>

      <div class="data-[invalid=true]:text-destructive gap-2 group/field flex w-full flex-col [&>*]:w-full [&>.sr-only]:w-auto">
        <?php $type = 'submit';
        $slot = 'Login';
        include __DIR__.'/../../components/ui/button.php';
        ?>
      </div>
    </fieldset>
  </form>
</main>
