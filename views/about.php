<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>

<section id="about" class="py-16">
    <div class="container mx-auto">
        <h2 class="text-3xl font-semibold mb-8 text-center">About Us</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- About Text -->
            <div class="text-center md:text-left">
                <p class="text-lg font-semibold mb-4">Welcome to Coffee Lover!</p>
                <p class="text-gray-600">
                    At Coffee Lover, we are passionate about coffee and the art of brewing. Our mission is to share the joy of coffee with coffee enthusiasts of all levels.
                </p>
                <p class="text-gray-600 mt-4">
                    Whether you're a seasoned barista or just starting your coffee journey, we've got something for you. Explore a variety of curated recipes, learn about different coffee beans, and discover new brewing techniques.
                </p>
            </div>

            <!-- Our Team -->
            <div>
                <p class="text-lg font-semibold mb-4">Our Team</p>
                <p class="text-gray-600">
                    Coffee Lover is driven by a team of coffee enthusiasts who share a common goal – to make your coffee experience exceptional. From experienced baristas to coffee connoisseurs, our team is dedicated to bringing you the best in the world of coffee.
                </p>
            </div>
        </div>

        <!-- Our Story -->
        <div class="mt-8">
            <p class="text-lg font-semibold mb-4">Our Story</p>
            <p class="text-gray-600">
                Coffee Lover started as a humble blog where a group of friends shared their love for coffee. Over time, it evolved into a community-driven platform where coffee lovers from around the world come together to explore, learn, and celebrate the art of coffee.
            </p>
            <p class="text-gray-600 mt-4">
                Today, we continue to grow, adding new features and content to inspire your coffee moments. Join us on this exciting journey as we explore the world of coffee one cup at a time.
            </p>
        </div>
    </div>
</section>


<?php require view('partials/footer.php'); ?>