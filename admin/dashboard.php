<?php 
include('inc/header.php');
include('inc/sidebar.php');
  
 
 $total_product=$taps9->self_query("SELECT COUNT(id) FROM `tbl_product` WHERE 1");

    $total_category=$taps9->self_query("SELECT COUNT(id) FROM `tbl_category` WHERE 1");

    $total_sub_category=$taps9->self_query("SELECT COUNT(id) FROM `sub_category` WHERE 1");

    $total_coupon=$taps9->self_query("SELECT COUNT(id) FROM `tbl_coupon` WHERE 1");

    $total_customer=$taps9->self_query("SELECT COUNT(id) FROM `tbl_customer_list` WHERE 1");
  
?>


<!--start page wrapper -->
          
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    

                                    <p class="mb-0 text-secondary">Total Banner</p>
                                    <h4 class="my-1 text-info"><?php echo $total_product[0]['COUNT(id)'];?></h4>
                                    <!-- <p class="mb-0 font-13">+2.5% from last week</p> -->
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Lawyer</p>
                                    <h4 class="my-1 text-danger"><?php echo $total_category[0]['COUNT(id)'];?></h4>
                                    <!-- <p class="mb-0 font-13">+5.4% from last week</p> -->
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='bx bxs-category'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!--     <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Product Sub Category</p>
                                    <h4 class="my-1 text-success"><?php echo $total_sub_category[0]['COUNT(id)'];?></h4>
                                   
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-category' ></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Testimonial</p>
                                    <h4 class="my-1 text-warning"><?php echo $total_coupon[0]['COUNT(id)'];?></h4>
                                    <!-- <p class="mb-0 font-13">+8.4% from last week</p> -->
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-coupon'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Blog</p>
                                    <h4 class="my-1 text-warning"><?php echo $total_customer[0]['COUNT(id)'];?></h4>
                                    <!-- <p class="mb-0 font-13">+8.4% from last week</p> -->
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-group'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->

            

         


          
 

        </div>
    </div>
        <!--end page wrapper -->

        <?php 

include "inc/footer.php";
    ?>