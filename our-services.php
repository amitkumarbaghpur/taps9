<?php 
include('include/header.php');
$page_exp = explode('/',$_SERVER['REQUEST_URI']);
$url = end($page_exp);
$page_detail = $taps9->fetch_rows("tbl_content","where slug = '".$url."' && status=1");
?>

      <div class="container-fluid bn" id="page">
      <?php  if($page_detail['logo1'])
      {
        ?>
      <img src="<?=$baseurl?>/images/main_img/<?=$page_detail['logo1']?>"/>
      <?php } ?>
         <div class="container">
            <div class="bn2">
               <h3>Family Law</h3>
               <p>
                  <a href="<?=$baseurl?>">Home &nbsp; </a> / &nbsp;
                  <a href="family-law.html" style="color: #68c6ff;"><?=$page_detail['page']?></a>
               </p>
            </div>
         </div>
      </div>
      <div class="services-wrapper" <?php if($page_detail['logo1']) { echo 'style=" padding:276px 0 0 !important;"'; } ?> >
      <div class="container">
         <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
               <div class="law_serdetail">
                   <div class="content-wrapper">
                       <h4><?=$page_detail['page']?></h4>
                       <h3><?=$page_detail['p_title']?></h3>
                       <p><?=$page_detail['content']?></p>
                       
                    </div>
                    <div class="row">
                     <div class="col-md-6 col-lg-4 our_ser">
                        <a href="family-law-detail.html">
                        <img src="https://taps9.com/wp-content/uploads/2022/01/load-image-2-2.jpg.webp"></a>
                        <div class="lawservice">
                           <h4><a href="https://taps9.com/curative-petition-supreme-court-of-india/">Contested Divorce</a></h4>
                           <p>
                           Contested divorce can be filed on various grounds which may include cruelty , both mental and physical , adultery...
                           </p>
                           <a href="https://taps9.com/curative-petition-supreme-court-of-india/" class="MoreBtn">READ MORE</a>  
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-4 our_ser">
                        <a href="family-law-detail.html">
                        <img src="https://taps9.com/wp-content/uploads/2022/01/load-image-2-2.jpg.webp"></a>
                        <div class="lawservice">
                           <h4><a href="https://taps9.com/curative-petition-supreme-court-of-india/">Contested Divorce</a></h4>
                           <p>
                           Contested divorce can be filed on various grounds which may include cruelty , both mental and physical , adultery...
                           </p>
                           <a href="https://taps9.com/curative-petition-supreme-court-of-india/" class="MoreBtn">READ MORE</a>  
                        </div>
                     </div>
                  </div>
                 </div>
              </div>
           </div>
        </div>
        <div>
        <?php include('include/footer.php'); ?>
