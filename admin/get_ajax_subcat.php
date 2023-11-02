<?php
include('config/db_config.php');
include('config/function.php');
$use_charli = new taps9();

if(!empty($_POST["cat_id"])) 
{	
	  $cat_id=$_POST['cat_id'];
}
 
 $sub_category=$use_charli->self_query("select * from sub_category where category_id='".$cat_id."'");
 
?>
 <option value="">Select Sub Category</option>
 <?php 
for ($i=0; $i <count($sub_category); $i++) {
 ?>
<option value="<?=$sub_category[$i]['id']?>"><?=$sub_category[$i]['sub_category']?></option>

<?php 
}
?>