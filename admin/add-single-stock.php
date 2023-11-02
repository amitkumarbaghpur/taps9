<?php 
include('inc/header.php');
include('inc/sidebar.php'); 
@$pro_id = (int)$_GET['pro_id'];

@$cat_id = (int)$_GET['cat_id'];

if(isset($_REQUEST['submit']) && $edit_id==0)
{
    $use_charli->add_color_size_stock($_POST,$pro_id,$cat_id);
}


?>

 

    
<div class="container">


 <div class="row">

                        <div class="col-xl-10 mx-auto">

                            <h6 class="mb-0 text-uppercase">Stock Form</h6>
                            <hr/>
                            
                            <div class="card border-top border-0 border-4 border-primary">
                                <div class="card-body p-5">
                                    <div class="card-title d-flex align-items-center">
                                        <div><i class="fa fa-ticket"></i>
                                        </div>
                                        <h5 class="mb-0 text-primary">Add Stock</h5>

                                    </div>

                                    <hr>
                                  <form method="post"  enctype="multipart/form-data">
                            <div class="row"> 

 <?php
                            if($_SESSION['msg']!=''){
                            ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
 <?=$_SESSION['msg']?>
  <a href="session_unset.php?page=<?=$page?>" ><span class="btn-close"  ></span></a>
</div>

<?php } ?>

                    
 
                                
                           

  <div class="row mt-5" id="dynamic_field">
                <div class="col-md-9">
                        <div class="row">
                        <div class="col-md-3">
                            <label>Color</label>
                            <input type="text" placeholder="Color" class="form-control"  name="color[]" required />
                        </div>

                        <div class="col-md-3">
                            <label>Size</label>
                            <input type="text" placeholder="Size" class="form-control"  name="size[]" required />
                        </div>

                        <div class="col-md-3">
                            <label>Price</label>
                            <input type="text" placeholder="Price" class="form-control" name="price[]" required />
                        </div>

                        <div class="col-md-3">
                            <label>Dis. Price</label>
                            <input type="text" placeholder="Dis. Price" class="form-control" name="discount_price[]" required />
                        </div>

                        <div class="col-md-3">
                             <label>Quantity</label>
                            <input type="text" placeholder="Quantity" class="form-control"  name="qty[]" required />
                        </div>
 
                        <div class="col-md-3">
                            <label>Image 1</label>

                              <input type="file" required class="form-control image-file" name="image1[]">
                        </div>




 
                        <div class="col-md-3">
                            <label>Image 2</label>

                           <input type="file" class="form-control image-file" name="image2[]"  >
                        </div>
 
                        <div class="col-md-3">
                            <label>Image 3</label>

                           <input type="file" class="form-control image-file" name="image3[]"  >
                        </div>
 
                        <div class="col-md-3">
                            <label>Image 4</label>

                           <input type="file" class="form-control image-file" name="image4[]"  >
                        </div>
 
                       
                       
                        
                    </div>
                    </div>
                    <div class="col-md-3">
                         <label> &nbsp;&nbsp;<br>&nbsp;&nbsp;</label>
                     <button type="button" name="add" id="add" class="btn btn-success">Add More</button> 
                     </div>
                
            </div>
            
            
           
     
                                

                                          
 
            
            
          <script>
        $(document).ready(function(){
            var i = 1;
            $('#add').click(function(){
                i++;
                $('#dynamic_field').append('<div class="row" id="row'+i+'"><div class="col-md-9" style="margin-top: 20px;"><div class="row"><div class="col-md-3"><input type="text" placeholder="Color" class="form-control"   name="color[]" required /></div><div class="col-md-3"><input type="text" placeholder="Size" class="form-control"   name="size[]" required /></div><div class="col-md-3"><input type="text" class="form-control"  placeholder="Price"  name="price[]" required /></div><div class="col-md-3"><input type="text" class="form-control"  placeholder="Dis. Price"  name="discount_price[]" required /></div><div class="col-md-3 mt-3"><input type="text" class="form-control"  placeholder="Quantity"  name="qty[]" required /></div> <div class="col-md-3"><label>Image</label><input type="file" required class="form-control image-file" name="image1[]"></div><div class="col-md-3"><label>Image 2</label><input type="file" class="form-control image-file" name="image2[]"  ></div><div class="col-md-3"><label>Image 3</label><input type="file" class="form-control image-file" name="image3[]"  ></div><div class="col-md-3"><label>Image 4</label><input type="file" class="form-control image-file" name="image4[]"  ></div> </div></div><div class="col-md-3" style="margin-top: 20px;text-align: center;"><button  name="remove" id="'+i+'" class="btn btn-danger btn_remove">Remove</button></div></div>');
            });

            $(document).on('click','.btn_remove', function(){
                var button_id = $(this).attr("id");
                $("#row"+button_id+"").remove();
            });

           
           
        });
    </script>
   
                       
                              
 
                              
                                                            
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
    <!-- Bootstrap JS -->
    <!--plugins-->
    
   


 <?php 
include "inc/footer.php";
    ?>

