<main class="container py-4">
  <h1 class="sr-only">Login Page</h1>

  <form class="max-w-md mx-auto" method="post">
    <fieldset class="flex flex-col gap-6">
      <legend class="mb-4 font-medium">Login to Your Account</legend>
      <p class="text-muted-foreground text-sm leading-normal font-normal group-has-[[data-orientation=horizontal]]/field:text-balance">
        Welcome back! Please enter your credentials to access your account.
      </p>

      <div class="group/field-group @container/field-group flex w-full flex-col gap-7 data-[slot=checkbox-group]:gap-3 [&>[data-slot=field-group]]:gap-4">
        <?php
        $id = "identifier";
        $label = "Username or Email";
        $name = "identifier";
        $value = isset($old['identifier']) ? htmlspecialchars($old['identifier'], ENT_QUOTES, 'UTF-8') : '';
        $placeholder = "Enter your username or email";
        $error = isset($errors['identifier']) ? $errors['identifier'] : null;
        include __DIR__ . '/../components/ui/field.php';
        ?>

        <?php
        $id = "password";
        $label = "Password";
        $name = "password";
        $type = "password";
        $value = '';
        $placeholder = "Enter your password";
        $error = isset($errors['password']) ? $errors['password'] : null;
        include __DIR__ . '/../components/ui/field.php';
        ?>
      </div>

      <div class="group/field flex w-full gap-3 data-[invalid=true]:text-destructive flex-col [&>*]:w-full [&>.sr-only]:w-auto">
        <?php
        $type = "submit";
        $slot = "Login";
        include __DIR__ . '/../components/ui/button.php';
        ?>
      </div>
    </fieldset>
  </form>
</main>
