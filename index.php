<?php include('include/header.php'); ?>
      <header class="" id="page">
         <div style="height:500px !important;margin-top:80px;" class="header-owl owl-carousel owl-theme">
            <div class="sec-hero display-table"
               style="background-image: url(assets/img/b4.jpg);height: 500px !important;">
               <div style="height:500px !important" class="table-cell">
                  <div class="overlay"></div>
                  <div class="container">
                     <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-4 sm-img">
                           <img src="<?=$baseurl?>/assets/img/b4.jpg">
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8">
                           <div class="banner">
                              <h1 class="handline">
                                 Free Online Legal Consultation
                              </h1>
                              <div class="slide-service">
                                 <ul>
                                    <li><i class="fa fa-check-circle"></i> we are available 24/7</li>
                                    <li><i class="fa fa-check-circle"></i> We maintain 100% confidentiality</li>
                                 </ul>
                                 <div class="button-col">
                                    <a href="tel:+91-9873628941" class="btn">Tab here to call us</a>
                                    <a href="<?=$baseurl?>/find-lawyer" class="btn find-bg">Find a Lawyer</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="sec-hero display-table"
               style="background-image: url(assets/img/b5.jpg);height: 500px !important;">
               <div style="height:500px !important" class="table-cell">
                  <div class="overlay"></div>
                  <div class="container">
                     <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-4 sm-img">
                           <img src="assets/img/llg2.jpg">
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8">
                           <div class="banner">
                              <h1 class="handline">
                                 Free Online Legal Consultation
                              </h1>
                              <div class="slide-service">
                                 <ul>
                                    <li><i class="fa fa-check-circle"></i> we are available 24/7</li>
                                    <li><i class="fa fa-check-circle"></i> We maintain 100% confidentiality</li>
                                 </ul>
                                 <div class="button-col">
                                    <a href="tel:+91-9873628941" class="btn">Tab here to call us</a>
                                    <a href="find-lawyer" class="btn find-bg">Find a Lawyer</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="sec-hero display-table"
               style="background-image: url(assets/img/b3.jpg); height: 500px !important;">
               <div style="height:500px !important" class="table-cell">
                  <div class="overlay"></div>
                  <div class="container">
                     <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-4 sm-img">
                           <img src="assets/img/stra.jpg">
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8">
                           <div class="banner">
                              <h1 class="handline">
                                 Free Online Legal Consultation
                              </h1>
                              <div class="slide-service">
                                 <ul>
                                    <li><i class="fa fa-check-circle"></i> we are available 24/7</li>
                                    <li><i class="fa fa-check-circle"></i> We maintain 100% confidentiality</li>
                                 </ul>
                                 <div class="button-col">
                                    <a href="tel:+91-9873628941" class="btn">Tab here to call us</a>
                                    <a href="find-lawyer" class="btn find-bg">Find a Lawyer</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      
      <div class="services-wrapper">
      <div class="container">
         <h2 class="text-center our-ser">Our Services</h2>
         <div class="row">
         <?php
             $content_list = $taps9->self_query("select * from tbl_content where p_id=3 order by id asc");
            if(count($content_list)>0)    
            {            
            for($i=0;$i<count($content_list);$i++)
                            {
                                

                       ?>
            <div class="col-md-4 col-lg-3 col-sm-6 our_ser">
               <a href="<?=$baseurl?>/our-services/<?=$content_list[$i]['slug']?>"><img src="<?=$baseurl?>/images/content/<?=$content_list[$i]['image']?>"></a>
               <h6>
                  <a href="<?=$baseurl?>/our-services/<?=$content_list[$i]['slug']?>"><?=$content_list[$i]['page']?></a>
               </h6>
            </div>
            <?php } } ?>
            
         </div>
      </div>
      <div>
      <div class="container mt-5 mb-4">
         <div class="count">
            <h3>   Numbers  Speaks </h3>
         </div>
      </div>
      <div class="container mb-4">
         <div class="row">
            <div class="column">
               <div class="card">
                  <p><i class="fa fa-user"></i></p>
                  <h3>51+</h3>
                  <p>Team Members</p>
               </div>
            </div>
            <div class="column">
               <div class="card">
                  <p><i class="fa fa-check"></i></p>
                  <h3>5000+</h3>
                  <p>Solve Cases</p>
               </div>
            </div>
            <div class="column">
               <div class="card">
                  <p><i class="fa fa-smile-o"></i></p>
                  <h3>100%</h3>
                  <p>Happy Clients</p>
               </div>
            </div>
            <div class="column">
               <div class="card">
                  <p><i class="fa fa-coffee"></i></p>
                  <h3>2000+</h3>
                  <p>Compliances</p>
               </div>
            </div>
         </div>
      </div>
      <!-- practice area      -->
      <!-- form  -->
      <div class="container-fluid mt-5" style="background-color:#faf8f8;padding: 20px 0px;">
         <div class="container">
            <div class="form1">
               <h3>Quick Contact</h3>
               <div class="row">
                  <div class="col-md-3">
                     <div class="ssu">
                        <input type="text" placeholder="Full Name" name="name" required>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="ssu">
                        <input type="text" placeholder="Email" name="email">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="ssu">
                        <input type="text" placeholder="Phone" name="phone" required>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="ssu">
                        <input type="submit" placeholder="Send>>" style="max-width: 100%;">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="modal fade" id="tabnine_servicemodel" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog custom_modal">
            <div class="modal-content main_popup_page">
               <div class="text-right into_popup_section">
                  <button class="btn btn-danger btn-xs btn-close" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
               </div>
               <div class="main_detail">
                  <div class="text-center">
                     <div class="main_heading_section arrow_bot">
                        <h3 class="modal-title custom-font">Family Law Experts</h3>
                     </div>
                     <div class="modal-body family-law">
                      <div class="lawimg">
                      <a href="<?=$baseurl?>/our-services/family-law"><img src="<?=$baseurl?>/assets/img/law-family.jpg"></a>
                     </div>

                       <div class="content-law">
                        <h6> <a href="<?=$baseurl?>/our-services/family-law"><?=$content_list[0]['p_title']?></a></h6>
                        <p>
                        <?=$content_list[0]['p_description']?>
                        </p>
                        <a href="<?=$baseurl?>/our-services/family-law" class="MoreBtn">READ MORE</a>
                       </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

<?php include('include/footer.php'); ?>
