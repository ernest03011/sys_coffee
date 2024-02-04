<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>

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

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form method="POST" action="/recipe">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="id" value="<?= $recipe['recipe_id'] ?>">

                    <div class="shadow sm:overflow-hidden sm:rounded-md">

                      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <!-- Validate Title -->
                        <?php if(isset($errors['title'])) : ?>
                          <p class="text-yellow-950"><?= $errors['title'] ?></p>
                        <?php endif; ?>
                        <!-- Title -->
                        <div class="sm:col-span-4">
                          <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                          <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                              <input type="text" name="title" id="title" autocomplete="title" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Classic Expresso" value="<?= $recipe['title']?>">
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
                            <textarea id="description" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $recipe['description']?></textarea>
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
                            <textarea id="ingredients" name="ingredients" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $recipe['ingredients']?></textarea>
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
                            <textarea id="instructions" name="instructions" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $recipe['instructions']?></textarea>
                          </div>
                      
                        </div>


                      </div>

                      <div class="bg-gray-50 px-4 py-3 text-right sm:px-6 flex gap-x-4 justify-end items-center">
                            <button type="button" class="text-red-500 mr-auto" onclick="document.querySelector('#delete-form').submit()">Delete</button>

                            <a
                                href="/recipes"
                                class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="inline-flex justify-center rounded-md border border-transparent bg-yellow-950 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-yellow-950 focus:outline-none focus:ring-2 focus:ring-yellow-950 focus:ring-offset-2"
                            >
                                Update
                            </button>
                      </div>
                    </div>
                </form>

                <form id="delete-form" class="hidden" method="POST" action="/recipe">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id" value="<?= $recipe['recipe_id'] ?>">
                </form>
            </div>
        </div>
    </div>
</main>

<?php require view('partials/footer.php'); ?>