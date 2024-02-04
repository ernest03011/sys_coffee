<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>

  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  
  <!-- Outputting errors -->

  <?php
        
        
        if (isset($_GET['message'])) {

            $message = urldecode($_GET['message']) ?? '';
            $type = $_GET['type'] ?? '';
            $color = $_GET['color'] ?? '';

            echo '<div style="color: ' . $color . ';" class="flex justify-center mt-4"  >' . htmlspecialchars($message) . '</div><br/>';
        }
  ?>

  <!-- END -- Outputting errors -->


    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Reset Your Password</h2>
    </div>
    
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="/forgot-password" method="POST">

        <?php if(isset($errors['reset-pass'])) : ?>
          <p class="text-red-500"> <?= $errors['reset-pass'] ?></p>
        <?php endif; ?>
        
        <!-- Email -->
        <?php if(isset($errors['email'])) : ?>
          <p class="text-red-500"> <?= $errors['email'] ?></p>
        <?php endif; ?>

        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
          <div class="mt-2">
            <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-950 sm:text-sm sm:leading-6">
          </div>
        </div>

        <!-- Submit button -->
        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-yellow-950 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-yellow-950 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-950">Send Reset Email</button>
        </div>
      </form>

    </div>
  </div>

<?php require view('partials/footer.php'); ?>