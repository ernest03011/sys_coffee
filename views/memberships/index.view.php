<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>

<h2 class="grid justify-center mt-6">A place to manage your membership for Premium Coffe recipes!</h2>


<!-- // --- If there is any memebership, show it and display related information like 
// ------------ Billing cycle, start and expiration date and if it is active or expired,
// ------------ if it is active, the user could disable it. 
// ------------ Since the user can disable it, instead of checking if it is active or not, check if it is expired based on the expiration date, and based on this show radio buttons to select a billing cycle and renew it. 

// --- If there is no membership, then encourage the user to active one
// --- It should allow them to select with a radio button the billing cycle and then activate it. -->

<?php 

  if(! $user['has_membership']){
    $error = $_GET['message'] ?? '';
    // echo 'click here to buy a membership!';
    require view('memberships/create.view.php', $msg = [
      'error' => $error
    ]);

    exit();
    
  }else{
    // dd($user['membership_data']['active']);
    require view('memberships/show.view.php', $user = [
      'status' => $user['membership_data']['active'],
      'billing_cycle' => $user['membership_data']['subscription_duration'],
      'start_date' => $user['membership_data']['start_date'],
      'expiration_date' => $user['membership_data']['expiration_date']

    ]);

  }

?>




<?php require view('partials/footer.php'); ?>