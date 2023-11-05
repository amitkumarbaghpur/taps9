<?php 
include('include/header.php'); 
$page_exp = explode('/',$_SERVER['REQUEST_URI']);
$url = end($page_exp);
$lawyer_list = $taps9->self_query("select a.*,b.title as state from tbl_lawyer a left join tbl_state b on a.state_id=b.id where a.url='".$url."' and a.status=1 order by a.id asc");
$i=0;
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
         <div class="row">
            <div class="imgbox col-md-4 col-lg-2 advocate-col">
               <a href="#">
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
                     <a href="get-lawyer-detail.html">
                        <p><strong><?=$lawyer_list[$i]['name']?></strong></p>
                     </a>
                       <h5><a href="mailto:<?=$lawyer_list[$i]['email']?>"><?=$lawyer_list[$i]['email']?></a></h5>
                       <h5><a href="tel:<?=$lawyer_list[$i]['phone']?>"><?=$lawyer_list[$i]['phone']?></a></h5>
                       <h5><?=$lawyer_list[$i]['state']?></h5>
                       <p><strong>Languages :</strong><?=$lawyer_list[$i]['languages']?></p>
                       <p><strong>Experience :</strong> <?=$lawyer_list[$i]['experience']?> </p>
                       <p><strong>Practice area &amp; skills : </strong> <?=$lawyer_list[$i]['practice_area']?></p>
                  </div>

               </div>
            </div>

            <div class="col-md-12 col-lg-4 court_mob">
               <div class="courts">
                 <!-- Content Box -->
                 <div class="content-box court">
                     <p class="details"><strong style="color:#4771c9;">COURTS :</strong> <?=$lawyer_list[$i]['courts']?> </p>
                </div>
               </div>
             </div>
         </div>
         <div class="row">
            <div class="col-md-12 more_detils court">
            <?=$lawyer_list[$i]['description']?>
            </div>
         </div>
      </div>
   </div>

   <?php include('include/footer.php'); ?>
