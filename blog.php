<?php include('include/header.php'); ?>



      <div class="container-fluid blogsbg" id="page">
         <div class="container">
            <div class="bn2">
               <h3>Our Blogs</h3>
               <p>
                  <a href="<?=$baseurl?>">Home &nbsp; </a> / &nbsp;
                  <a href="<?=$baseurl?>/blog" style="color: #68c6ff; font-weight: normal">Our Blogs</a> 
               </p>
            </div>
         </div>
      </div>
      <!-- :: Header -->
      
   <div class="details-wrap">
      <div class="container">
         <div class="row">
         <?php
             $blog_list = $taps9->self_query("select * from tbl_blog where status=1 order by id asc");
            if(count($blog_list)>0)    
            {            
            for($i=0;$i<count($blog_list);$i++)
                            {
                             
                       ?>
            <div class="col-md-6 col-lg-4 blog">
               <div class="bg-blog">
               <a href="<?=$baseurl?>/blog-detail/<?=$blog_list[$i]['slug']?>">
               <?php if($blog_list[$i]['image'])
               {?>
               <img src="<?=$baseurl?>/images/content/<?=$blog_list[$i]['image']?>">
            <?php } ?></a>
               <div class="blog-text">
                  <h4><a href="<?=$baseurl?>/blog-detail/<?=$blog_list[$i]['slug']?>">
                  <?=$blog_list[$i]['p_title']?>
                  </a></h4>
                  <p> <?=$blog_list[$i]['short_content']?>  </p>
                  <a href="<?=$baseurl?>/blog-detail/<?=$blog_list[$i]['slug']?>" class="viewmore">READ MORE <i class="fa fa-arrow-right"></i></a> 
               </div>
               </div>

            </div>
            <?php } } ?>
                     </div>
      </div>
 </div>
 <?php include('include/footer.php'); ?>
