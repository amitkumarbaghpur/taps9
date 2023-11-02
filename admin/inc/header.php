<?php 
require 'config/function.php';
 $taps9=new taps9(); 
if($_SESSION['admin_login']==0)
{
  $_SESSION['status']='Login to access admin panel';
  header('location:index.php?login='.str_replace(' ', '-', $_SESSION['status']));
  
}
$get_pages = explode('/',$_SERVER['PHP_SELF']);
$page = $get_pages[count($get_pages)-1];


 ?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!--plugins-->
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />


        <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    
    
	    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="assets/css/dark-theme.css" />
    <link rel="stylesheet" href="assets/css/semi-dark.css" />
    <link rel="stylesheet" href="assets/css/header-colors.css" />


     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>Admin-Panel</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		<!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>
                    <div class="search-bar flex-grow-1">
                        <div class="position-relative search-bar-box">
                            
                        </div>
                    </div>
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item mobile-search-icon">
                                <a class="nav-link" href="#">   <i class='bx bx-search'></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                             <div class="dropdown-menu dropdown-menu-end">
                                    <div class="row row-cols-3 g-3 p-3">
                                        
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                               
                                <div class="dropdown-menu dropdown-menu-end">
                                  
                                    <div class="header-notifications-list">
                                      
                                    </div>
                                  
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                                
                                <div class="dropdown-menu dropdown-menu-end">
                                   
                                    <div class="header-message-list">
                                        
                                    </div>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="user-box dropdown">
                        <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="assets/dummy.png" class="user-img" alt="user avatar">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">Admin</p>
                                <!-- <p class="designattion mb-0">Web Designer</p> -->
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                          
                            <li><a class="dropdown-item" href="javascript:;"><i class='bx bx-home-circle'></i><span>Dashboard</span></a>
                            </li>
                            <li><a class="dropdown-item" href="change_password.php"><i class='bx bx-dollar-circle'></i><span>Change Password</span></a>
                            </li>
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li><a class="dropdown-item" href="logout.php"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->	

        	<!--end header -->