<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>

<div>

  <p>Status: <?= $user['status'] == 1 ? 'active' : 'disabled'?></p>
  <p>Billing Cycle: <?= $user['billing_cycle'] ?> month(s)</p>
  <p>Start Date: <?= $user['start_date'] ?></p>
  <p>Expiration Date: <?= $user['expiration_date'] ?></p>
  
</div>

<?php require view('partials/footer.php'); ?>
