<?php 
include('inc/header.php');
include('inc/sidebar.php');
  
 
@$edit_id = $_GET['edit'];
  
@$edit_id = $_GET['edit'];
if(isset($_REQUEST['submit']) && $edit_id==0)
{
    $use_charli->add_category($_POST);
}
if(isset($_POST['submit']) && $edit_id!=0)
{
    $use_charli->update_category($_POST,$edit_id);
}
if($edit_id!=0)
{
    $get_category_info = $use_charli->fetch_rows("tbl_category","where id=$edit_id");
}
  
?>

<div class="container">


 <div class="row">
                        <div class="col-xl-10 mx-auto">

                            <h6 class="mb-0 text-uppercase">Category Form</h6>
                            <hr/>
                            
                            <div class="card border-top border-0 border-4 border-primary">
                                <div class="card-body p-5">
                                    <div class="card-title d-flex align-items-center">
                                        <div><i class="fa fa-ticket"></i>
                                        </div>
                                        <h5 class="mb-0 text-primary">Add Category</h5>
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
                                        <label>Title *</label>
                                        <input type="text" class="form-control" placeholder="Enter Title"  name="title" id="title" value="<?=$get_category_info['title']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Header Position *</label>
                                        <input type="number" class="form-control" placeholder="Enter Title"  name="header_position" id="title" value="<?=$get_category_info['header_position']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Home Page Position *</label>
                                        <input type="number" class="form-control" placeholder="Enter Title"  name="home_page_position" id="title" value="<?=$get_category_info['home_page_position']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                             
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Metakey*</label>
                                        <textarea type="text" class="form-control" placeholder="Enter Metakey Here" name="metakey"><?=$get_category_info['metakey']?></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <textarea type="text" class="form-control" placeholder="Enter Meta Description Here" name="metadesc"><?=$get_category_info['metadesc']?></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                 
                                
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea type="text" class="form-control" placeholder="Enter Description" id="editor" name="description"><?=$get_category_info['description']?></textarea>
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
                                        if($get_category_info['image']!='')
                                        {
                                            ?>
                                            <img src="../images/main_img/<?=$get_category_info['image']?>" style="height:100px;width:100px; ">
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

