<?php 
include('inc/header.php');
include('inc/sidebar.php'); 
@$edit_id = (int)$_GET['edit'];
if(isset($_REQUEST['submit']) && $edit_id==0)
{

    $use_charli->add_product($_POST);
}
if(isset($_POST['submit']) && $edit_id!=0)
{
    $use_charli->update_product($_POST,$edit_id);
}
if($edit_id!=0)
{
    $get_product_info = $use_charli->fetch_rows("tbl_product","where id=$edit_id");

    
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

                            <h6 class="mb-0 text-uppercase">product Form</h6>
                            <hr/>
                            
                            <div class="card border-top border-0 border-4 border-primary">
                                <div class="card-body p-5">
                                    <div class="card-title d-flex align-items-center">
                                        <div><i class="fa fa-ticket"></i>
                                        </div>
                                        <h5 class="mb-0 text-primary">Add product</h5>

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
                                        <label>Select Category *</label>
                                        <select name="category_id" id="cat_id" class="single-select" data-style="py-0" required="" data-live-search="true" >

                                            <option value="">Plese Select</option>
                                            
                                            <?php
                                        $category_list = $use_charli->view_list("tbl_category","status = '1'","limit 500");
                                        $sr=0;
                                        for($i=0;$i<sizeof($category_list);$i++)
                                        {
                                            
                                            $sr++;
                                        ?>
                                                        <option value="<?=$category_list[$i]['id']?>" <?php if(@$get_product_info['category_id']==$category_list[$i]['id']) echo 'selected'; ?>><?=$category_list[$i]['title']?></option>
                                                   <?php
                                                    }
                                                    ?>
                                        </select>
                                    </div> 
                                </div> 




                            <!--     <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Select Sub Category  </label>
                                        <select id="sub_cat" name="sub_cat_id" class="selectpicker form-control " data-style="py-0" data-live-search="true" >

                                            <option value="">Select Sub Category</option>
                                            
                                            <?php
                                        $sub_cat_list = $use_charli->view_list("sub_category","status = '1' && category_id='".$get_product_info['category_id']."'","limit 500");
                                        $sr=0;
                                        for($i=0;$i<sizeof($sub_cat_list);$i++)
                                        {
                                            
                                            $sr++;
                                        ?>
            <option value="<?=$sub_cat_list[$i]['id']?>" <?php if(@$get_product_info['sub_cat_id']==$sub_cat_list[$i]['id']) echo 'selected'; ?>><?=$sub_cat_list[$i]['sub_category']?></option>
                                                   <?php
                                                     }
                                                    ?>
                                        </select>
                                    </div> 
                                </div>  -->
                             
                         <!--    
                             <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Header Slider</label>
                                        <input type="file" class="form-control image-file" name="header_image" <?php if($edit_id==0) echo 'required'; ?>>
                                    </div> -->
                                    <?php
                                    // if($edit_id!=0)
                                    // {
                                    //     if($get_product_info['header_image']!='')
                                    //     {
                                             ?>
                                           <!-- <img src="../images/main_img/<?=$get_product_info['header_image']?>" style="height:100px;width:100px; "> -->
                                             <?php
                                    //     }
                                    // }
                                    ?>
                                <!-- </div> -->
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product Name *</label>
                                        <input type="text" class="form-control" placeholder="Enter Product Name" required name="title" id="title" value="<?=$get_product_info['title']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>


                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Short Description *</label>
                                        <input type="text" class="form-control" placeholder="Enter Short Description" required name="short_desc" id="title" value="<?=$get_product_info['short_desc']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product Type </label>
                     <select id="product_type" name="product_type" class="selectpicker form-control " data-style="py-0" data-live-search="true" >

                     <option value="">Select Product Type</option>

                     <option value="1" <?php if($get_product_info['product_type']==1){echo 'selected';} ?>>BEST SELLERS</option>

                     <option value="2" <?php if($get_product_info['product_type']==2){echo 'selected';} ?>>Featured Products</option>

                     <!-- <option value="3" <?php if($get_product_info['product_type']==3){echo 'selected';} ?>>Best Offer</option> -->


                                        </select>

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
<!-- 
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product Price *</label>
                                        <input type="number" class="form-control" placeholder="Enter Price" required name="price" id="price" value="<?=$get_product_info['price']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product Discount Price *</label>
                                        <input type="number" class="form-control" placeholder="Enter Discount" required  name="discount" id="discount" value="<?=$get_product_info['discount_price']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div> -->


<?php
if($edit_id!='0'){

$size_color=$use_charli->self_query("select * from tbl_size_color_stock where product_id='".$edit_id."'");
if(count($size_color)==0){
    ?>
  <div class="col-md-3">
                         <label> &nbsp;&nbsp;<br>&nbsp;&nbsp;</label>
                     <a href="add-single-stock.php?pro_id=<?=$edit_id?>&&cat_id=<?=$get_product_info['category_id']?>" class="btn btn-success">Add Stock </a> 
                     </div>
    <?php
}
for ($k=0; $k <count($size_color) ; $k++) { 
    
 
    ?>

  <div class="row mt-5" >
                <div class="col-md-9">
                        <div class="row">
                        <div class="col-md-3">
                            <input type="hidden" placeholder="Stock Id" class="form-control" value="<?=$size_color[$k]['id']?>"  name="stock_id[]" required />
                            <label>Color</label>
                            <input type="text" placeholder="Color" class="form-control" value="<?=$size_color[$k]['color']?>"  name="color[]" required />
                        </div>

                        <div class="col-md-3">
                            <label>Size</label>
                            <input type="text" placeholder="Size" value="<?=$size_color[$k]['size']?>" class="form-control"  name="size[]" required />
                        </div>

                        <div class="col-md-3">
                            <label>Price</label>
                            <input type="text" placeholder="Price" value="<?=$size_color[$k]['price']?>" class="form-control" name="price[]" required />
                        </div>

                        <div class="col-md-3">
                            <label>Dis. Price</label>
                            <input type="text" placeholder="Dis. Price" value="<?=$size_color[$k]['discount_price']?>" class="form-control" name="discount_price[]" required />
                        </div>

                        <div class="col-md-3">
                             <label>Quantity</label>
                            <input type="text" placeholder="Quantity" value="<?=$size_color[$k]['qty']?>" class="form-control"  name="qty[]" required />
                        </div>
 
                        <div class="col-md-3">
                            <label>Image 1</label>

                              <input type="file"   class="form-control image-file" name="image1[]">
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
 
                       
                         <div class="col-md-3">
                         <label> &nbsp;&nbsp;<br>&nbsp;&nbsp;</label>
                     <a href="remove_stock.php?stock_id=<?=$size_color[$k]['id']?>&&pro_id=<?=$edit_id?>"  class="btn btn-warning">Remove</a> 
                     </div>

                        
                    </div>
                    </div>
                    <?php
                    if($k==0){
                    ?>
                    <div class="col-md-3">
                         <label> &nbsp;&nbsp;<br>&nbsp;&nbsp;</label>
                     <a href="add-single-stock.php?pro_id=<?=$edit_id?>&&cat_id=<?=$get_product_info['category_id']?>" class="btn btn-success">Add More</a> 
                     </div>

                 <?php }
else{ ?>
     <div class="col-md-3">
                         
                     </div>
    <?php }

                  ?>


                
            
              <?php
                                    if($edit_id!=0)
                                    {
                                        if($size_color[$k]['image1']!='')
                                        {
                                            ?>
                                            <div class="col-md-3">
                                                 
                                            <label class="mt-5">Product Image 1</label>
                                            <img  src="../images/pro_img/<?=$size_color[$k]['image1']?>" style="height:100px;width:100px; ">

                                            <input type="hidden" name="old_image1[]" value="<?=$size_color[$k]['image1']?>">
                                        
                                        </div>
                                            <?php
                                        }
                                    }
                                    
                                    if($edit_id!=0)
                                    {
                                        if($size_color[$k]['image2']!='')
                                        {
                                            ?>
                                            <div class="col-md-3"> 
                                            <label class="mt-5">Product Image 2</label>
                                            <img  src="../images/pro_img/<?=$size_color[$k]['image2']?>" style="height:100px;width:100px; ">

                                               <input type="hidden" name="old_image2[]" value="<?=$size_color[$k]['image2']?>">

                                        </div>
                                            <?php
                                        }
                                    }

                                    
                                    if($edit_id!=0)
                                    {
                                        if($size_color[$k]['image3']!='')
                                        {
                                            ?>
                                            <div class="col-md-3"> 
                                            <label class="mt-5">Product Image 3</label>
                                            <img  src="../images/pro_img/<?=$size_color[$k]['image3']?>" style="height:100px;width:100px; ">

                                               <input type="hidden" name="old_image3[]" value="<?=$size_color[$k]['image3']?>">

                                        </div>
                                            <?php
                                        }
                                    }



                                    
                                    if($edit_id!=0)
                                    {
                                        if($size_color[$k]['image4']!='')
                                        {
                                            ?>
                                            <div class="col-md-3"> 
                                            <label class="mt-5">Product Image 4</label>
                                            <img  src="../images/pro_img/<?=$size_color[$k]['image4']?>" style="height:100px;width:100px; ">

                                               <input type="hidden" name="old_image4[]" value="<?=$size_color[$k]['image4']?>">

                                        </div>
                                            <?php
                                        }
                                    }

                                   
                                    ?>
 
 

            </div>

    <?php
}

}

else {
    ?>



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
            
            
           
     
   

   <?php
}
?>


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


                          <!--   <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product Stock</label>
                                        <input type="number" class="form-control" placeholder="Enter Stock"   name="stock" id="discount" value="<?=$get_product_info['stock']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div> -->

                                

                                

                             <!--    <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Metakey </label>
                                        <textarea type="text" class="form-control" placeholder="Enter Metakey Here" name="metakey"><?=$get_product_info['meta_keyword']?></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>  -->
                                <!-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <textarea type="text" class="form-control" placeholder="Enter Meta Description Here" name="metadesc"><?=$get_product_info['meta_description']?></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>   -->
                                 <div class="col-md-12 mt-5">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea type="text" class="form-control" placeholder="Enter Description" id="editor" name="description"><?=$get_product_info['description']?></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>   
                                
                             <!--     <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Youtube Video Link </label>
                                        <input type="text" class="form-control" placeholder="Enter Youtube Link"  name="youtube_link" id="title" value="<?=$get_product_info['youtube_link']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div> -->
                                
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image *</label>
                                        <input type="file" <?php
                                    if($edit_id=='')
                                    { echo 'required';}?> class="form-control image-file" name="image">
                                    </div>  
                                    <?php
                                    if($edit_id!=0)
                                    {
                                        if($get_product_info['image']!='')
                                        {
                                            ?>
                                             <br>
                                            <img src="../images/main_img/<?=$get_product_info['image']?>" style="height:100px;width:100px; ">
                                          
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
                                    //    // echo "SELECT  `image` FROM `tbl_product_image` where product_id=$edit_id"; die;
                                    //     $get_images =  $use_charli->self_query("SELECT  `image`,`id` FROM `tbl_product_image` where product_id=$edit_id");
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

