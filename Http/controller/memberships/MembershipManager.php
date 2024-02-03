<?php

namespace Http\controller\memberships;

use Core\Database;

class MembershipManager
{
  private $db;

  public function __construct(Database $db) {
    $this->db = $db;
  }

  public function createMembership($user_id, $billing_cycle, $start_date, $expiration_date){

        
    try {

      $this->db->query('Insert into memberships(user_id, subscription_duration, start_date, expiration_date) VALUES (:user_id, :subscription_duration, :start_date, :expiration_date)', [
          'user_id' => $user_id,
          'subscription_duration' => $billing_cycle,
          'start_date' => $start_date->format('Y-m-d'),
          'expiration_date' => $expiration_date->format('Y-m-d'),
      ]);

      return true;

    } catch (\Exception $e) {
      // dd($e);
      return false;
    }


  }

  public function hasAnActiveMembership(string $user_id){

    try {

      $membership = $this->db->query('select * from memberships where user_id = :user_id', [
        'user_id' => $user_id 
      ])->get();

      return $membership;

    } catch (\Exception $th) {
      //throw $th;
      return false;
    }

  }

}
