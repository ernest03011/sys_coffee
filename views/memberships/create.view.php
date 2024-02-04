<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>

<div class="flex justify-center flex-col items-center">

  <?php

        if (!empty($_GET['message'])) {
            $message = urldecode($_GET['message']);
            $type = $_GET['type'] ?? '';
            $color = $_GET['color'] ?? '';
                // Output the message with the specified type and color
                echo '<div class="message ' . htmlspecialchars($type) . '" style="color: ' . htmlspecialchars($color) . ';">' . htmlspecialchars($message) . '</div>';
            
        }


  ?>

  <h3 class="my-6">Buy a new membership</h3>

  <form action="/membership" method="post">

    <p>Select the billing cycle: </p>

    <?php if(! empty($msg['error'])) : ?>

      <p class="text-red-500"> <?= $msg['error'] ?> </p>

    <?php endif; ?>

    <input type="radio" name="billing_cycle" id="billing_cycle" value="1" />
    <label for="billing_cycle">1</label>

    <input type="radio" name="billing_cycle" id="billing_cycle" value="12" />
    <label for="billing_cycle">12</label>

    <input type="radio" name="billing_cycle" id="billing_cycle" value="24" />
    <label for="billing_cycle">24</label>

    <input type="radio" name="billing_cycle" id="billing_cycle" value="48" />
    <label for="billing_cycle">48</label> <br/>

    <button class="mt-6 bg-yellow-950 text-white p-2 rounded-md" type="submit">Create subscription</button>

  </form>
  
</div>

<?php require view('partials/footer.php'); ?>