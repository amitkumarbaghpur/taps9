<?php



 
include('config/db_config.php');
include('config/function.php');
$use_charli = new taps9();

     $id= $_GET['stock_id'];  
   $pro_id=$_GET['pro_id'];   
    // $pro_id=152;
 $sql=$use_charli->delete_stock("delete from tbl_size_color_stock where id='".$id."'",$pro_id);
 


?>
 
 