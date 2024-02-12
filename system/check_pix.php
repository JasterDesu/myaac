<?php
  require_once(LIBS . 'masterpix.php');
  
  $pix_check = array();
  $pix_check['interval'] = 5; //seconds
  if(!isset($_SESSION["pix_last_check"])){
    $_SESSION["pix_last_check"] = 0;
  }
  if($_SESSION["pix_last_check"] + $pix_check['interval'] < time()) {
    // MasterPix::checkPixTransactions();
    if($account_logged){
      echo $account_logged->getId();
    }
    $_SESSION["pix_last_check"] = time();
  }
  
?>