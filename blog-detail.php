<?php 
include('include/header.php'); 
$page_exp = explode('/',$_SERVER['REQUEST_URI']);
$url = end($page_exp);
$blog_detail = $taps9->self_query("select * from tbl_blog where slug='".$url."' &&  status=1");
$i=0;
?>

      <div class="container-fluid blogsbg" id="page">
         <div class="container">
            <div class="bn2">
               <h3><?=$blog_detail[$i]['p_title']?></h3>
               <p>
                  <a href="<?=$baseurl?>">Home &nbsp; </a> / &nbsp;
                  <a href="<?=$baseurl?>/blog" style="color: #68c6ff; font-weight: normal"><?=$blog_detail[$i]['page']?></a> 
               </p>
            </div>
         </div>
      </div>
      <!-- :: Header -->
      
   <div class="details-wrap">
      <div class="container">
         <div class="row">
            <div class="col-md-6 col-lg-12 blog">
               <div class="bg-blog all_details">
               <div class="blog-text">
                  <h2>
                  <?=$blog_detail[$i]['page']?></h2>
                  <p> 
                  <?=$blog_detail[$i]['content']?>
                  </p>
               </div>
               </div>
            </div>
         </div>
      </div>
   </div>

      
   <?php include('include/footer.php'); ?>
