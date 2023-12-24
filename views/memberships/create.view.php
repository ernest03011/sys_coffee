<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>

<div>

  <h3>Buy a new membership</h3>

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

    <button class="mt-8" type="submit">Create subscription</button>

  </form>
  
</div>

<?php require view('partials/footer.php'); ?>