<?php 
include('inc/header.php');
include('inc/sidebar.php'); 
@$edit_id = (int)$_GET['edit'];
if(isset($_REQUEST['submit']) && $edit_id==0)
{

    $taps9->add_gallery($_POST);
}
if(isset($_POST['submit']) && $edit_id!=0)
{
    $taps9->update_gallery($_POST,$edit_id);
}
if($edit_id!=0)
{
    $get_gallery_info = $taps9->fetch_rows("tbl_gallery","where id=$edit_id");

    
} 

?>
<!-- 
<script>
  $(document).ready(function() {

    $("#cat_id").change(function() {                
    // alert(this.value);
    var cat_id= this.value;
    
      var data = 'cat_id=' + cat_id;
      $.ajax({    //create an ajax request to display.php
        type: "post",
        url: "get_ajax_subcat.php",             
       // dataType: "html",   //expect html to be returned 
       data:data,  
        success: function(response){                    
            $("#sub_cat").html(response); 
            // alert(response);
        }

        });
    });

 

});
 </script> -->

<div class="container">


 <div class="row">

                        <div class="col-xl-12 mx-auto">

                            <h6 class="mb-0 text-uppercase">Gallery Form</h6>
                            <hr/>
                            
                            <div class="card border-top border-0 border-4 border-primary">
                                <div class="card-body p-5">
                                    <div class="card-title d-flex align-items-center">
                                        <div><i class="fa fa-ticket"></i>
                                        </div>
                                        <h5 class="mb-0 text-primary">Add Image</h5>

                                    </div>

                                    <hr>
                                  <form method="post" enctype="multipart/form-data">
                            <div class="row"> 

 <?php
 if($edit_id=='0'){
                            if($_SESSION['msg']!=''){
                            ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
 <?=$_SESSION['msg']?>
  <a href="session_unset.php?page=<?=$page?>" ><span class="btn-close"  ></span></a>
</div>

<?php } }  ?>


                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title *</label>
                                        <input type="text" class="form-control" placeholder="Enter Title" required name="title" id="Title" value="<?=$get_gallery_info['title']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                         
                                
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Photo</label>
                                        <input type="file" class="form-control image-file" name="image">
                                    </div>  
                                    <?php
                                    if($edit_id!=0)
                                    {
                                        if($get_gallery_info['image']!='')
                                        {
                                            ?>
                                             <br>
                                            <img src="../images/main_img/<?=$get_gallery_info['image']?>" style="height:100px;width:100px; ">
                                          
                                            <?php
                                        }
                                    }
                                    ?>
                                 </div> 
       
 
                              
                                                            
                            </div>   
                            
                            <br> 
                            <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>



                        </form>
                                </div>
                            </div>
                           
                        </div>
                    </div>

 
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">

$("#mobile_no").on("keypress", function(evt) {
  var keycode = evt.charCode || evt.keyCode;
  if (keycode == 46) {
    return false;
  }
});
 

    CKEDITOR.replace('editor', {
        filebrowserUploadUrl: 'ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
    /*CKEDITOR.replace('editor2', {
        filebrowserUploadUrl: 'ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
    */
    
    </script>
 <?php 
include "inc/footer.php";
    ?>

