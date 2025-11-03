<main class="container py-4 min-h-[calc(100dvh-3.5rem)] flex items-center justify-center">
  <h1 class="sr-only">Register Page</h1>

  <form class="max-w-md" method="post">
    <fieldset class="flex flex-col gap-6">
      <legend class="mb-4 font-medium">Register to Your Account</legend>
      <p class="text-muted-foreground text-sm leading-normal font-normal group-has-[[data-orientation=horizontal]]/field:text-balance">
        Welcome! Please enter your details to create a new account.
      </p>

      <div class="group/field-group @container/field-group flex w-full flex-col gap-7 data-[slot=checkbox-group]:gap-3 [&>[data-slot=field-group]]:gap-4">
        <?php
        $id = 'username';
        $label = 'Username';
        $name = 'username';
        $value = isset($old['username']) ? htmlspecialchars($old['username'], ENT_QUOTES, 'UTF-8') : '';
        $placeholder = 'Enter your username';
        $error = isset($errors['username']) ? $errors['username'] : null;
        include __DIR__.'/../../components/ui/field.php';
        ?>

        <?php
        $id = 'email';
        $label = 'Email';
        $name = 'email';
        $type = 'email';
        $value = isset($old['email']) ? htmlspecialchars($old['email'], ENT_QUOTES, 'UTF-8') : '';
        $placeholder = 'Enter your email';
        $error = isset($errors['email']) ? $errors['email'] : null;
        include __DIR__.'/../../components/ui/field.php';
        ?>

        <?php
        $id = 'password';
        $label = 'Password';
        $name = 'password';
        $type = 'password';
        $placeholder = 'Enter your password';
        $error = isset($errors['password']) ? $errors['password'] : null;
        include __DIR__.'/../../components/ui/field.php';
        ?>


        <?php
        $id = 'confirm_password';
        $label = 'Confirm Password';
        $name = 'confirm_password';
        $type = 'password';
        $placeholder = 'Confirm your password';
        $error = isset($errors['confirm_password']) ? $errors['confirm_password'] : null;
        include __DIR__.'/../../components/ui/field.php';
        ?>
      </div>

      <div class="group/field flex w-full gap-3 data-[invalid=true]:text-destructive flex-col [&>*]:w-full [&>.sr-only]:w-auto">
        <?php
        $type = 'submit';
        $slot = 'Register';
        include __DIR__.'/../../components/ui/button.php';
        ?>
      </div>
    </fieldset>
  </form>
</main>
