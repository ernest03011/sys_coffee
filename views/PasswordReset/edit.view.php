<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>

<?php              
        if (isset($_GET['message'])) {

            $message = urldecode($_GET['message']) ?? '';
            $type = $_GET['type'] ?? '';
            $color = $_GET['color'] ?? '';

            echo '<div style="color: ' . $color . ';" class="flex justify-center mt-4"  >' . htmlspecialchars($message) . '</div><br/>';
        }
?>

  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Add New Password</h2>
    </div>
    
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="/forgot-password" method="POST">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?= $attributes['id'] ?>">
        <input type="hidden" name="token" value="<?= $_GET["token"] ?>">

        <!-- Password -->
        <?php if(isset($errors['password'])) : ?>
          <p class="text-red-500"> <?= htmlspecialchars($errors['password']) ?>  </p>
        <?php endif; ?>

        <div class="mt-2">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
            <div class="mt-2">
              <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>

        <div class="mt-2">
          <label for="conPassword" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
          <div class="mt-2">
            <input id="conPassword" name="conPassword" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>

        <div class="mt-5">
          <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
        </div>
      </form>

      
    </div>
  </div>

<?php require view('partials/footer.php'); ?>