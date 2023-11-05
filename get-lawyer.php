<?php 
include('include/header.php'); 
$page_exp = explode('/',$_SERVER['REQUEST_URI']);
$url = end($page_exp);

?>


      <div class="container-fluid lawyerget" id="page">
         <div class="container">
            <div class="bn2">
            </div>
         </div>
      </div>
      <!-- :: Header -->
      
   <div class="details-wrap">
      <div class="container">
            <?php
             $lawyer_list = $taps9->self_query("select a.*,b.title as state from tbl_lawyer a left join tbl_state b on a.state_id=b.id where a.state_id='".$url."' and a.status=1 order by a.id asc");
            if(count($lawyer_list)>0)    
            {            
            for($i=0;$i<count($lawyer_list);$i++)
                            {
                       
         ?>
       <div class="row">
            <div class="imgbox col-md-4 col-lg-2 advocate-col">
               <a href="get-lawyer-detail.html">
               <img src="<?=$baseurl?>/images/main_img/<?=$lawyer_list[$i]['image']?>">
               </a>
               <div class="rating">
                  <span class="rateuser"><?=$lawyer_list[$i]['rating_point']?> <i class="fa fa-star"></i></span>
                  <span><?=$lawyer_list[$i]['rating_count']?>+ user ratings</span>
                </div>
            </div>
            <div class="col-md-8 col-lg-6 getlawer2">
               <div class="innerbox">
                  <div class="find_lawyercontent">
                     <a href="<?=$baseurl?>/lawyer-details/<?=$lawyer_list[$i]['url']?>">
                        <p><strong><?=$lawyer_list[$i]['name']?></strong></p>
                     </a>
                       <h5><a href="mailto:<?=$lawyer_list[$i]['email']?>"><?=$lawyer_list[$i]['email']?></a></h5>
                       <h5><a href="tel:<?=$lawyer_list[$i]['phone']?>"><?=$lawyer_list[$i]['phone']?></a></h5>
                       <h5><?=$lawyer_list[$i]['state']?></h5>
                       <p><strong>Languages :</strong><?=$lawyer_list[$i]['languages']?> </p>
                       <p><strong>Experience :</strong> <?=$lawyer_list[$i]['experience']?> </p>
                       <p><strong>Practice area &amp; skills : </strong> <?=$lawyer_list[$i]['practice_area']?> </p>
                  </div>

               </div>
            </div>
         </div>
         <?php } } ?>
      
      </div>
   </div>
   <?php include('include/footer.php'); ?>
