<div class="absolute inset-x-0 top-0 z-50 font-opensans">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="#" class="-m-1.5 p-1.5">
          <span class="sr-only">My coffee shop</span>
          <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
        </a>
      </div>
      <!-- Hamburguer icon - OPEN BUTTON -->
      <div class="flex lg:hidden">
        <button type="button" id="openNavModal" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-yellow-950">
          <span class="sr-only">Open main menu</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>

      <div class="hidden lg:flex lg:gap-x-12 text-yellow-950">
        <a href="/" class="text-sm font-semibold leading-6 text-yellow-950">Home</a>
        <?php if(isset($_SESSION['user']['email'])) : ?>        
          <a href="/recipes" class="text-sm font-semibold leading-6 text-yellow-950">Recipes</a>
        <?php endif; ?>
        <a href="/about" class="text-sm font-semibold leading-6 text-yellow-950">About Us</a>
        <a href="/contact" class="text-sm font-semibold leading-6 text-yellow-950">Contact Us</a>
        <?php if(isset($_SESSION['user']['email'])) : ?>    
          <a href="/membership" class="text-sm font-semibold leading-6 text-yellow-950">Membership</a>
        <?php endif; ?>
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">

        <?php if(! isset($_SESSION['user']['email'])) : ?>        
          <a href="/login" class="text-sm font-semibold leading-6 text-yellow-950">Log in <span aria-hidden="true">&rarr;</span></a>
        <?php endif; ?>

        <?php if(isset($_SESSION['user']['email'])) : ?>        

          <form action="/logout" method="POST">
            <button clas="text-sm font-semibold leading-6 text-yellow-950">Log out</button>
          </form>

        <?php endif; ?>
        

      </div>
    </nav>
    
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="hidden" id="myModal" role="dialog" aria-modal="true">
      <!-- Background backdrop, show/hide based on slide-over state. -->
      <!-- <div class="fixed inset-0 z-50"></div> -->
      <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <!-- Menu on mobiles -->
        <div class="flex items-center justify-between">
          <!-- Logo -->
          <a href="#" class="-m-1.5 p-1.5">
            <span class="sr-only">My coffee shop</span>
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=yellow&shade=950" alt="">
          </a>
          <!-- Close button - X -->
          <button type="button" id="closeNavModal" class="-m-2.5 rounded-md p-2.5 text-yellow-950">
            <span class="sr-only">Close menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Menu options for mobile -->
        <div id="mobile-menu" class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              <a  href="/" class="mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-yellow-950 hover:bg-gray-50">Home</a>
              <?php if(isset($_SESSION['user']['email'])) : ?>    
                <a  href="/recipes" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-yellow-950 hover:bg-gray-50">Recipes</a>
              <?php endif; ?>
              <a  href="/about" class="mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-yellow-950 hover:bg-gray-50">About us</a>
              <a  href="/contact" class="mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-yellow-950 hover:bg-gray-50">Contact Us</a>
              <?php if(isset($_SESSION['user']['email'])) : ?>    
                <a  href="/membership" class="mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-yellow-950 hover:bg-gray-50">Membership</a>
              <?php endif; ?>
            </div>
            <?php if(! isset($_SESSION['user']['email'])) : ?>    
              <div class="py-6">
                <a  href="/login" class="mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-yellow-950 hover:bg-gray-50">Log in</a>
              </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['user']['email'])) : ?>        

              <form action="/logout" method="POST">
                <button  clas="text-sm font-semibold leading-6 text-yellow-950">Log out</button>
              </form>

            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
</div>
