<?php 
include('inc/header.php');
include('inc/sidebar.php');


@$delete_id = (int)$_GET['delete'];
 
 
 $get_images =  $use_charli->self_query("SELECT * FROM `tbl_product_image` where id=$delete_id");
 
 
 $product_id= $get_images[0]['product_id'];
 
 $image_name=$get_images[0]['image'];
 
 @unlink("../images/main_img/".$image_name);
 
  $use_charli->delete_product_image("DELETE FROM `tbl_product_image` where id=$delete_id",$product_id);
 
//   if($delete_images==true)
//   {
//               unset($_SESSION['error']);
//          $_SESSION['msg']='Image Delete Success';
//      	header('location:delete_produt_image.php?edit=$product_id');
//   }
  
//   else {
//       unset($_SESSION['msg']);
//           $_SESSION['error']='This Image Not Delete';
//       	header('location:delete_produt_image.php?edit=$product_id');
//   }


?>

<h1><?=$image_name?></h1>

  

 