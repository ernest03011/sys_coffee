<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>

<section id="contact" class="bg-gray-100 py-16">
    <div class="container mx-auto">
        <h2 class="text-3xl font-semibold mb-8 text-center">Contact Us</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Contact Form -->
            <div>
                <form id="contactForm" action="/contact" method="post" class="max-w-md mx-auto">

                    <?php if(!empty($status_msg)) : ?>
                        <p 
                            class="<?php $status === 'success' ? 'text-green-500' : 'text-red-500' ?>"
                        >
                            <?= $status_msg ?>
                        </p>
                    <?php endif; ?>

                    <!-- Add your form fields here -->
                    <label for="name" class="block text-sm font-medium text-gray-600">Your Name</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md">

                    <label for="email" class="block mt-4 text-sm font-medium text-gray-600">Your Email</label>
                    <input type="email" id="email" name="email" class="mt-1 p-2 w-full border rounded-md">

                    <label for="message" class="block mt-4 text-sm font-medium text-gray-600">Your Message</label>
                    <textarea id="message" name="message" rows="4" class="mt-1 p-2 w-full border rounded-md"></textarea>

                    <input type="hidden" name="submit_frm" value="1">
                    <input type="hidden" id="recaptchaToken" name="recaptchaToken" />

                    <button 
                        data-action="submit" 
                        class="g-recaptcha mt-6 bg-yellow-950 text-white p-2 rounded-md"
                        data-sitekey="6LcbNzkpAAAAAPvT5x0b_m25lwwG9tKZfXqt5lbE"
                        data-callback="onSubmit"
                        onclick="handleButtonClick(event)"
                    >
                        Send Message

                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div>
                <div class="text-center md:text-left">
                    <p class="text-lg font-semibold mb-2">Reach Out to Us</p>
                    <p class="text-gray-600">We'd love to hear from you! Feel free to contact us with any questions or feedback.</p>

                    <div class="mt-4">
                        <p class="text-sm font-medium text-gray-600">Email:</p>
                        <p class="text-primary-brown">info@yourcoffeewebsite.com</p>
                    </div>

                    <div class="mt-2">
                        <p class="text-sm font-medium text-gray-600">Phone:</p>
                        <p class="text-primary-brown">+1 (123) 456-7890</p>
                    </div>

                    <div class="mt-2">
                        <p class="text-sm font-medium text-gray-600">Address:</p>
                        <p class="text-gray-600">123 Coffee Street, Cityville, Country</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require view('partials/footer.php'); ?>


