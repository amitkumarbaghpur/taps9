<?php 
include('admin/config/function.php');
$taps9 = new taps9();
$baseurl = $taps9->base_url();
?>
<!doctype html>
<html lang="en">
   <head>
      <!-- :: Required Meta Tags -->
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Taps9 legal services</title>
      <!-- :: Bootstrap CSS -->
      <link rel="stylesheet" href="<?=$baseurl?>/assets/css/bootstrap.min.css">
      <!-- :: Google Fonts -->
      <link rel="stylesheet"
         href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&amp;family=Poppins:wght@400;500;600;700&amp;display=swap">
          <link href="https://fonts.googleapis.com/css2?family=Jost:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
      <!-- :: Fontawesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- main css  -->
      <link rel="stylesheet" href="<?=$baseurl?>/assets/css/main.css">
      <!-- :: Flaticon -->
      <link rel="stylesheet" href="<?=$baseurl?>/assets/fonts/flaticon/css/flaticon.css">
      <!-- :: OWL Carousel -->
      <link rel="stylesheet" href="<?=$baseurl?>/assets/css/owl.carousel.min.css">
      <link rel="stylesheet" href="<?=$baseurl?>/assets/css/owl.theme.default.min.css">
      <!-- :: Nice Select CSS -->
      <link rel="stylesheet" href="<?=$baseurl?>/assets/css/nice-select.css">
      <!-- :: Lity -->
      <link rel="stylesheet" href="<?=$baseurl?>/assets/css/lity.min.css">
      <!-- :: Animate CSS -->
      <link rel="stylesheet" href="<?=$baseurl?>/assets/css/animate.css">
      <!-- :: Style CSS -->
      <link rel="stylesheet" href="<?=$baseurl?>/assets/css/style.css">
      <!-- :: Style Responsive CSS -->
      <link rel="stylesheet" href="<?=$baseurl?>/assets/css/responsive.css">
      <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&amp;display=swap" rel="stylesheet">
   </head>
   <body>

      <header class="navs">
         <div class="nav-top">
            <div class="container">
               <div class="nav-top-box d-flex align-items-center justify-content-between">
                  <ul class="info">
                     <li><span><i class="fa fa-envelope"></i> :</span> <a
                     href="mailto:taps9legalservices@gmail.com">taps9legalservices@gmail.com</a></li>
                     <li class="phone_self"><span> <i class="fa fa-phone"></i> :</span>
                        <a href="tel:91-9873628941">+91-9873628941 </a>
                     </li>
                  </ul>
                  <ul class="icon-follow">
                     <li><a class="icon" target="_blank" href="#"><i class="fa fa-facebook" style="color: darkblue;"></i></a></li>
                     <li><a class="icon" target="_blank" href="#"><i class="fa fa-instagram" style="color: #8a3ab9;"></i></a></li>
                     <li><a class="icon" target="_blank" href="#"><i class="fa fa-linkedin" style="color: #0072b1 ;"></i></a></li>
                     <li><a class="icon" target="_blank" href="#"><i class="fa fa-twitter" style="color:#00acee;"></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
         <nav class="navbar nav-bar navbar-expand-lg navbar-light bg-light navi">
         <div class="container">
            <a class="navbar-brand logo-nav" href="<?=$baseurl?>/">
               <img class="img-fluid one" src="<?=$baseurl?>/assets/img/logo.png" alt="advocate">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a class="nav-link" href="<?=$baseurl?>/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=$baseurl?>/about-us">About us</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=$baseurl?>/our-services/family-law">Family Law</a></li>
               
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Our Services
                  </a>
                  
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php
                  $content_list_menu = $taps9->self_query("select * from tbl_content where p_id=3 order by id asc");
                 if(count($content_list_menu)>0)    
                 {     
                 for($i=0;$i<count($content_list_menu);$i++)
                                 {
                            ?>
                    <a class="dropdown-item" href="<?=$baseurl?>/our-services/<?=$content_list_menu[$i]['slug']?>"><?=$content_list_menu[$i]['page']?></a>
      
                  <?php } } ?>
                  </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="<?=$baseurl?>/find-lawyer">Find a Lawyer</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=$baseurl?>/contact-us">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=$baseurl?>/blog">Blogs</a></li>
              </ul>
            </div>
         </div>
          </nav>
      </header>