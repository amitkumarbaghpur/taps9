<?php 
include('inc/header.php');
include('inc/sidebar.php'); 
@$edit_id = (int)$_GET['edit'];
 
if(isset($_POST['submit']) && $edit_id!=0)
{
    $use_charli->update_color_size_stock($_POST,$edit_id);
}
if($edit_id!=0)
{
    $get_product_stock_info =   $use_charli->self_query("SELECT a.title product_name,b.id id,b.product_id product_id,b.color color,b.size size,b.price price,b.discount_price discount_price,b.qty qty FROM   tbl_size_color_stock b LEFT JOIN tbl_product a ON a.id = b.product_id  where b.id='".$edit_id."' order by b.id desc")[0];

    
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
                                        <h5 class="mb-0 text-primary">Edit Stock</h5>

                                    </div>

                                    <hr>
                                  <form method="post"  >
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
                                        <label>Select Product *</label>
                                        <select name="product_id" id="cat_id" class="single-select" data-style="py-0" required="" data-live-search="true" >

                                            <option value="">Plese Select</option>
                                            
                                            <?php
                                        $pro_list = $use_charli->view_list("tbl_product","status = '1'","limit 500");
                                        $sr=0;
                                        for($i=0;$i<sizeof($pro_list);$i++)
                                        {
                                            
                                            $sr++;
                                        ?>
                                                        <option value="<?=$pro_list[$i]['id']?>" <?php if(@$get_product_stock_info['product_id']==$pro_list[$i]['id']) echo 'selected'; ?>><?=$pro_list[$i]['title']?></option>
                                                   <?php
                                                    }
                                                    ?>
                                        </select>
                                    </div> 
                                </div> 
 
                                
                           

                                

                                          
  <div class="row mt-5" id="dynamic_field">
                <div class="col-md-12">
                        <div class="row">
                        <div class="col">
                            <label>Color</label>
                            <input type="text" placeholder="Color" value="<?=$get_product_stock_info['color']?>" class="form-control"  name="color" required />
                        </div>

                        <div class="col">
                            <label>Size</label>
                            <input type="text" placeholder="Size" value="<?=$get_product_stock_info['size']?>" class="form-control"  name="size" required />
                        </div>

                        <div class="col">
                            <label>Price</label>
                            <input type="text" placeholder="Price" value="<?=$get_product_stock_info['price']?>" class="form-control" name="price" required />
                        </div>


                        <div class="col">
                            <label>Dis. Price</label>
                            <input type="text" placeholder="Dis. Price" value="<?=$get_product_stock_info['discount_price']?>" class="form-control" name="discount_price" required />
                        </div>

                        <div class="col">
                             <label>Quantity</label>
                            <input type="text" placeholder="Quantity" value="<?=$get_product_stock_info['qty']?>" class="form-control"  name="qty" required />
                        </div>
 

                        

                        
                    </div>
                    </div>
                     
                
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
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>
        <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script>
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
        $('.multiple-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>


 <?php 
include "inc/footer.php";
    ?>

