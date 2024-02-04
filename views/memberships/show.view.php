<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>


<div class="max-w-md flex items-center justify-center bg-white rounded-xl overflow-hidden border-l-4 border-orange-900 shadow-md">
    <div class="p-4">
        <div class="flex items-center justify-center">
            <svg class="h-8 w-8 text-coffee-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 18v-6a9 9 0 0118 0v6"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21v-6a9 9 0 00-9-9"></path>
                <path d="M3 18v-6a9 9 0 0118 0v6"></path>
                <path d="M21 21v-6a9 9 0 00-9-9"></path>
            </svg>
        </div>
        <div class="mt-4 text-center">
            <h1 class="text-xl font-semibold">Membership Subscription</h1>
            <p>Status: <?= $data['active'] == 1 ? 'active' : 'disabled'?></p>
            <p>Billing Cycle: <?= $data['subscription_duration'] ?> month(s)</p>
            <p>Start Date: <?= $data['start_date'] ?></p>
            <p>Expiration Date: <?= $data['expiration_date'] ?></p>
        </div>
    </div>
</div>


<?php require view('partials/footer.php'); ?>
