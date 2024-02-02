<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>

<main class="grid place-items-center bg-white px-3 py-6 sm:py-32 lg:px-4">
  <div class="text-center">
    <p class="text-base font-semibold text-yellow-950">401</p>
    <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Unauthorized</h1>
    <p class="mt-6 text-base leading-7 text-gray-600">Sorry, you need to log in to access this page!</p>
    <div class="mt-10 flex items-center justify-center gap-x-6">
      <a href="/login" class="rounded-md bg-yellow-950 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-yellow-950 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-950">Login</a>
      <!-- <a href="#" class="text-sm font-semibold text-gray-900">Contact support <span aria-hidden="true">&rarr;</span></a> -->
    </div>
  </div>
</main>

<?php require view('partials/footer.php'); ?>