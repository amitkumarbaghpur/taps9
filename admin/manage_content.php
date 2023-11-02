<?php 
include('inc/header.php');
include('inc/sidebar.php');


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

    $taps9->active("tbl_content",$id,$total_row,$page);
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

    $taps9->deactive("tbl_content",$id,$total_row,$page);
}
if(isset($_POST['delete']))
{

        $total_row = count($_POST['opt']);
        $id_emp = implode(',',$_POST['opt']);
        $id = "where id in ($id_emp)";
        $taps9->delete("tbl_content",$id,$total_row,$page);
       
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
         
      
                 
                <h6 class="mb-0 text-uppercase">Content List </h6>
              
                <hr/>
                <div class="card">
                    <div class="card-body">
                        
<?php
                    if($_SESSION['msg']!=''){
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
<?=$_SESSION['msg']?>
<a href="session_unset.php?page=<?=$page?>" ><span class="btn-close"  ></span></a>
</div>

<?php  }  ?>
              
                        <form  method="post" >
                        <div class="table-responsive">
                            <table id="example2" class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                         <th>Sr.</th>
                                         <th>Page</th>
                                         <th>Main Image</th>
                                         <th>Image</th>
                                         <th>Created Date</th>
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
                                    //echo "SELECT a.*,b.title category FROM tbl_content a LEFT JOIN tbl_category b ON a.category_id = b.id  order by a.id desc";die;
                       $content_list = $taps9->self_query("select * from tbl_content where status!=3 order by id desc");
                       
                        if(count($content_list)==0)
                        {
                            echo '<tr><td><td><td><span style="color:red">No Record Found</span></td></td></td></tr>';
                        }
                        else
                        {
                            for($i=0;$i<count($content_list);$i++)
                            {
                                

                       ?>
                        <tr>
                            
                            <td><?=$i+1?></td>
                           
                                        <td> <?=$content_list[$i]['page']?></td>  
                                        <td><img src="../images/content/<?=$content_list[$i]['image']?>" style="height:70px;width:70px;"/></td>
                                        <td><img src="../images/main_img/<?=$content_list[$i]['logo1']?>" style="height:70px;width:70px;"/></td>
                                        <td><?=date('d-m-Y',strtotime($content_list[$i]['created_at']));?></td>
                                        <td><?php if($content_list[$i]['status']==1) {?> <button type="button" class="btn btn-success" style="background-color: green;">Active</button><?php } else {?><button type="button" class="btn btn-danger" style="background-color: red;">Deactive</button><?php } ?></td>
                                        
                                        <td>
                                              <div class="text-center">
                                  
                                    <a  href="add_content.php?edit=<?=$content_list[$i]['id']?>">Edit <i class="fa fa-eye"></i></a>
                                    
                                </div>

                                            </td>
                                         

                                <td>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkbox2" name="opt[]" value="<?=$content_list[$i]['id']?>">
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

     
    </div>
    <!--end wrapper-->
    
    
    <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
          } );
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable( {
                lengthChange: false,
                // buttons: [ 'copy', 'excel', 'pdf', 'print']
            } );
         
            table.buttons().container()
                .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
        } );
    </script>
    </body>

 
</html>
