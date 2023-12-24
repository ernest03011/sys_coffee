<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>


<form action='/submit-recipe' method="POST" class="flex justify-center">
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Submit recipe</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">Provide detailed information about this recipe</p>
        
        
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <!-- Validate Title -->
          <?php if(isset($errors['title'])) : ?>
            <p class="text-red-500"><?= $errors['title'] ?></p>
          <?php endif; ?>
          <!-- Title -->
          <div class="sm:col-span-4">
            <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
            <div class="mt-2">
              <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input type="text" name="title" id="title" autocomplete="title" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Classic Expresso">
              </div>
            </div>
          </div>
          
          <!-- Validate Description -->
          <?php if(isset($errors['description'])) : ?>
            <p class="text-red-500"><?= $errors['description'] ?></p>
          <?php endif; ?>
          <!-- Description -->
          <div class="col-span-full">
            <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
            <div class="mt-2">
              <textarea id="description" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
            </div>
        
          </div>

          <!-- Validate Ingredients -->
          <?php if(isset($errors['ingredients'])) : ?>
            <p class="text-red-500"><?= $errors['ingredients'] ?></p>
          <?php endif; ?>
          <!-- Ingredients -->
          <div class="col-span-full">
            <label for="ingredients" class="block text-sm font-medium leading-6 text-gray-900">Ingredients</label>
            <div class="mt-2">
              <textarea id="ingredients" name="ingredients" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
            </div>
        
          </div>

          <!-- Vialdate Instructions -->
          <?php if(isset($errors['instructions'])) : ?>
            <p class="text-red-500"><?= $errors['instructions'] ?></p>
          <?php endif; ?>
          <!-- Instructions -->
          <div class="col-span-full">
            <label for="instructions" class="block text-sm font-medium leading-6 text-gray-900">Instructions</label>
            <div class="mt-2">
              <textarea id="instructions" name="instructions" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
            </div>
        
          </div>


        </div>

      
      </div>

    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
      <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
      <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
</form>
  
<?php require view('partials/footer.php'); ?>