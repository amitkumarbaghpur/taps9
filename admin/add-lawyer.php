<?php 
include('inc/header.php');
include('inc/sidebar.php'); 
@$edit_id = (int)$_GET['edit'];
if(isset($_REQUEST['submit']) && $edit_id==0)
{

    $taps9->add_lawyer($_POST);
}
if(isset($_POST['submit']) && $edit_id!=0)
{
    $taps9->update_lawyer($_POST,$edit_id);
}
if($edit_id!=0)
{
    $get_lawyer_info = $taps9->fetch_rows("tbl_lawyer","where id=$edit_id");

    
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

                            <h6 class="mb-0 text-uppercase">Lawyer Form</h6>
                            <hr/>
                            
                            <div class="card border-top border-0 border-4 border-primary">
                                <div class="card-body p-5">
                                    <div class="card-title d-flex align-items-center">
                                        <div><i class="fa fa-ticket"></i>
                                        </div>
                                        <h5 class="mb-0 text-primary">Add Lawyer</h5>

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
                                        <label>Select State *</label>
                                        <select name="state_id" id="state_id" class="single-select" data-style="py-0" required="" data-live-search="true" >

                                            <option value="">Select</option>
                                            
                                            <?php
                                        $state_list = $taps9->view_list("tbl_state","status = '1'","limit 500");
                                        $sr=0;
                                        for($i=0;$i<sizeof($state_list);$i++)
                                        {
                                            
                                            $sr++;
                                        ?>
                                                        <option value="<?=$state_list[$i]['id']?>" <?php if(@$get_lawyer_info['state_id']==$state_list[$i]['id']) echo 'selected'; ?>><?=$state_list[$i]['title']?></option>
                                                   <?php
                                                    }
                                                    ?>
                                        </select>
                                    </div> 
                                </div> 



                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name *</label>
                                        <input type="text" class="form-control" placeholder="Enter Name" required name="name" id="name" value="<?=$get_lawyer_info['name']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email *</label>
                                        <input type="email" class="form-control" placeholder="Enter Email" required name="email" id="email" value="<?=$get_lawyer_info['email']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address *</label>
                                        <input type="text" class="form-control" placeholder="Enter Address" required name="address" id="address" value="<?=$get_lawyer_info['address']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Experience *</label>
                                        <input type="text" class="form-control" placeholder="Enter Experience" required name="experience" id="experience" value="<?=$get_lawyer_info['experience']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Rating Point *</label>
                                        <input type="text" class="form-control" placeholder="Enter Rating Point" required name="rating_point" id="rating_point" value="<?=$get_lawyer_info['rating_point']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Rating Count *</label>
                                        <input type="text" class="form-control" placeholder="Enter Rating Count" required name="rating_count" id="rating_count" value="<?=$get_lawyer_info['rating_count']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                              

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Phone *</label>
                                        <input type="text" class="form-control" placeholder="Enter Phone" required name="phone" id="phone" value="<?=$get_lawyer_info['phone']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Languages *</label>
                                        <input type="text" class="form-control" placeholder="Enter Languages" required name="languages" id="Languages" value="<?=$get_lawyer_info['languages']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status *</label>
                                        <input type="text" class="form-control" placeholder="Enter Status" required name="lawyer_status" id="lawyer_status" value="<?=$get_lawyer_info['lawyer_status']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Courts *</label>
                                        <input type="text" class="form-control" placeholder="Enter Courts" required name="courts" id="Courts" value="<?=$get_lawyer_info['courts']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                               

                                
                                                    <div class="col-md-12 mt-5">
                                    <div class="form-group">
                                        <label>About</label>
                                        <textarea type="text" class="form-control" placeholder="Enter About"  id="editor" name="description"><?=$get_lawyer_info['description']?></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>   
                                <div class="col-md-12 mt-5">
                                    <div class="form-group">
                                        <label>Practice Area</label>
                                        <textarea type="text" class="form-control" placeholder="Enter Practice Area" name="practice_area"><?=$get_lawyer_info['practice_area']?></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>   
                                
                             <!--     <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Youtube Video Link </label>
                                        <input type="text" class="form-control" placeholder="Enter Youtube Link"  name="youtube_link" id="title" value="<?=$get_lawyer_info['youtube_link']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div> -->
                                
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Photo</label>
                                        <input type="file" class="form-control image-file" name="image">
                                    </div>  
                                    <?php
                                    if($edit_id!=0)
                                    {
                                        if($get_lawyer_info['image']!='')
                                        {
                                            ?>
                                             <br>
                                            <img src="../images/main_img/<?=$get_lawyer_info['image']?>" style="height:100px;width:100px; ">
                                          
                                            <?php
                                        }
                                    }
                                    ?>
                                 </div> 
                                
                                


                                <!--  <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Add More Images</label>
                                        <input type="file" class="form-control image-file" name="add_images[]"  >
                                    </div>
                                     <br> <br>         
                                </div>
                                 -->
                                  
  <?php
                                    // if($edit_id!=0)
                                    // {
                                    //    // echo "SELECT  `image` FROM `tbl_lawyer_image` where product_id=$edit_id"; die;
                                    //     $get_images =  $taps9->self_query("SELECT  `image`,`id` FROM `tbl_lawyer_image` where product_id=$edit_id");
                                    //     if($get_images[0]['image']!='')
                                    //     {
                                    //      for($i=0;$i<count($get_images);$i++)
                                    //     {
                                            ?>
 
                                
       <!--    <div class="col-md-2" style=" margin-bottom:10px;">
              
               <a  href="delete_produt_image.php?delete=<?=$get_images[$i]['id']?>" style=""> X </a>                             
<img src="../images/main_img/<?=$get_images[$i]['image']?>" style="height:100px;width:100%;" />
 
          </div> -->
                               
                                            <?php
                                    //     }
                                    //     }
                                    // }
                                    ?>
                                      
                              
                                                            
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

