<?php 
 
include('inc/header.php');
include('inc/sidebar.php'); 

if(isset($_POST['change_password']))
{
    $taps9->change_password($_POST);
}
$old_password=$taps9->admin_password();
?>
 
<div class="container">


 <div class="row">
                        <div class="col-xl-7 mx-auto">

                            <h6 class="mb-0 text-uppercase">Change Password</h6>
                            <hr/>
                            
                            <div class="card border-top border-0 border-4 border-primary">
                                <div class="card-body p-5">
                                    <div class="card-title d-flex align-items-center">
                                        <div><i class="fa fa-ticket"></i>
                                        </div>
                                        <h5 class="mb-0 text-primary">Change Password</h5>

                                    </div>

                                    <hr>
                        <form  method="post" enctype="multipart/form-data">
                            <div class="row">  
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Old Password *</label>
                                        <input type="password" required name="oldpassword"  class="form-control">
                                               

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label>New Password *</label>
                                        
                                         <input type="password" required name="newpassword" id=""    class="form-control"/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Confirm Password *</label>
                                       <input type="password" required name="retypepassword" class="form-control"/>

                                        <div class="help-block with-errors"></div>
                                    </div>
                                    
                                     
                                </div> 
                                      
                            <div class="col-md-12">
                                   <div class="form-group"><br>
                                <button type="submit" class="btn btn-primary mr-2" name="change_password">Change Password</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                        </div>



                   </div>
                            </div>
                           
                        </div>
                    </div>

 
</div>
    <script type="text/javascript">

    CKEDITOR.replace('editor', {
        filebrowserUploadUrl: 'ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
    /*CKEDITOR.replace('editor2', {
        filebrowserUploadUrl: 'ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
    */
    $('#category_name').on('input',function(){
           var cat = $('#category_name').val();
           var cat = cat.replace(/ /gi,"-");
           $('#cat_url').val(cat.toLowerCase());
    });

    </script>

   <?php include('inc/footer.php'); ?>