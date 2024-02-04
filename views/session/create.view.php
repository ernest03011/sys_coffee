<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>

  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
    </div>
    
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="/login" method="POST">

        <?php if(isset($attributes['pass_reset_successful'])) : ?>
          <p class="text-green-900"> <?= $attributes['pass_reset_successful'] ?></p>
        <?php endif; ?>

        <?php if(isset($errors['login'])) : ?>
          <p class="text-red-500"> <?= $errors['login'] ?></p>
        <?php endif; ?>
        
        <!-- Email -->
        <?php if(isset($errors['email'])) : ?>
          <p class="text-red-500"> <?= $errors['email'] ?></p>
        <?php endif; ?>

        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
          <div class="mt-2">
            <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>

        <!-- Password -->
        <?php if(isset($errors['password'])) : ?>
          <p class="text-red-500"> <?= $errors['password'] ?></p>
        <?php endif; ?>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
            <div class="text-sm">
              <a href="/forgot-password" class="font-semibold text-yellow-950 hover:text-yellow-950">Forgot password?</a>
            </div>
          </div>
          <div class="mt-2">
            <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-black placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-950 sm:text-sm sm:leading-6">
          </div>
        </div>
        
        <!-- Submit button -->
        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-yellow-950 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-yellow-950 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-950">Sign in</button>
        </div>
      </form>

      <p class="mt-10 text-center text-sm text-red-500">
        Not a member?
        <a href="/register" class="font-semibold leading-6 text-yellow-950 hover:text-yellow-950">Sign in</a>
      </p>
    </div>
  </div>

<?php require view('partials/footer.php'); ?>