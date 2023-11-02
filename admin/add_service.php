<?php 
include('inc/header.php');
include('inc/sidebar.php'); 
@$edit_id = (int)$_GET['edit'];
if(isset($_REQUEST['submit']) && $edit_id==0)
{

    $taps9->add_service($_POST);
}
if(isset($_POST['submit']) && $edit_id!=0)
{
    $taps9->update_service($_POST,$edit_id);
}
if($edit_id!=0)
{
    $get_service_info = $taps9->fetch_rows("tbl_services","where id=$edit_id");

    
} 

?>
<style>
    .form-group
    {
        padding-bottom:10px !important;
    }
    </style>
<div class="container">


 <div class="row">

                        <div class="col-xl-12 mx-auto">

                            <h6 class="mb-0 text-uppercase">Service Form</h6>
                            <hr/>
                            
                            <div class="card border-top border-0 border-4 border-primary">
                                <div class="card-body p-5">
                                    <div class="card-title d-flex align-items-center">
                                        <div><i class="fa fa-ticket"></i>
                                        </div>
                                        <h5 class="mb-0 text-primary">Add Service</h5>

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

                
                <div class="form-group">
                    <label>Select Parent Page</label>
                    <select name="p_id" id="p_id" class="single-select" data-style="py-0" required="" data-live-search="true" >

                        <option value="">Parent Page</option>
                        
                        <?php    
                    $page_list = $taps9->view_list("tbl_content","status = '1'","limit 500");
                    $sr=0;
                    for($i=0;$i<sizeof($page_list);$i++)
                    {
                        
                        $sr++;
                    ?>
                                    <option value="<?=$page_list[$i]['id']?>" <?php if(@$get_service_info['p_id']==$page_list[$i]['id']) echo 'selected'; ?>><?=$page_list[$i]['page']?></option>
                                <?php    
                                }
                                ?>            
                    </select>
                </div>     
            </div>     

            <div class="col-md-12">
                        <div class="form-group">
                            <label>Page Title *</label>
                            <input type="text" class="form-control" placeholder="Enter Page Title" required name="p_title" id="p_title" value="<?=$get_service_info['p_title']?>">
                
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Page Description *</label>
                            <input type="text" class="form-control" placeholder="Enter Page Description" required name="p_description" id="p_description" value="<?=$get_service_info['p_description']?>">
                
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Page Keywords *</label>
                            <input type="text" class="form-control" placeholder="Enter Page Keywords" required name="p_keywords" id="p_keywords" value="<?=$get_service_info['p_keywords']?>">
                
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

            
        <div class="col-md-12">
                <div class="form-group">
                    <label>Small Image</label>
                    <input type="file" <?php
                if($edit_id=='')
                { echo 'required';}?> class="form-control image-file" name="logo">
                </div>  
                <?php
                if($edit_id!=0)
                {
                    if($get_service_info['logo1']!='')
                    {
                        ?>
                            <br>
                        <img src="../images/main_img/<?=$get_service_info['logo1']?>" style="height:100px;width:100px; ">
                        
                        <?php
                    }
                }
                ?>
                </div>

            
        <div class="col-md-12">
                <div class="form-group">
                    <label>Banner Image</label>
                    <input type="file" <?php
                if($edit_id=='')
                { echo 'required';}?> class="form-control image-file" name="image">
                </div>  
                <?php
                if($edit_id!=0)
                {
                    if($get_service_info['image']!='')
                    {
                        ?>
                            <br>
                        <img src="../images/content/<?=$get_service_info['image']?>" style="height:100px;width:100px; ">
                        
                        <?php
                    }
                }
                ?>
                </div>
        
                <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <textarea type="text" class="form-control" placeholder="Enter Content" id="editor" name="content"><?=$get_service_info['content']?></textarea>
                    <div class="help-block with-errors"></div>
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

