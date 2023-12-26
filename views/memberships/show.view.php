<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>

<div>

  <p>Status: <?= $data['active'] == 1 ? 'active' : 'disabled'?></p>
  <p>Billing Cycle: <?= $data['subscription_duration'] ?> month(s)</p>
  <p>Start Date: <?= $data['start_date'] ?></p>
  <p>Expiration Date: <?= $data['expiration_date'] ?></p>
  
</div>

<?php require view('partials/footer.php'); ?>
