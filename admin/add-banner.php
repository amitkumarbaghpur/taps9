<?php 
include('inc/header.php');
include('inc/sidebar.php');
@$edit_id = $_GET['edit'];
if(isset($_REQUEST['submit']) && $edit_id==0)
{
    $taps9->add_banner($_POST);
}
if(isset($_POST['submit']) && $edit_id!=0)
{
    $taps9->update_banner($_POST,$edit_id);
}
if($edit_id!=0)
{
    $get_banner_info = $taps9->fetch_rows("tbl_banner","where id=$edit_id");
}
  
?>

<div class="container">


 <div class="row">
                        <div class="col-xl-10 mx-auto">

                            <h6 class="mb-0 text-uppercase">Banner Form</h6>
                            <hr/>
                            
                            <div class="card border-top border-0 border-4 border-primary">
                                <div class="card-body p-5">
                                    <div class="card-title d-flex align-items-center">
                                        <div><i class="fa fa-ticket"></i>
                                        </div>
                                        <h5 class="mb-0 text-primary">Add Banner</h5>
                                    </div>
                                    <hr>
                                  <form method="post" enctype="multipart/form-data">
                            <div class="row">

                            
 <?php
                            if($_SESSION['msg']!=''){
                            ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
 <?=$_SESSION['msg']?>
  <a href="session_unset.php?page=<?=$page?>" ><span class="btn-close"  ></span></a>
</div>

<?php } ?> 
                            
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Select Page *</label>
                                        <select class="form-control" name="page_id" required>
                                           <option value="1"> Home</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                                           
                               
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control image-file" name="image" <?php if($edit_id==0) echo 'required'; ?>>
                                    </div>
                                    <?php
                                    if($edit_id!=0)
                                    {
                                        if($get_banner_info['images']!='')
                                        {
                                            ?>
                                            <img src="../images/main_img/<?=$get_banner_info['images']?>" style="height:100px;width:100px; ">
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            
                            </div>  <br><br>                          
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

