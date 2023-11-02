<?php
require_once('config/function.php');
$use_charli = new taps9();
if($_SESSION['admin_login']!=0)
{
  header('location:dashboard.php');
  
}
if(isset($_POST['login']))
{
  $use_charli->admin_login($_POST);
} 


 

?>


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--favicon-->
  <link rel="icon" href="<?=$baseurl?>assets/images/favicon-32x32.png" type="image/png" />
  <!--plugins-->
      <link href="<?=$baseurl?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
  <link href="<?=$baseurl?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="<?=$baseurl?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
  <link href="<?=$baseurl?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
  <!-- loader-->
  <link href="<?=$baseurl?>assets/css/pace.min.css" rel="stylesheet" />
  <script src="<?=$baseurl?>assets/js/pace.min.js"></script>
  <!-- Bootstrap CSS -->
  <link href="<?=$baseurl?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
  <link href="<?=$baseurl?>assets/css/app.css" rel="stylesheet">
  <link href="<?=$baseurl?>assets/css/icons.css" rel="stylesheet">

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="<?=$baseurl?>assets/css/dark-theme.css" />
    <link rel="stylesheet" href="<?=$baseurl?>assets/css/semi-dark.css" />
    <link rel="stylesheet" href="<?=$baseurl?>assets/css/header-colors.css" />
    <title>Admin Login</title>
</head>

 <div class="container">

    <div class="row">
      <div class="col-md-2"> 
      </div>

<div class="col-md-8">
 
                            <hr/>
              <div class="card border-top border-0 border-4 border-dark">
                  <div class="card-body p-5">
                    <div class="card-title text-center"><i class="bx bxs-user-circle text-dark font-50"></i>
                      <h5 class="mb-5 mt-2 text-dark">Admin Login</h5>
                                </div>
                                    <hr>
     <form class="row g-3" method="post">
         <div class="col-12">
             <label for="inputLastEnterUsername" class="form-label">Enter Username</label>
              <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
               <input type="text" name="username" class="form-control border-start-0" id="inputLastEnterUsername" required placeholder="Enter Username" />
                 </div>
                    </div>
         <div class="col-12">
               <label for="inputLastEnterPassword" class="form-label">Enter Password</label>
                 <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class='bx bxs-lock-open'></i></span>
                    <input type="password" required name="password" class="form-control border-start-0" id="inputLastEnterPassword" placeholder="Enter Password" />
                               </div>
                                   </div>
       <div class="col-12">
          <div class="d-grid">
             <button type="submit" name="login" class="btn btn-dark btn-lg px-5"><i class='bx bxs-lock-open'></i>Login</button>
                  </div>
                     </div>
         </form>
                 </div>
                     </div>

  

</div>


 <div class="col-md-2"> 
      </div>


    </div>

 </div>

                             <?php 

include "inc/footer.php";
    ?>

