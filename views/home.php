<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coffee Shop</title>
  <link rel="stylesheet" href="./css/styles.css">
</head>
<body class="body1">

  <?php require 'header.php'; ?>

  <main class="mt-4">
    
    <div class="container mx-auto my-20 p-4">
  
      <!-- Featured Recipe -->
      <section class="mb-8 mt-8">
          <h2 class="mb-4 text-center subtitle1">Featured Recipe</h2>
  
  
          <!-- Featured Recipe Cards -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Recipe -->
            <div class="bg-white shadow-md rounded-md p-4">
                <h3 class="text-xl font-semibold mb-2">Classic Espresso</h3>
                <p class="text-gray-600 mb-4">A simple and strong espresso shot.</p>
                <!-- Add more details like image, author, etc. -->
                <a href="/recipes/1" class="text-primary-brown hover:underline">View Recipe</a>
            </div>        
            <div class="bg-white shadow-md rounded-md p-4">
                <h3 class="text-xl font-semibold mb-2">Classic Espresso</h3>
                <p class="text-gray-600 mb-4">A simple and strong espresso shot.</p>
                <!-- Add more details like image, author, etc. -->
                <a href="/recipes/1" class="text-primary-brown hover:underline">View Recipe</a>
            </div>        
            <div class="bg-white shadow-md rounded-md p-4">
                <h3 class="text-xl font-semibold mb-2">Classic Espresso</h3>
                <p class="text-gray-600 mb-4">A simple and strong espresso shot.</p>
                <!-- Add more details like image, author, etc. -->
                <a href="/recipes/1" class="text-primary-brown hover:underline">View Recipe</a>
            </div>        
          </div>
            
  
      </section>
  
      <!-- Testimonials -->
      <section class="mb-8">
          <h2 class="subtitle1 mb-4 text-center">What Our Users Say</h2>
  
          <!-- Testimonial Cards -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
              <!-- Testimonial Card 1 -->
              <div class="bg-white shadow-md rounded-md p-4">
                  <p class="text-gray-600 mb-4">"The best coffee recipes I've ever found! I love this platform."</p>
                  <span class="font-semibold">- CoffeeLover123</span>
              </div>
  
              <!-- Testimonial Card 2 -->
              <div class="bg-white shadow-md rounded-md p-4">
                  <p class="text-gray-600 mb-4">"The iced caramel latte is now my go-to drink. Amazing recipes!"</p>
                  <span class="font-semibold">- CaffeineQueen</span>
              </div>
  
              <!-- Testimonial Card 3 -->
              <div class="bg-white shadow-md rounded-md p-4">
                  <p class="text-gray-600 mb-4">"This website has made my coffee brewing experience so much better."</p>
                  <span class="font-semibold">- BrewMaster</span>
              </div>
          </div>
      </section>
  
      <!-- Ratings (Visible after login) -->
      <!-- @auth -->
      <section>
          <h2 class="subtitle1 mb-4 text-center">Rate a Recipe</h2>
  
          <!-- Rating Form -->
          <div class="bg-white shadow-md rounded-md p-4">
              <h3 class="text-xl font-semibold mb-2">Rate the Classic Espresso</h3>
              <!-- Rating Stars (you can use a library for this) -->
              <div class="flex items-center mb-4">
                  <i class="fas fa-star text-yellow-500 mr-1"></i>
                  <i class="fas fa-star text-yellow-500 mr-1"></i>
                  <i class="fas fa-star text-yellow-500 mr-1"></i>
                  <i class="fas fa-star text-yellow-500 mr-1"></i>
                  <i class="far fa-star text-yellow-500"></i>
              </div>
              <button class="bg-primary-brown text-white px-4 py-2 rounded-md">Submit Rating</button>
          </div>
      </section>
      <!-- @endauth -->
  
    </div>

  </main>

   <?php require 'footer.php'; ?>

  
</body>
</html>