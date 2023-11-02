<?php 
include('inc/header.php');
include('inc/sidebar.php');


 
 $baseurl =$use_charli->base_url();
   @$edit_id = $_GET['edit'];
if(isset($_REQUEST['submit']) && $edit_id==0)
{
    $use_charli->add_sub_category($_POST);
}
if(isset($_POST['submit']) && $edit_id!=0)
{
    $use_charli->update_sub_category($_POST,$edit_id);
}

if($edit_id!=0)
{
    $get_sub_category_info = $use_charli->fetch_rows("sub_category","where id=$edit_id");
}

if(isset($_POST['active']))
{

    if(count($_POST['opt'])==1)
    {
        $id = "where id='".$_POST['opt'][0]."'";
        $total_row = 1;
    }
    else
    {
        $total_row = count($_POST['opt']);
        $id_emp = implode(',',$_POST['opt']);
        $id = "where id in ($id_emp)";

    }

    $use_charli->active("sub_category",$id,$total_row,$page);
}
if(isset($_POST['deactive']))
{
  

    if(count($_POST['opt'])==1)
    {
        $id = "where id='".$_POST['opt'][0]."'";
        $total_row = 1;
    }
    else
    {
        $total_row = count($_POST['opt']);
        $id_emp = implode(',',$_POST['opt']);
        $id = "where id in ($id_emp)";

    }

    $use_charli->deactive("sub_category",$id,$total_row,$page);
}
if(isset($_POST['delete']))
{

    if(count($_POST['opt'])==1)
    {
        $id = "where id='".$_POST['opt'][0]."'";
        $total_row = 1;
    }
    else
    {
        $total_row = count($_POST['opt']);
        $id_emp = implode(',',$_POST['opt']);
        $id = "where id in ($id_emp)";

    }

    $use_charli->delete("sub_category",$id,$total_row,$page);
}

?>    
    <script type="text/javascript">
function checkall(objForm)
{
    var x = objForm;
  
   
len = objForm.elements.length;
var i=0;
for( i=0 ; i<len ; i++) 
{
if (objForm.elements[i].type=='checkbox') 
{
objForm.elements[i].checked=objForm.check_all.checked;
}
}
}  
</script>
         
         <div class="container">


 <div class="row">
                        <div class="col-xl-10 mx-auto">

                            <h6 class="mb-0 text-uppercase">Add Sub Category</h6>
                            <hr/>
                            
                            <div class="card border-top border-0 border-4 border-primary">
                                <div class="card-body p-5">
                                   <!--  <div class="card-title d-flex align-items-center">
                                        <div><i class="fa fa-ticket"></i>
                                        </div>
                                        <h5 class="mb-0 text-primary"> Add sub_category</h5>
                                    </div>
                                    <hr> -->
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
                                        <label>Category*</label>
                                        <select  required="" name="category_id" class="selectpicker form-control " data-style="py-0" required data-live-search="true"  >

                                            <option value="">Plese Select Category</option>
                                        
                            <?php
                                        $category_list = $use_charli->view_list("tbl_category","status = '1'","limit 500");
                                        $sr=0;
                                        for($i=0;$i<sizeof($category_list);$i++)
                                        {
                                            
                                            $sr++;
                                        ?>
                                                        <option value="<?=$category_list[$i]['id']?>" <?php if(@$get_sub_category_info['category_id']==$category_list[$i]['id']) echo 'selected'; ?>><?=$category_list[$i]['title']?></option>
                                                   <?php
                                                    }
                                                    ?>
                                                   
                                        </select>
                                    </div> 
                                </div>   

                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label> Sub Category *</label>
                                        <input required="" type="text" class="form-control" placeholder="Enter Sub Category"  name="sub_category" id="sub_category" value="<?=$get_sub_category_info['sub_category']?>">

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
                                        if($get_sub_category_info['image']!='')
                                        {
                                            ?>
                                            <img src="../images/main_img/<?=$get_sub_category_info['image']?>" style="height:100px;width:100px; ">
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>


                            </div>  <br>                           
                            <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>



                        </form>
                                </div>
                            </div>
                           
                        </div>
                    </div>

 
</div>
       
                 
                <h6 class="mb-0 text-uppercase">sub_category Details</h6>
                <hr/>
                <div class="card">
                    <div class="card-body">
                        <form  method="post" >
                        <div class="table-responsive">
                            <table id="example2" class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr >
                                        <th>Sr.</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                          <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input"  id="check_all" onclick="checkall(this.form)" value="check_all" name="checkbox">
                                    <label for="checkbox1" class="mb-0"></label>
                                </div>
                            </th>
                                         
                                    </tr>
                                </thead>
                                <tbody>
                                    

                                     <?php
                       $help_list = $use_charli->self_query("select * from sub_category  order by id desc");
                       
                        if(count($help_list)==0)
                        {
                            echo '<tr><td><td><td><span style="color:red">No Record Found</span></td></td></td></tr>';
                        }
                        else
                        {
                            for($i=0;$i<count($help_list);$i++)
                            {

                         //  echo "select * from tbl_category  where id='".$help_list[$i]['category_id']."'"; die;   
                                
 $category_list = $use_charli->self_query("select * from tbl_category  where id='".$help_list[$i]['category_id']."'");
                       ?>
                        <tr>
                            
                            <td><?=$i+1?></td>
                           
                                        <td> <?=$category_list[0]['title']?></td> 
                                        <td> <?=$help_list[$i]['sub_category']?></td> 
                                      
                                       
                                      <td><?php if($help_list[$i]['status']==1) {?> <button type="button" class="btn btn-success" style="background-color: green;">Active</button><?php } else {?><button type="button" class="btn btn-danger" style="background-color: red;">Deactive</button><?php } ?></td>
                                        
                                       <td>
											  <div class="text-center">
                                  
                                    <a  href="manage-sub-category.php?edit=<?=$help_list[$i]['id']?>">Edit <i class="fa fa-eye"></i></a>
                                    
                                </div>

											</td>
                                         

                                <td>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkbox2" name="opt[]" value="<?=$help_list[$i]['id']?>">
                                    <label for="checkbox2" class="mb-0"></label>
                                </div>
                            </td>
                                     
                                    </tr>

                                <?php } }?>

                                     
                                </tbody>
                                 
                            </table>
                        </div>

                         <div class="row">
                <div class="col-md-4"></div>
                  <div class="col-md-8">
                       <button type="submit" class="btn btn-primary" name="active">Active</button>
                       <button type="submit" class="btn btn-primary" name="deactive">Deactive</button>
                       <button type="submit" class="btn btn-primary" name="delete" onClick="return confirm('Are You Sure')">Delete</button>
                  </div>
               </div>
               <br>
               </form>

                    </div>
                </div>
            </div>
        </div>
         
        <!--end page wrapper -->
                <!--end page wrapper -->
                <?php 

        include 'inc/footer.php';
    ?>

   