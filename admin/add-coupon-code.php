    <?php 
include('inc/header.php');
include('inc/sidebar.php');


 
 $baseurl =$use_charli->base_url();
   @$edit_id = $_GET['edit'];
if(isset($_REQUEST['submit']) && $edit_id==0)
{
    $use_charli->add_coupon($_POST);
}
if(isset($_POST['submit']) && $edit_id!=0)
{
    $use_charli->update_coupon($_POST,$edit_id);
}

if($edit_id!=0)
{
    $get_coupon_info = $use_charli->fetch_rows("tbl_coupon","where id=$edit_id");
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

    $use_charli->active("tbl_coupon",$id,$total_row,$page);
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

    $use_charli->deactive("tbl_coupon",$id,$total_row,$page);
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

    $use_charli->delete("tbl_coupon",$id,$total_row,$page);
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

                            <h6 class="mb-0 text-uppercase">Coupon Code Form</h6>
                            <hr/>
                            
                            <div class="card border-top border-0 border-4 border-primary">
                                <div class="card-body p-5">
                                    <div class="card-title d-flex align-items-center">
                                        <div><i class="fa fa-ticket"></i>
                                        </div>
                                        <h5 class="mb-0 text-primary"> Add Coupon Code</h5>
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
                                        <label> Coupon Name *</label>
                                        <input type="text" class="form-control" placeholder="Enter Coupon"  name="coupon_name" id="coupon_name" value="<?=$get_coupon_info['coupon_name']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                            </div>
                            
                              <div class="col-md-12">
                                    <div class="form-group">
                                        <label> Offer (Rs.) *</label>
                                        <input type="text" class="form-control" placeholder="Enter Offer %"  name="offer" id="offer" value="<?=$get_coupon_info['offer']?>">

                                        <div class="help-block with-errors"></div>
                                    </div>
                            </div>
                            
                             <!--  <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Duration Days*</label>
                                        <input type="text" class="form-control" placeholder="Enter Duration Days"  name="duration_days" id="duration_days" value="<?=$get_coupon_info['duration_days']?>">

                                        <div class="help-block with-errors"></div>
                                     </div>
                            </div> -->
                         <!--    
                              <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Upload Candidate Photo  *</label>
                                        <input  type="file" class="form-control"  <?php if(@$edit_id==''){echo 'required';} ?>  name="image" >

                                        <div class="help-block with-errors"></div>
                                    </div>
                            </div> -->
                            
                            <br>    
                                <?php
                                 // if(@$edit_id!=''){
                                     ?>
                                     <!-- <img src="<?=$baseurl?>/images/main_img/<?=$get_coupon_info['image']?>" style="height:100px;width:100px;"> -->
                                     <?php
                                     // } 
                                     ?>
                            <br>

                            </div>  <br>                           
                            <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>



                        </form>
                                </div>
                            </div>
                           
                        </div>
                    </div>

 
</div>
       
                 
                <h6 class="mb-0 text-uppercase">coupon Detail</h6>
                <hr/>
                <div class="card">
                    <div class="card-body">
                        <form  method="post" >
                        <div class="table-responsive">
                            <table id="example2" class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr >
                                        <th>Sr.</th>
                                        <th>coupon Name</th>
                                        <th>Offer (Rs.)</th>
                                        <!-- <th>Duration Days</th> -->
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
                       $help_list = $use_charli->self_query("select * from tbl_coupon order by id desc");
                       
                        if(count($help_list)==0)
                        {
                            echo '<tr><td><td><td><span style="color:red">No Record Found</span></td></td></td></tr>';
                        }
                        else
                        {
                            for($i=0;$i<count($help_list);$i++)
                            {
                                

                       ?>
                        <tr>
                            
                            <td><?=$i+1?></td>
                           
                                        <td> <?=$help_list[$i]['coupon_name']?></td> 
                           
                                        <td> <?=$help_list[$i]['offer']?></td> 
                           
                                        <!-- <td> <?=$help_list[$i]['duration_days']?></td>  -->
                                      
                                       
                                      <td><?php if($help_list[$i]['status']=="1") {?> <button type="button" class="btn btn-success" style="background-color: green;">Active</button><?php } else {?><button type="button" class="btn btn-danger" style="background-color: red;">Deactive</button><?php } ?></td>
                                        
                                       <td>
											  <div class="text-center">
                                  
                                    <a  href="add-coupon-code.php?edit=<?=$help_list[$i]['id']?>">Edit <i class="fa fa-eye"></i></a>
                                    
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

   