<?php
include('inc/header.php');
include('inc/sidebar.php'); 

if($_GET['ord_id'])
{
      $ord_id=base64_decode(($_GET['ord_id'])); 
      
    $use_charli->cancel_admin_order($ord_id);
    
}
?>