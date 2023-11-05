<?php
require_once('db_config.php');
 date_default_timezone_set("Asia/Calcutta");

$db_config = new db_config();

 class taps9 extends db_config
{
    public $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
    public $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');



      public function admin_login($info)
      {
      	$username = mysqli_real_escape_string($this->con,trim($info['username']));
      	$password = md5(trim($info['password']));
      	
        //echo "select id from tbl_admin_login where username = '".$username."' && password = '".$password."' && status='Active'"; die;
      	$sql=$this->con->query("select id from tbl_admin_login where username = '".$username."' && password = '".$password."' && status='Active'");
      	if($sql->num_rows==0)
      	{
      		$_SESSION['status']='Login failed';
      	    header('location:index.php?login-failed='.str_replace(' ', '-', $_SESSION['status']));
      	}
      	else
      	{
          $id = 1;
          $this->portal_log($id,"Admin Login");
      		$_SESSION['admin_login']=1;
      		header('location:dashboard.php');
      	}
      	
      }
      public function admin_password()
      {
      	
      	
      	$sql=$this->con->query("select * from tbl_admin_login where id=1 and status='Active'");
      	$fetch_password = $sql->fetch_array();
      	$password = $fetch_password['pass'];
         
         return $password; 
      	
      }

      public function change_password($info)
      {
        $oldpass     = $info['oldpassword'];
        $newpassword = $info['newpassword'];
        $cpassword   = $info['retypepassword'];
        if($newpassword!=$cpassword)
        {
          echo "<script>window.location.href='change_password.php';
          alert('New Password And Confirm Password did not match')</script>";
        }
        if($oldpass)
        {

          $check_pass = $this->con->query("select id from tbl_admin_login where password = '".md5($oldpass)."' && status='Active'");
          if($check_pass->num_rows>0)
          {
            $sql = $this->con->query("update tbl_admin_login set password='".md5($newpassword)."',pass='".$newpassword."' where id=1");
            if($sql>0)
            {
              $id = 1;
              $this->portal_log($id,"Admin Password Update");
              echo "<script>window.location.href='logout.php';
              alert('Password Update Successfully')</script>";
              //header('location:logout.php');   
            }
          }
          else
          {
            echo "<script>window.location.href='change_password.php';
          alert('Please Enter Correct Old Password')</script>";
          }
        }
      	else
        {
          echo "<script>window.location.href='change_password.php';
          alert('Please Enter Old Password')</script>";
        }
      	
      }

      public function logout()
      {

      	session_destroy();
        $id = 1;
        $this->portal_log($id,"Admin Logout");
      	$_SESSION['status']='Logout Successfully';
      	header('location:index.php?logout='.str_replace(' ', '-',$_SESSION['status']));
      }
 
      public function view_list($tbl,$where,$limit)
      {
        $fetch_list = array();  
      	$sql = $this->con->query("select * from $tbl where $where $limit");
      	while($list = $sql->fetch_assoc())
      	{
      		$fetch_list[] = $list;
      	}
      	return @$fetch_list;

      }

      public function active($tbl,$where,$total_row,$page)
      {

      	$sql = $this->con->query("UPDATE $tbl set status='1' $where");
      	if($sql>0)
      	{
      		$_SESSION['msg']=$total_row.' Rows Actived Successfully';
      		header('location:'.$page);

      	}
      }
        
          public function deactive($tbl,$where,$total_row,$page)
      {
        
      	$sql = $this->con->query("UPDATE $tbl set status='0' $where");
      	if($sql>0)
      	{
      		$_SESSION['msg']=$total_row.' Rows Deactived Successfully';
      		header('location:'.$page);

      	}
      }
          public function delete($tbl,$where,$total_row,$page)
      {
      	$sql = $this->con->query("DELETE FROM $tbl $where");
      	if($sql>0)
      	{
      		$_SESSION['msg']=$total_row.' Rows Deleted Successfully';
      		header('location:'.$page);

      	}
      }
public function delete_image($image_name,$sql,$page)
      {
        $sql = $this->con->query($sql);
        if($sql>0)
        {
           $path="../images/main_img/".$image_name;
           unlink($path);

          $_SESSION['msg']=$total_row.' Images Removed Successfully';
          header('location:'.$page);

        }
      }

      public function check_row_status($tbl,$where)
      {

      	$sql = $this->con->query("select * from $tbl $where");
      	$get_row = $sql->num_rows;
      	return $get_row; 
      }

     
      public function fetch_rows($tbl,$where)
      {
      	$sql = $this->con->query("select * from $tbl $where");
      	$fetch_all_row = $sql->fetch_assoc();
      	return $fetch_all_row;
      	
      }
      public function base_url()
      {
        return $this->baseurl;
   
      }
      public function self_query($query)
      {   
          $row = array();
          $sql = $this->con->query($query);
         
          while($data = $sql->fetch_assoc())
          {
              $row[] = $data;
          }
         return @$row;
       
      }


        public function register_user($info)
      {
          $baseurl=$this->baseurl;
          $name=mysqli_real_escape_string($this->con,$info['name']);
          $email=mysqli_real_escape_string($this->con,$info['email']);
          $mobile=mysqli_real_escape_string($this->con,$info['mobile']);
          $address=mysqli_real_escape_string($this->con,$info['address']);
          $state=mysqli_real_escape_string($this->con,$info['state']);
          $city=mysqli_real_escape_string($this->con,$info['city']);
          $show_pass=mysqli_real_escape_string($this->con,$info['password']);
          $pincode=mysqli_real_escape_string($this->con,$info['pincode']);
          $password=mysqli_real_escape_string($this->con,$info['password']);
        

          //echo "select * from tbl_reg_user where mobile='".$mobile."' && email='".$email."'";
           $exist_user = $this->con->query("select * from tbl_reg_user where mobile='".$mobile."' or email='".$email."'");
      // echo $exist_user->num_rows; die;
        if($exist_user->num_rows>0)
        {
          unset($_SESSION['msg']);
          $_SESSION['error']='This Mobile Number Or Email  is already Register';
            echo "<script>window.location.href='$baseurl/register.php';
            alert('This  mobile number or email  is  already exist please try another ');</script>";
       
        }
        else
        {
     
    // echo "INSERT INTO tbl_reg_user(`name`,`email`,`mobile`,`address`,`state`,`city`,`show_pass`,`pincode`,`password`,`add_date`) values ('".$name."','".$email."','".$mobile."','".$address."','".$state."','".$city."','".$show_pass."','".$pincode."','".md5($password)."', now())";die;
      $sql = $this->con->query("INSERT INTO tbl_reg_user(`name`,`email`,`mobile`,`address`,`state`,`city`,`show_pass`,`pincode`,`password`,`add_date`) values ('".$name."','".$email."','".$mobile."','".$address."','".$state."','".$city."','".$show_pass."','".$pincode."','".md5($password)."', now())");
        if($sql)
        {

        $id = mysqli_insert_id($this->con);
         

  $newuser=$this->con->query("SELECT * from tbl_reg_user where id='$id'");
  $send=mysqli_fetch_object($newuser);
  $code=base64_encode($send->email);
  
  $to=$email;
  
  $subject="Activation";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  $headers .="From:chonas@gmail.com";
  $message="<table><tr><a href=$baseurl/emailverify?code=$code> Please click here for activate your account</a></tr></br></table>";
  //echo  $message; die;
  if(@mail($to,$subject,$message,$headers))
  {//echo 111; die;
  return 'H';
  }
  else
  {
   // echo 222; die;
      return 'ZZ';  
  }
        $this->portal_log($id,"$title - Registration Successfull");
          

        }
        else
        {
          //echo 333; die;
        echo "<script>window.location.href='$baseurl/register.php';
          alert('Registration not success, plz try again')</script>"; 
      
        }
      }
      
      }
      
      
    


       public function user_email_verify($get_email)
      {
            $baseurl=$this->baseurl;
            
         $email=base64_decode($get_email);  
//echo "select * from tbl_reg_user where email='".$email."'";
  $fetch_status =$this->con->query("select * from tbl_reg_user where email='".$email."'");
   $user_status = $fetch_status->fetch_assoc();
//  echo $user_status['status']; die;
  if($user_status['status']=='1')
  {
 
      echo "<script>window.location.href='register';
alert('This account is already activated')</script>";
  }
  else
  {
      //echo "UPDATE tbl_reg_user set status='1' where email='$email'"; die;
  
  $sql=$this->con->query("UPDATE tbl_reg_user set status='1' where email='$email'");

    $to=$email;
    $subject="Confirm Email Activation";
    $message="Your Email Id has been successfully Verified with The LCL.";
    $message.="\\n Thank You...";
    $mailheader="From:chonas@gmail.com";
    $mailheader.=$sender_email;
    @mail($to,$subject,$message,$mailheader);
    
    echo "<script>alert('Your Account Has Been Activated.');
    window.location.href='$baseurl/register';</script>";
  }
      }
    
    public function valid_email($info)
    {
         
         $sql = $this->con->query("select id from tbl_reg_user where email='".$info."' && status=1");
            $user_detail = $sql->fetch_assoc();
            return $user_detail['id'];
    }



       public function update_cart($email,$session_id)
     {
 
       $qty = $info['qty'];
        $cart_id = $info['cart_id'];
         
      //  echo "update tbl_cart set user_id='".$email."' where id='".$session_id."'" ;

          $sql = $this->con->query("update tbl_cart set user_id='".$email."' where session_id='".$session_id."'");
          
         
     
     }


      public function check_cart($user_id,$session_id)

{
  $baseurl=$this->baseurl;
  // echo "DELETE FROM tbl_cart where user_id='".$user_id."' && session_id!='".$session_id."'"; die;
   $check_cart=$this->con->query("DELETE FROM tbl_cart where user_id='".$user_id."' && session_id!='".$session_id."'");
      
      // if($check_cart)
      //   {
  
      //    header('location:'.$baseurl.'/cart.php');
      //  }
}


      public function user_login($info,$page_name)
      {
       // echo 
           $baseurl = $this->baseurl;
          $email = $info['email'];
          $email_validation = $this->valid_email($email);
          if($email_validation!=0)
          {
           // echo 312312312; die;
            //echo "select id from tbl_reg_user where email='".$email."' && password='".md5($info['password'])."' and status=1"; die;
            $sql = $this->con->query("select id from tbl_reg_user where email='".$email."' && password='".md5($info['password'])."' and status=1");
            $user_detail = $sql->fetch_assoc();

            if($user_detail['id']<1)
            {
            //echo 132213213; die;
              unset($_SESSION['account_status']);
              $_SESSION['account_status']="Failed : Username and password did not match";
              echo "<script>alert('Please enter valid login information.');
    window.location.href='$baseurl/login';</script>";
            }
            else
            {
             
            $id = $user_detail['id'];
            //echo $email; die;
             
            $this->portal_log($id,"$email -User Login");
            $_SESSION['user_email']=$email;
            
            $this->update_cart($email,session_id());

            $this->check_cart($email,session_id());

//echo $page_name.'12321'; die;
        
            if($page_name=='checkout')
            {
               header('location:'.$baseurl.'/checkout');
            }

          else
          {
             header('location:'.$baseurl);
          }
           
            }
          }
           else
           {

            unset($_SESSION['failed']);
            $_SESSION['failed'] = "Failed : Enter Invalid Email Id";
            echo "<script>alert('Please enter valid login information.');window.location.href='$baseurl/register';</script>";
            
            }
            
      }
      
      



      public function forgot_password($info)
      {
          $baseurl = $this->baseurl;
          $email = $info['email'];
          $email_validation = $this->valid_email($email);
          if($email_validation!='')
          {
            // echo 312312312; die;
//           $newuser=$this->con->query("SELECT * from tbl_reg_user where email='$email'");
//  $send=mysqli_fetch_object($newuser);
  $code=base64_encode($email);
  
  $to=$email;
  
  $subject="Forgot password";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  $headers .="From:chonas@gmail.com";
  $message="<table><tr><a href=$baseurl/forgot-password?code=$code> Please click here for update your password</a></tr></br></table>";
  if(@mail($to,$subject,$message,$headers))
  {
  echo "<script>alert('Please check your email for retrieve password.');
    window.location.href='$baseurl/register';</script>";
  }
  else
  {
      return ZZ;  
  }
          }
           else
           {

            unset($_SESSION['failed']);
            $_SESSION['failed'] = "Failed : Enter Invalid Email Id";
            echo "<script>alert('Please enter valid login information.');
    window.location.href='$baseurl/forgot-password';</script>";
            }
            
      }
      
      public function update_user_password($info,$id)
      {
          $baseurl=$this->baseurl;
          $password=$info['password'];
          
     //   echo "update tbl_reg_user set `password`='".md5($password)."' where `email`='".$id."'"; die;
          $sql = $this->con->query("update tbl_reg_user set `password`='".md5($password)."' where `email`='".$id."'");
          if($sql==true)
          {
                echo "<script>alert('Your password has been updated successfully.Please login.');window.location.href='$baseurl/login';</script>";
          }
          else{
                echo "<script>alert('!! Your password not update error !!.');
    window.location.href='$baseurl/register';</script>";
          }
          
      }

      public function user_logout()
      {
          $baseurl =$this->baseurl;
        session_destroy();
        
        $_SESSION['status']='Logout successfully';
        header('location:'.$baseurl);
      }
      

        public function user_update_profile($info,$id)
      {
          $baseurl=$this->baseurl;
          $name=mysqli_real_escape_string($this->con,$info['name']);
          $address=mysqli_real_escape_string($this->con,$info['address']);
          $state=mysqli_real_escape_string($this->con,$info['state']);
          $city=mysqli_real_escape_string($this->con,$info['city']);
          $show_pass=mysqli_real_escape_string($this->con,$info['show_pass']);
          $pincode=mysqli_real_escape_string($this->con,$info['pincode']);
          
          //echo  "update tbl_reg_user set `name`='".$name."',  `address`='".$address."', `state`='".$state."', `city`='".$city."', `ice_number`='".$ice_number."', `pincode`='".$pincode."'";die;
          
            $query = "update tbl_reg_user set `name`='".$name."',  `address`='".$address."', `state`='".$state."', `city`='".$city."', `show_pass`='".$show_pass."', `pincode`='".$pincode."', `password`='".md5($show_pass)."'";
           
           
          $query.=",`update_date`=now() where `email`='".$id."'";
          
          $sql = $this->con->query($query);
          if($sql>0)
          {
                
        
             $this->portal_log($id,"$title - Registration Successfull");
            $this->portal_log($id,"$title - Updated");
            $_SESSION['msg']='Data Updated Successfully';
            // header('location:edit-profile.php');
        
           echo "<script>alert('Your profile has been update successfully.');
            window.location.href='edit-profile.php';</script>";
        
        
          }
          else
          {
            $_SESSIONP['error_data']='Data Not Updated';
          }   
 
      }
     
      

      public function portal_log($insert_id,$description)
      {
       // echo 12321; die;
        $description = mysqli_real_escape_string($this->con,$description);

        $sql = $this->con->query("INSERT INTO tbl_log (activity_id,description,add_date) values('".$insert_id."','".$description."',now())");
      }
       public function add_banner($info)
      {
        $page_id = mysqli_real_escape_string($this->con,trim($info['page_id']));
         $image = "";

        if(@$_FILES['image']['name'] != '') 
            {
             
            @$image = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image"]["name"]));
            
            $path="../images/main_img/".$image;
            move_uploaded_file($_FILES['image']['tmp_name'], $path);
            }
        $sql = $this->con->query("INSERT INTO tbl_banner(`page_id`,`images`,`created_at`) values ('".$page_id."','".$image."',now())");
        if($sql)
        {
        $id = mysqli_insert_id($this->con);
        $this->portal_log($id,"$title - Added");
        unset($_SESSION['error']);
        $_SESSION['msg']='Data Inserted Successfully';
        header('location:add-banner.php');
        }
        else
        {
        unset($_SESSION['msg']);  
        $_SESSION['error']='Something Went Wrong';
        header('location:add-banner.php');
        }
      }
      

       public function update_banner($info,$id)
      {
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');
        $page_id = mysqli_real_escape_string($this->con,trim($info['page_id']));
           $image = "";
        if(@$_FILES['image']['name'] != '') 
            {
              
            @$image = rand() .'_'.str_replace($find,$replace,strtolower($_FILES["image"]["name"]));

            $path="../images/main_img/".$image;

            move_uploaded_file($_FILES['image']['tmp_name'], $path);
            }
            
          


            
          $query = "update tbl_banner set `page_id`='".$page_id."' ";
          
          
          if($image!='')
          {
            $query.=",`images`='".$image."' ";
          }
          

          $query.=",`update_at`=now() where `id`='".(int)$id."'";
         
          
          $sql = $this->con->query($query);
          if($sql>0)
          {
            $this->portal_log($id,"$title - Banner Updated");
            $_SESSION['msg']='Data Updated Successfully';
            header('location:manage-banner.php');
          }
          else
          {
            $_SESSIONP['error']='Data Not Updated';
          }
       }



       public function add_lawyer($info)
      {
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');
        $state_id = $info['state_id'];
        $name = mysqli_real_escape_string($this->con,trim($info['name']));
        $state_name = $this->getState($state_id);
        $url = str_replace($find,$replace,strtolower($name)).'-from-'.str_replace($find,$replace,strtolower($state_name));
        $email = mysqli_real_escape_string($this->con,trim($info['email']));
        $address = mysqli_real_escape_string($this->con,trim($info['address']));
        $experience = mysqli_real_escape_string($this->con,trim($info['experience']));
        $rating_point = mysqli_real_escape_string($this->con,trim($info['rating_point']));
        $rating_count = mysqli_real_escape_string($this->con,trim($info['rating_count']));
        $phone = mysqli_real_escape_string($this->con,trim($info['phone']));
        $languages = mysqli_real_escape_string($this->con,trim($info['languages']));
        $lawyer_status = mysqli_real_escape_string($this->con,trim($info['lawyer_status']));
        $courts = mysqli_real_escape_string($this->con,trim($info['courts']));
        $practice_area = mysqli_real_escape_string($this->con,trim($info['practice_area']));
        $description = mysqli_real_escape_string($this->con,trim($info['description']));
        $image = "";
        if(@$_FILES['image']['name'] != '') 
        {
        @$image = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image"]["name"]));
        $path="../images/main_img/".$image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        }
      $sql = $this->con->query("INSERT INTO tbl_lawyer(`state_id`,`name`,`email`,`address`,`url`,`experience`,`rating_point`,`rating_count`,`phone`,`languages`,`lawyer_status`,`courts`,`description`,`practice_area`,`image`,`created_at`) values 
     ('".$state_id."','".$name."','".$email."','".$address."','".$url."','".$experience."','".$rating_point."','".$rating_count."','".$phone."','".$languages ."','".$lawyer_status ."','".$courts ."','".$description ."','".$practice_area ."','".$image."',now())");
        if($sql)
        {
        $this->portal_log($id,"$title - Added");
        unset($_SESSION['error']);
        $_SESSION['msg']='Data Inserted Successfully';
        header('location:add-lawyer.php');

        }
        else
        {
        unset($_SESSION['msg']);  
        $_SESSION['error']='Something Went Wrong';
        header('location:add-product.php');
        }

         
      }

       public function update_lawyer($info,$id)
      {
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');
        $state_id = $info['state_id'];
        $name = mysqli_real_escape_string($this->con,trim($info['name']));
        $state_name = $this->getState($state_id);
        $url = str_replace($find,$replace,strtolower($name)).'-from-'.str_replace($find,$replace,strtolower($state_name));
        $email = mysqli_real_escape_string($this->con,trim($info['email']));
        $address = mysqli_real_escape_string($this->con,trim($info['address']));
        $experience = mysqli_real_escape_string($this->con,trim($info['experience']));
        $rating_point = mysqli_real_escape_string($this->con,trim($info['rating_point']));
        $rating_count = mysqli_real_escape_string($this->con,trim($info['rating_count']));
        $phone = mysqli_real_escape_string($this->con,trim($info['phone']));
        $languages = mysqli_real_escape_string($this->con,trim($info['languages']));
        $lawyer_status = mysqli_real_escape_string($this->con,trim($info['lawyer_status']));
        $courts = mysqli_real_escape_string($this->con,trim($info['courts']));
        $practice_area = mysqli_real_escape_string($this->con,trim($info['practice_area']));
        $description = mysqli_real_escape_string($this->con,trim($info['description']));
        $image = "";
        if(@$_FILES['image']['name'] != '') 
        {
        @$image = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image"]["name"]));
        $path="../images/main_img/".$image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        }
          $query = "update tbl_lawyer set `state_id`='".$state_id."',`name`='".$name."',`email`='".$email."',`address`='".$address."',
          `experience`='".$experience."',`rating_point`='".$rating_point."',`rating_count`='".$rating_count."',`phone`='".$phone."',
          `languages`='".$languages."',`lawyer_status`='".$lawyer_status."',
          `courts`='".$courts."',`description`='".$description."',`practice_area` = '".$practice_area."' ";
          if($image!='')
          {
            $query.=",`image`='".$image."' ";
          }
          $query.=",`update_at`=now() where `id`='".$id."'";
          $sql = $this->con->query($query);
          if($sql)
          {
            $this->portal_log($id,"$title - Updated");
            $_SESSION['msg']='Data Updated Successfully';
            header('location:manage-lawyer.php');
          }
          else
          {
            $_SESSIONP['error']='Data Not Updated';
          }
      }

 

     public function delete_product_image($sql,$product_id)
      {
        $sql = $this->con->query($sql);
        if($sql>0)
        {
           

          $_SESSION['msg']=$total_row.' Images Removed Successfully';
           unset($_SESSION['error']);
         $_SESSION['msg']='Image Delete Success';
      header('location:add-product.php?edit='.$product_id);

        }
        
         else {
      unset($_SESSION['msg']);
          $_SESSION['error']='This Image Not Delete';
        header('location:add-product.php?edit=$product_id');
  }
  
      }




       public function add_sub_category($info)
      {
       
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');
        $category_id = mysqli_real_escape_string($this->con,$info['category_id']);
        
          $sub_category = mysqli_real_escape_string($this->con,$info['sub_category']);

          $url = mysqli_real_escape_string($this->con,str_replace($find,$replace,strtolower($sub_category)));

        
          
        $exist_category = $this->con->query("select * from sub_category where sub_category='".$sub_category."'");
        if($exist_category->num_rows>0)
        {
          unset($_SESSION['msg']);
          $_SESSION['error']='This Sub Category is already exist';
            echo "<script>alert('This Sub Category is already exist');</script>
            window.location.href='manage-sub-category.php';";
       
        }
        else
        {
         $image = "";

        if(@$_FILES['image']['name'] != '') 
            {
             
            @$image = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image"]["name"]));
            
            $path="../images/main_img/".$image;
            move_uploaded_file($_FILES['image']['tmp_name'], $path);
            }

            

       // echo "INSERT INTO sub_category(`category_id`,`url`,`sub_category`,`add_date`) values ('".$category_id."','".$url."','".$sub_category."',now())"; die;
        $sql = $this->con->query("INSERT INTO sub_category(`category_id`,`url`,`sub_category`,`image`,`add_date`) values ('".$category_id."','".$url."','".$sub_category."','".$image."',now())");
        if($sql)
        {

        $id = mysqli_insert_id($this->con);
        $this->portal_log($id,"$sub_category - Added");
        unset($_SESSION['error']);
        $_SESSION['msg']='Data Inserted Successfully';
        header('location:manage-sub-category.php');

        }
        else
        {
        unset($_SESSION['msg']);  
        $_SESSION['error']='Something Went Wrong';
        header('location:manage-sub-category.php');
        }

        }
      }

       public function update_sub_category($info,$id)
      {
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');

        $category_id = mysqli_real_escape_string($this->con,$info['category_id']);
       
         
         $sub_category = mysqli_real_escape_string($this->con,$info['sub_category']);

          $url = mysqli_real_escape_string($this->con,str_replace($find,$replace,strtolower($sub_category)));
        

 $exist_category = $this->con->query("select * from sub_category where sub_category='".$sub_category."' and id!=$id");
        if($exist_category->num_rows>0)
        {
          echo "<script>alert('This Sub Category Already Exist')</script>";
        }
        else

        {
         
           $image = "";


        if(@$_FILES['image']['name'] != '') 
            {
              
            @$image = rand() .'_'.str_replace($find,$replace,strtolower($_FILES["image"]["name"]));

            $path="../images/main_img/".$image;

            move_uploaded_file($_FILES['image']['tmp_name'], $path);
            }
            
          

            
          $query = "update sub_category set `category_id`='".$category_id."',`sub_category`='".$sub_category."',`url`='".$url."' ";
          
          
          if($image!='')
          {
            $query.=",`image`='".$image."' ";
          }
          

          $query.=",`update_date`=now() where `id`='".(int)$id."'";
         
          
          $sql = $this->con->query($query);
          if($sql>0)
          {
            $this->portal_log($id,"$sub_category - Sub Category Updated");
             unset($_SESSION['error']); 
              $_SESSION['msg']='Data Updated Successfully';

            header('location:manage-sub-category.php');
          }
          else
          {
            $_SESSION['error']='Data Not Updated';
          }
       }
      }



     public function add_coupon($info)
      {
       
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');
        $coupon_name = mysqli_real_escape_string($this->con,$info['coupon_name']);
         $offer = mysqli_real_escape_string($this->con,$info['offer']);
        $duration_days = mysqli_real_escape_string($this->con,$info['duration_days']);
        

 
         // echo "select * from tbl_add_city where title='".$title."'"; die;
        $exist_city = $this->con->query("select * from tbl_coupon where coupon_name='".$coupon_name."' and status=1");
        if($exist_city->num_rows>0)
        {
          unset($_SESSION['msg']);
          $_SESSION['error']='This coupon name is already exist';
            echo "<script>alert('This coupon name is already exist');</script>";
       
        }
        else
        {
           if($_FILES['image']['name'] != '') 
        {
        $file = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image"]["name"]));
        $path="../images/main_img/".$file;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        }  
        $sql = $this->con->query("INSERT INTO tbl_coupon(`coupon_name`,`offer`,`duration_days`,`image`,`add_date`) values ('".$coupon_name."','".$offer."','".$duration_days."','".$file."',now())");
        if($sql)
        {

        $id = mysqli_insert_id($this->con);
        $this->portal_log($id,"$title -coupon name Added");
        unset($_SESSION['error']);
        $_SESSION['msg']='Data Inserted Successfully';
        header('location:add-Coupon-code.php');

        }
        else
        {
        unset($_SESSION['msg']);  
        $_SESSION['error']='Something Went Wrong';
        header('location:add-coupon-code.php');
        }

        }
      }
      
      
         public function update_coupon($info,$id)
      {
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');

         $coupon_name = mysqli_real_escape_string($this->con,$info['coupon_name']);
         $offer = mysqli_real_escape_string($this->con,$info['offer']);
        $duration_days = mysqli_real_escape_string($this->con,$info['duration_days']);
        
         

 $exist_city = $this->con->query("select * from tbl_coupon where coupon_name='".$coupon_name."' and id!=$id");
        if($exist_city->num_rows>0)
        {
          echo "<script>alert('This coupon name Already Exist')</script>";
        }
        else

        {
           $file = "";

        if($_FILES['image']['size'] >0)
        {
        $img=$_POST['hidfile'];
        $path="../images/main_img/".$img;
        unlink($path);
        $file = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image"]["name"]));
        $path="../images/main_img/".$file;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
          }
         
          $query = "update tbl_coupon set `coupon_name`='".$coupon_name."',`offer`='".$offer."',`duration_days`='".$duration_days."' ";
          
          if($file!='')
          {
            $query.=",`image`='".$file."' ";
          }
          
          $query.=",`update_date`=now() where `id`='".(int)$id."'";
         
         //echo $query; die;
 
          $sql = $this->con->query($query);
          if($sql>0)
          {
            $this->portal_log($id,"$city_name - city Updated");
            $_SESSION['msg']='Data Updated Successfully';
            header('location:add-coupon-code.php');
          }
          else
          {
            $_SESSIONP['error']='Data Not Updated';
          }
       }
     }

   
       public function add_cart($info)
      {
        $baseurl=$this->baseurl;

        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');
 
 
       // echo '<br> error_redirect ='. 
       $error_redirect = mysqli_real_escape_string($this->con,$info['error_redirect']);     
       // echo '<br> qty ='. 
       $qty = mysqli_real_escape_string($this->con,$info['qty']);
       // echo '<br> total_qty ='. 
       $total_qty = mysqli_real_escape_string($this->con,$info['total_qty']);
       // echo '<br> product_id ='.
        $product_id = mysqli_real_escape_string($this->con,$info['product_id']);
       // echo '<br> session_id ='.
        $session_id = mysqli_real_escape_string($this->con,$info['session_id']);
       // echo '<br> user_id ='.
       $user_id = mysqli_real_escape_string($this->con,$info['user_id']);
       // echo '<br> stock_id ='. 
       $stock_id = mysqli_real_escape_string($this->con,$info['stock_id']);
       // echo '<br> product_color ='. 
       $product_color = mysqli_real_escape_string($this->con,$info['product_color']);
       // echo '<br> product_size ='.
         $product_size = mysqli_real_escape_string($this->con,$info['product_size']);
        

// die;
         if($total_qty<$qty)
         {
          echo '<script type="text/javascript">'; 
echo 'alert("Please select correct quantity");'; 
echo 'window.location.href = "'.$baseurl.'/product-detail/'.$error_redirect.'";';
echo '</script>';
         }




if($user_id!='')
{

  // echo 'user_login'; die;
  
 // echo "select * from tbl_cart where product_id='".$product_id."' and user_id='".$user_id."'"; die;
  $update_user_cart = $this->con->query("update tbl_cart set user_id='".$user_id."' where session_id='".$session_id."'");

  $update_cart = $this->self_query("select * from tbl_cart where product_id='".$product_id."' and user_id='".$user_id."'  and stock_id='".$stock_id."'   ");
}

else 
{
   // echo 12321; die;
 //echo 'user_logout'; die;
 // echo "select * from tbl_cart where product_id='".$product_id."' and session_id='".$session_id."' and stock_id='".$stock_id."' "; die;
   $update_cart = $this->self_query("select * from tbl_cart where product_id='".$product_id."' and session_id='".$session_id."' and stock_id='".$stock_id."' ");
 //  echo "select * from tbl_cart where product_id='".$product_id."' and session_id='".$session_id."' and stock_id='".$stock_id."'"; die;
}

      if(count($update_cart)>0)
      {
       // echo 12321; die;
         
      // echo 1111; die;
         $query = $this->con->query("update tbl_cart set `qty`='".$qty."' where product_id='".$product_id."' and session_id='".$session_id."' ");
 //echo $query; die;
if($query)
{
  //echo 1221; die;
         header('location:'.$baseurl.'/cart.php');
       }

      }
  
  else 
  {
   //echo "INSERT INTO tbl_cart(`qty`,`product_id`,`session_id`,`user_id`,`stock_id`,`product_color`,`product_size`,`add_date`) values('".$qty."','".$product_id."','".$session_id."','".$user_id."','".$stock_id."','".$product_color."','".$product_size."',now())"; die;
     $query = $this->con->query("INSERT INTO tbl_cart(`qty`,`product_id`,`session_id`,`user_id`,`stock_id`,`product_color`,`product_size`,`add_date`) values('".$qty."','".$product_id."','".$session_id."','".$user_id."','".$stock_id."','".$product_color."','".$product_size."',now())");
     if($query){ header('location:'.$baseurl.'/cart.php'); }
   // echo 2222; die;


  }
       

     }

    

     public function delete_cart_product()
     {
      $baseurl=$this->baseurl;
        $id=$_GET['cart_id'];
      
      //echo "DELETE FROM tbl_cart where id='".$id."'"; die;

       $sql = $this->con->query("DELETE FROM tbl_cart where id='".$id."'");
        header('location:'.$baseurl.'/cart.php');
     }
 


 
 
 public function delivery_details($info,$user_id)
      {
       
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');
        $name = mysqli_real_escape_string($this->con,$info['name']);
        
        $email = mysqli_real_escape_string($this->con,$info['email']);

       $mobile = mysqli_real_escape_string($this->con,$info['mobile']);
         
        $address = mysqli_real_escape_string($this->con,$info['address']);

         $city = mysqli_real_escape_string($this->con,$info['city']);

          $pin = mysqli_real_escape_string($this->con,$info['pin']);
          $session_id = mysqli_real_escape_string($this->con,$info['session_id']);
          
      // echo "INSERT INTO delivery_details(`session_id`,`user_id`,`name`,`email`,`mobile`,`address`,`city`,`pin`,`add_date`) values ('".$session_id."','".$user_id."','".$name."','".$email."','".$mobile."','".$address."','".$city."','".$pin."',now())"; die;
       
        $sql = $this->con->query("INSERT INTO delivery_details(`session_id`,`user_id`,`name`,`email`,`mobile`,`address`,`city`,`pin`,`add_date`) values ('".$session_id."','".$user_id."','".$name."','".$email."','".$mobile."','".$address."','".$city."','".$pin."',now())");
        if($sql)
        {

        $id = mysqli_insert_id($this->con);
        $this->portal_log($id,"$email - Added");
        unset($_SESSION['error']);
        $_SESSION['show_order']=$id;
        if($user_id==''){$_SESSION['guest_order']='Guest';}
        $_SESSION['msg']='Data Inserted Successfully';
        header('location:checkout.php');

        }
        else
        {
        unset($_SESSION['msg']);  
        $_SESSION['error']='Something Went Wrong';
        header('location:checkout.php');
        }

        
      }


    
     public function confirm_order($info)
    {
         $baseurl=$this->baseurl;

       $user_id = mysqli_real_escape_string($this->con,$info['user_id']);
    
       $session_id = mysqli_real_escape_string($this->con,$info['session_id']);
          
      if($user_id!=''){
      
      $order=$this->self_query("select * from tbl_cart where  user_id='".$user_id."'");
            
            }

        else {

      $order=$this->self_query("select * from tbl_cart where  session_id='".$session_id."'");
        
            }

      for ($i=0; $i <count($order) ; $i++) {
        // echo "select * from delivery_details where session_id='".$session_id."' or user_id='".$user_id."'"; die;
        if($user_id!=''){
         $delivery_details=$this->self_query("select * from delivery_details where  user_id='".$user_id."' order by id desc ")[0];
 }
 else{
  $delivery_details=$this->self_query("select * from delivery_details where  session_id='".$session_id."' order by id desc ")[0];
 }
           $order_confirm=$this->self_query("select * from tbl_product where  id='".$order[$i]['product_id']."' order by id")[0];

          $stock_details=$this->self_query("select * from tbl_size_color_stock where  id='".$order[$i]['stock_id']."' order by id")[0];
         
 
 // echo "INSERT INTO tbl_order_details(`session_id`,`user_id`,`name`,`email`,`mobile`,`address`,`city`,`pin`,`ord_id`,`product_id`,`product_name`,`discount`,`price`,`qty`,`total_price`,`color`,`size`,`stock_id`,`add_date`,`image`,`tracking_id`,`taxn_id`) values ('".$session_id."','".$user_id."','".$delivery_details['name']."','".$delivery_details['email']."','".$delivery_details['mobile']."','".$delivery_details['address']."','".$delivery_details['city']."','".$delivery_details['pin']."','".'chonas'.$order[$i]['id']."','".$order[$i]['product_id']."','".$order_confirm['title']."','".$stock_details['discount_price']."','".$stock_details['price']."','".$order[$i]['qty']."','".$total_price."','".$stock_details['color']."','".$stock_details['size']."','".$stock_details['id']."',now(),'".$stock_details['image1']."','".'chonas'.time().rand(1000,100099)."','')"; die;
if($_SESSION['coupon_offer']==''){
//echo 'coupon null';
   unset($_SESSION['coupon_offer']);
   unset($_SESSION['coupon_name']);
}
$coupon_offer=$_SESSION['coupon_offer'];

$coupon_name=$_SESSION['coupon_name'];


$total_price=$stock_details['discount_price']*$order[$i]['qty'];

if($total_price>=$coupon_offer){
 // $total_price= $total_price-$coupon_offer;
   //  echo '<br>total_price = '.$total_price;
   //  echo '<br> coupon price ='.$coupon_offer;
   // echo '<br> 111';
  $use_coupon_price=$_SESSION['coupon_offer'];
  $_SESSION['coupon_offer']='';
  //unset($_SESSION['coupon_offer']);
  //echo  $_SESSION['coupon_offer'];
 // die;
}
else{
      $use_coupon=$_SESSION['coupon_offer']; 
    $_SESSION['coupon_offer']= $coupon_offer-$total_price;
   // $use_coupon_price=$_SESSION['coupon_offer'];
   // echo '<br>';

      $use_coupon_price=$use_coupon-$_SESSION['coupon_offer'];
  //  echo 222;
  // die;
}


  $message="<html><head>
            <style>

  .bill-heading{font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; font-weight:bold; padding-left:4px;}
  .bill-info{font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-left:4px;}

</style>
            </head>

<body>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
 <tr>
      
        <td  height=\"20\" align=\"left\" style=\" padding-left:4px;width:200px;\"><img  style=\" padding-left:4px;width:100px;\" src='$baseurl/images/logo.jpg' /></td>
      </tr>
  <tr>
    <td style=\"width: 50%;\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
   
       <tr>
        <td height=\"30\" align=\" \" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-left:4px;font-weight:bold;\">  Delivery  Details as per below . . . </td>
      </tr>
   
     
      
    <tr>
    <td height=\"30\" align=\"left \" style=\"width:50%;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333;  float:left; text-align:left; font-weight:bold; padding-left:4px;\">Name :</td>
    <td height=\"30\"align=\"left\" style=\"width:50%;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; float:left;  text-align:left;padding-left:4px;\">&nbsp;".$delivery_details['name']."</td>
  </tr>  
  <tr>
    <td height=\"30\" align=\" \" style=\"width:50%;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333;  float:left; text-align:left; font-weight:bold; padding-left:4px;\">Email :</td>
    <td height=\"30\"align=\"left\" style=\"width:50%;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; float:left;  text-align:left;padding-left:4px;\">".$delivery_details['email']."</td>
  </tr>
  <tr>
    <td height=\"30\" align=\" \" style=\"width:50%;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333;  float:left;  text-align:left; font-weight:bold; padding-left:4px;\">Mobile : </td>
     <td height=\"30\"align=\"left\" style=\"width:50%;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; float:left;  text-align:left;padding-left:4px;\">".$delivery_details['mobile']."</td>
  </tr>
 
</table> 
   <td>
   
   <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
 <tr><td>&nbsp; </td></tr>
  <tr><td>&nbsp; </td></tr>
  <tr><td>&nbsp; </td></tr>
  <tr><td>&nbsp; </td></tr>
  <tr>
  
    <td width=\" \" height=\"30\" align=\"left\" style=\"width:50%;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;  float:left;  text-align:left;color:#333333; font-weight:bold; padding-left:4px;\">Order Id : </td>
    <td height=\"30\" style=\"width:50%;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; text-align:left; color:#333333; float:left;  padding-left:4px;\">".'chonas'.$order[$i]['id']."</td>
  </tr>
   <tr>
    <td height=\"30\" align=\"left\" style=\"width:50%;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; float:left;   text-align:left;font-weight:bold; padding-left:4px;\">Address : </td>
    <td height=\"40\"align=\"left\" style=\"width:50%;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; float:left;  text-align:left; padding-left:4px;\">".$delivery_details['address']."</td>
  </tr>
  <tr>
    <td height=\"30\" align=\"left\" style=\"width:50%;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333;  float:left;  text-align:left;font-weight:bold; padding-left:4px;\">City :</td>
    <td height=\"30\" style=\"width:50%;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; text-align:left; color:#333333; float:left;  padding-left:4px;\">".$delivery_details['city']."</td>
  </tr>
    
  <tr>
    <td height=\"30\" align=\"left\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333;  float:left; font-weight:bold; padding-left:4px;\">&nbsp;</td>
    <td height=\"30\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-left:4px;\">&nbsp;</td>

  </tr>
  <tr>
    <td height=\"30\" align=\"left\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; font-weight:bold; padding-left:4px;\"></td>
    <td height=\"30\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-left:4px;\"></td>
  </tr>
</table> 
  
  
    
 
</table>

</td>
      </tr>
     
      <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
 
     
     <tr>
       <td height=\"25\" ><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border:#666666 solid 1px; \">
           <tr >
             <td width=\"20%\" height=\"35\" align=\"center\" bgcolor=\"#d3ced5\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; font-weight:bold; padding-left:4px;border-bottom: 1px solid #666666;\">Image </td>
             
        <td width=\"15%\" height=\"35\" align=\"center\" bgcolor=\"#d3ced5\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; font-weight:bold; padding-left:4px;border-bottom: 1px solid #666666;\">Order Id </td>
             
        <td width=\"15%\" height=\"35\" align=\"center\" bgcolor=\"#d3ced5\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; font-weight:bold; padding-left:4px;border-bottom: 1px solid #666666;\">Product Name </td>
             
      
        
        <td width=\"12%\" height=\"35\" align=\"center\" bgcolor=\"#d3ced5\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; font-weight:bold; padding-left:4px;border-bottom: 1px solid #666666;\">Price </td>
        
        <td width=\"15%\" height=\"35\" align=\"center\" bgcolor=\"#d3ced5\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; font-weight:bold; padding-left:4px;border-bottom: 1px solid #666666;\">Quantity</td>
        
           
       
        <td width=\"12%\" height=\"35\" align=\"center\" bgcolor=\"#d3ced5\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; font-weight:bold; padding-left:4px;border-bottom: 1px solid #666666;\">Discount Price</td>
        
      
            
        

        <td width=\"12%\" height=\"35\" align=\"center\" bgcolor=\"#d3ced5\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; font-weight:bold; padding-left:4px;border-bottom: 1px solid #666666;\">Total Price  </td>

           </tr>
           
           
";

 
  $message.="<tr>

       <td style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333;text-align:center; \"><img src='$baseurl/images/main_img/".$order_confirm['image']."' height=75 width=70 border=0 style='padding-left:5px'/>
       
        </td>
        
             <td style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; text-align:center;\">".'chonas'.$order[$i]['id']."</td>
             
              <td style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; text-align:center;\">".$order_confirm['title']."</td>
        
        <td align=\"center\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-left:4px;\"> Rs &nbsp;".round($stock_details['price'])."</td>
       
       <td align=\"center\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-left:4px;\">".$order[$i]['qty']."</td>
             
             
             
             <td align=\"center\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-left:4px;\"> &nbsp;".round($stock_details['discount_price'])."</td>
 

<td align=\"center\"style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-left:4px;\"> Rs &nbsp;".round($order[$i]['qty']*$stock_details['discount_price'])."</td>
          
             
           </tr>
           
</table>
           ";
          
      
      $message.="<tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
         </table></td>
        </tr>
     
     <tr>
       <td height=\"25\" align=\"right\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-left:4px;\">&nbsp;</td>
        </tr>
        
        
        
        <div height=\"25\" align=\"right\" bgcolor=\"#d3ced5\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; font-weight:bold; text-align:center;\">Total Amount (Rs)  &nbsp; : &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".round($order[$i]['qty']*$stock_details['discount_price'])."</div>
         

 
 
       <div height=\"25\" align=\"left\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; text-align:center;\">Thank you visit again have a nice day</div>
        
   
   
    
      <tr>
       <td height=\"25\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-left:4px;\">... </td>
        </tr>
    </table>
    
    </td>
  </tr>
</table>
</body>
</html>"; 
 
 
 $message1= ' <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Product Mail</title>
</head>

<body>  
                <div style="margin:0;padding:0;font-family:Segoe UI,Tahoma,Geneva,Verdana,sans-serif">

                    <div style="background-color:#dcbcf6;padding:20px">
                        <div style="background-color:#fff;border-radius:10px;padding:30px">
                            <div style="margin:0">
                                <p style="font-size:20px;font-weight:normal;padding:10px 0px 20px 0px">Thanks for your
                                    Order, <span style="color:purple">sahil!</span></p>
                            </div>
                            <hr>

                            <div style="--bs-gutter-x: 1.5rem; --bs-gutter-y: 0;display: flex;flex-wrap: wrap;margin-top: calc(var(--bs-gutter-y) * -1);
    margin-right: calc(var(--bs-gutter-x) * -.5); margin-left: calc(var(--bs-gutter-x) * -.5);">
                                <div style="flex: 0 0 auto;width: 60%;">
                                    <p style="color:purple;font-size:20px">Order Details</p>
                                </div>

                                <div style="text-align:right;flex: 0 0 auto;width: 40%;font-size:20px;float: right;">
                                    <p><b>Order Id - 1654</b></p>
                                </div>
                            </div>

                            <div style="margin:20px 0px">
                                <div style="padding:20px;border-radius:10px;border:1px solid #d8d5d5">
                                    <div style="display:flex">
                                        <div style="flex: 0 0 auto;width: 21.66666667%;">
                                            <img src="https://img.freepik.com/free-photo/wide-angle-shot-single-tree-growing-clouded-sky-during-sunset-surrounded-by-grass_181624-22807.jpg?w=2000"alt="image yha dlagi" style="width:150px; height: 100px;" class="CToWUd"
                                                data-bit="iit">
                                        </div>
                                        <div style="flex: 0 0 auto;width: 16.66666667%;">
                                            <p><b>Name :</b> dell laptop<br>
                                                <b>Color :</b> black<br>
                                                <b>Size :</b> 16"
                                            </p>
                                        </div>
                                        <div style="flex: 0 0 auto;width: 16.66666667%;">
                                            <p>Price: 500</p>
                                        </div>
                                        <div style="flex: 0 0 auto;width: 16.66666667%;">
                                            <p>Discount Price: 464</p>
                                        </div>
                                        <div style="flex: 0 0 auto;width: 16.66666667%;">
                                            <p>Qty: 1</p>
                                        </div>
                                        <div style="flex: 0 0 auto;width: 16.66666667%;">
                                            <p>Total: 464</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style="--bs-gutter-x: 1.5rem;--bs-gutter-y: 0;display: flex;    flex-wrap: wrap;margin-top: calc(var(--bs-gutter-y) * -1);    margin-right: calc(var(--bs-gutter-x) * -.5); margin-left: calc(var(--bs-gutter-x) * -.5);">
                                <div style="flex: 0 0 auto;width: 50%;">
                                    <p style="font-weight:bold;flex: 0 0 auto;width: 50%;flex: 0 0 auto;">Billing Date
                                    </p>
                                    <p><span style="font-weight:bold">Name :</span> sahil<br>
                                        <span style="font-weight:bold">Mobile :</span> 9716489509<br>
                                        <span style="font-weight:bold">Address :</span> ni bta rha<br>
                                        <span style="font-weight:bold">Pincode :</span> 110032
                                    </p>
                                </div>
                                <div>
                                    <p style="font-weight:bold">Shipping Details</p>
                                    <p><span style="font-weight:bold">Name :</span> sahil<br>
                                        <span style="font-weight:bold">Mobile :</span> 9716489509<br>
                                        <span style="font-weight:bold">Address :</span> ni bta rha<br>
                                        <span style="font-weight:bold">Pincode :</span> 110032
                                    </p>
                                </div>
                            </div>

                            <div style="background-color:#a8729a;padding:10px 0px 20px 0px;border-radius:8px;margin-top:30px">
                                <div style="text-align:right">
                                    <h5 style="color:white;font-size:18px;padding:0px;margin:20px 40px">Coupon Details:
                                        Coupon Name (Rs12/-)</h5>
                                    <h3 style="color:white;font-size:24px;padding:0px;margin:0px 40px">Total Paid: <span
                                            style="color:white">&nbsp;Rs. 452 /-</span></h3>
                          
                </div>
            </div>
        </div> 

</body>

</html>'; 

  // echo $message1;   die;

       //$to = "deepakkadiansriramtrade@gmail.com";
       $to= "$delivery_details[email],deepakkadiansriramtrade@gmail.com,kunalsnegi07@gmail.com";
        $subject="Shopping Details From chonas";  
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
       $headers .="From:chonas";///////changes will be done
       //$headers .="chonas,$data[email] \r\n";
        if($delivery_details['email']!='')
        {
        @mail($to,$subject,$message,$headers); 
        }    
      
      
     // die;

           $sql = "INSERT INTO tbl_order_details(`session_id`,`user_id`,`name`,`email`,`mobile`,`address`,`city`,`pin`,`ord_id`,`product_id`,`product_name`,`discount`,`price`,`qty`,`total_price`,`color`,`size`,`stock_id`,`coupon_name`,`coupon_offer`,`add_date`,`image`,`tracking_id`,`taxn_id`) values ('".$session_id."','".$user_id."','".$delivery_details['name']."','".$delivery_details['email']."','".$delivery_details['mobile']."','".$delivery_details['address']."','".$delivery_details['city']."','".$delivery_details['pin']."','".'chonas'.$order[$i]['id']."','".$order[$i]['product_id']."','".$order_confirm['title']."','".$stock_details['discount_price']."','".$stock_details['price']."','".$order[$i]['qty']."','".$total_price."','".$stock_details['color']."','".$stock_details['size']."','".$stock_details['id']."','".$_SESSION['coupon_name']."','".$use_coupon_price."',now(),'".$stock_details['image1']."','".'chonas'.time().rand(1000,100099)."','')";

       //  die;

$query=$this->con->query($sql);
      //echo "DELETE FROM `tbl_cart` WHERE `id`='".$order[$i]['id']."'"; die;
   
    //  if($query){
         
       
         
    //  }
     
     
        $ddata= mysqli_query($this->con,"DELETE FROM `tbl_cart` WHERE `id`='".$order[$i]['id']."' ");


         }

echo '<script type="text/javascript">'; 
echo 'alert("Your order has been successfully done.");'; 
echo 'window.location.href = "index.php";';
echo '</script>';
       
      echo 12321; die;
        
    
  }

      public function cancel_order($ord_id,$user_id)
      {
        $baseurl=$this->baseurl;
       // echo "update tbl_order_details set status='0' where id='".$ord_id."'"; die;
        $sql=$this->con->query("update tbl_order_details set status='0' where id='".$ord_id."' && user_id='".$user_id."'");
        if($sql)
        {
           header('location:'.$baseurl.'/order-history');
        }
      }

       public function cancel_admin_order($ord_id)
      {
        $baseurl=$this->baseurl;
       // echo "update tbl_order_details set status='0' where id='".$ord_id."'"; die;
        $sql=$this->con->query("update tbl_order_details set status='0' where id='".(int)$ord_id."'");
        if($sql)
        {
           header('location:order-list.php');
        }
      }



  public function update_cart_qty($cart_id,$qty)
  {

     $baseurl=$this->baseurl;
        $id=$_GET['cart_id'];
      
      //echo "DELETE FROM tbl_cart where id='".$id."'"; die;

       $sql = $this->con->query("update tbl_cart set qty='".$qty."' where id='".$cart_id."' ");
        header('location:'.$baseurl.'/cart.php');


  } 
 


public function add_color_size_stock($info,$pro_id,$cat_id){

    $id =$pro_id;



         
     
  

      //die;

      $count_color = $info['color'];

    for ($ij=0; $ij <count($count_color) ; $ij++) { 


      $color = $info['color'][$ij];

      $size = $info['size'][$ij];
         
      $price = $info['price'][$ij];
         
      $discount_price = $info['discount_price'][$ij];

      $qty = $info['qty'][$ij];
            
              //echo "select * from tbl_reg_user where mobile='".$mobile."' && email='".$email."'";
           $exist_stock = $this->con->query("select * from tbl_size_color_stock where product_id='".$id."' and color='".$color."' and size='".$size."'");
      // echo $exist_stock->num_rows; die;
        if($exist_stock->num_rows>0)
        {
         
            echo "<script>alert('This  $color and $size already exist ');</script>";
       
        }
        else
        {


        $image1 = "";

        if(@$_FILES["image1"]["name"][$ij] != '') 
            {
             
            @$image1 = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image1"]["name"][$ij]));
            
            $path="../images/pro_img/".$image1;
            move_uploaded_file($_FILES["image1"]["tmp_name"][$ij], $path);
            }



        $image2 = "";

        if(@$_FILES["image2"]["name"][$ij] != '') 
            {
             
            @$image2 = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image2"]["name"][$ij]));
            
            $path="../images/pro_img/".$image2;
            move_uploaded_file($_FILES["image2"]["tmp_name"][$ij], $path);
            }



        $image3 = "";

        if(@$_FILES["image3"]["name"][$ij] != '') 
            {
             
            @$image3 = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image3"]["name"][$ij]));
            
            $path="../images/pro_img/".$image3;
            move_uploaded_file($_FILES["image3"]["tmp_name"][$ij], $path);
            }



        $image4 = "";

        if(@$_FILES["image4"]["name"][$ij] != '') 
            {
             
            @$image4 = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image4"]["name"][$ij]));
            
            $path="../images/pro_img/".$image4;
            move_uploaded_file($_FILES["image4"]["tmp_name"][$ij], $path);
            }

  //echo "INSERT INTO tbl_size_color_stock(`product_id`,`color`,`size`,`price`,`discount_price`,`category_id`,`qty`,`image1`,`image2`,`image3`,`image4`,`add_date`) values ('".$id."','".$color."','".$size."','".$price."','".$discount_price."','".$cat_id."','".$qty."','".$image1."','".$image2."','".$image3."','".$image4."',now())"; die;
  
   $sql_stock = $this->con->query("INSERT INTO tbl_size_color_stock(`product_id`,`color`,`size`,`price`,`discount_price`,`category_id`,`qty`,`image1`,`image2`,`image3`,`image4`,`add_date`) values ('".$id."','".$color."','".$size."','".$price."','".$discount_price."','".$cat_id."','".$qty."','".$image1."','".$image2."','".$image3."','".$image4."',now())");
 
 echo "<script>alert('Stock add successfully')</script>";

      header('location:add-product.php?edit='.$id);
 }

}


}



 

     public function delete_stock($sql,$product_id)
      {
        $sql = $this->con->query($sql);
        if($sql>0)
        {
           

          
        
 
echo "<script>"; 
echo "alert('Color size and stock delete successfull');"; 
echo "window.location.href = 'add-product.php?edit=$product_id'";
echo "</script>";
 
     // header('location:add-product.php?edit='.$product_id);

        }
        
         else {
    echo "<script>"; 
echo "alert('Color size and stock not delete');"; 
echo "window.location.href = 'add-product.php?edit=$pro_id'";
echo "</script>";
  }
  
      }


 


     public function check_coupon($info,$page_name)
      {
       
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');
          $coupon_name = mysqli_real_escape_string($this->con,trim($info['coupon_name']));
          $total_price = mysqli_real_escape_string($this->con,trim($info['total_price']));
       
        $exist_coupon = $this->con->query("select * from tbl_coupon where coupon_name='".$coupon_name."'");
        if($exist_coupon->num_rows>0)
        {
            $valid_coupon = $exist_coupon->fetch_assoc();
           // echo $total_price;
             $offer= $valid_coupon['offer'];
             if($total_price<$offer){
              //echo 12321;
                echo "<script>alert('Product price less than coupon price ');
            window.location.href='checkout';</script>";
             }
             else{
              $_SESSION['coupon_offer'] = $offer;
             $_SESSION['coupon_name']=$valid_coupon['coupon_name'];
            echo "<script>alert('Coupon has been apply successfully.');
            window.location.href='checkout';</script>";

          }
       
        }
        else
        {
         unset($_SESSION['coupon_offer']);
         unset( $_SESSION['coupon_name']);
        echo "<script>alert('This coupon not valid.');
            window.location.href='checkout';</script>";
        }

         
      }



      public function product_active($tbl,$where,$total_row,$page)
      {

        $sql = $this->con->query("UPDATE $tbl set status='1' $where");
        if($sql>0)
        {
          $_SESSION['msg']=$total_row.' Rows Actived Successfully';
          header('location:'.$page);

        }
      }
        
          public function product_deactive($tbl,$where,$total_row,$page)
      {
        
        $sql = $this->con->query("UPDATE $tbl set status='0' $where");
        if($sql>0)
        {
          $_SESSION['msg']=$total_row.' Rows Deactived Successfully';
          header('location:'.$page);

        }
      }
          public function product_delete($tbl,$where,$total_row,$page,$pro_stock_dl)
      {
 //echo "DELETE FROM tbl_size_color_stock $pro_stock_dl"; die;
 $sql_stoct_pro = $this->con->query("DELETE FROM tbl_size_color_stock $pro_stock_dl");
        $sql = $this->con->query("DELETE FROM $tbl $where");

        if($sql>0)
        {
          $_SESSION['msg']=$total_row.' Rows Deleted Successfully';
          header('location:'.$page);
        }

      }


      public function getState($id)
      {
           
           $sql = $this->con->query("select title from tbl_state where id='".$id."' && status=1");
              $state_detail = $sql->fetch_assoc();
              return $state_detail['title'];
      }

      public function add_gallery($info)
      {
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');
        $title = mysqli_real_escape_string($this->con,trim($info['title']));
        $image = "";
        if(@$_FILES['image']['name'] != '') 
        {
        @$image = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image"]["name"]));
        $path="../images/main_img/".$image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        }
      $sql = $this->con->query("INSERT INTO tbl_gallery(`title`,`image`,`created_at`) values 
     ('".$title."','".$image."',now())");
        if($sql)
        {
        $this->portal_log($id,"$title - Gallery Added");
        unset($_SESSION['error']);
        $_SESSION['msg']='Data Inserted Successfully';
        header('location:add_gallery.php');

        }
        else
        {
        unset($_SESSION['msg']);  
        $_SESSION['error']='Something Went Wrong';
        header('location:add_gallery.php');
        }

         
      }

       public function update_gallery($info,$id)
      {
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');
        $state_id = $info['state_id'];
        $title = mysqli_real_escape_string($this->con,trim($info['title']));
        $image = "";
        if(@$_FILES['image']['name'] != '') 
        {
        @$image = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image"]["name"]));
        $path="../images/main_img/".$image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        }
          $query = "update tbl_gallery set `title`='".$title."' ";
          if($image!='')
          {
            $query.=",`image`='".$image."' ";
          }
          $query.=",`update_at`=now() where `id`='".$id."'";
          $sql = $this->con->query($query);
          if($sql)
          {
            $this->portal_log($id,"$title - Updated");
            $_SESSION['msg']='Data Updated Successfully';
            header('location:manage_gallery.php');
          }
          else
          {
            $_SESSIONP['error']='Data Not Updated';
          }
      }
      


      public function add_content($info)
      {
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');
        $p_id = $info['p_id'];
        $page = mysqli_real_escape_string($this->con,trim($info['page']));
        $p_keywords = mysqli_real_escape_string($this->con,trim($info['p_keywords']));
        $p_title = mysqli_real_escape_string($this->con,trim($info['p_title']));
        $url = str_replace($find,$replace,strtolower($page));
        $p_description = mysqli_real_escape_string($this->con,trim($info['p_description']));
        $content = mysqli_real_escape_string($this->con,trim($info['content']));
        $exist_cotent = $this->con->query("select * from tbl_content where page='".$page."'");
        if($exist_cotent->num_rows>0)
        {
          unset($_SESSION['msg']);
          $_SESSION['error']='This Page is already exist';
          echo "<script>alert('This Page is already exist');</script>
          window.location.href='add_content.php';";
       
        }
        else
        {
        $image = "";
        if(@$_FILES['image']['name'] != '') 
        {
        @$image = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image"]["name"]));
        $path="../images/content/".$image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        }
        $logo = "";
        if(@$_FILES['logo']['name'] != '') 
        {
        @$logo = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["logo"]["name"]));
        $path="../images/main_img/".$logo;
        move_uploaded_file($_FILES['logo']['tmp_name'], $path);
        }
      $sql = $this->con->query("INSERT INTO tbl_content(`page`,`p_id`,`p_title`,`slug`,`p_description`,`p_keywords`,`content`,`image`,`logo1`,`created_at`) values 
     ('".$page."','".$p_id."','".$p_title."','".$url."','".$p_description."','".$p_keywords."','".$content."','".$image."','".$logo."',now())");
        if($sql)
        {
        $this->portal_log($id,"$title - Added");
        unset($_SESSION['error']);
        $_SESSION['msg']='Data Inserted Successfully';
        header('location:add_content.php');

        }
        else
        {
        unset($_SESSION['msg']);  
        $_SESSION['msg']='Something Went Wrong';
        header('location:add_cotent.php');
        }
      }
         
      }

      public function update_content($info,$id)
      {
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');
        $p_id = $info['p_id'];
        $page = mysqli_real_escape_string($this->con,trim($info['page']));
        $p_title = mysqli_real_escape_string($this->con,trim($info['p_title']));
        $url = str_replace($find,$replace,strtolower($page));
        $p_description = mysqli_real_escape_string($this->con,trim($info['p_description']));
        $p_keywords = mysqli_real_escape_string($this->con,trim($info['p_keywords']));
        $content = mysqli_real_escape_string($this->con,trim($info['content']));
        $exist_cotent = $this->con->query("select * from tbl_content where page='".$page."' && id!='".$id."' && status!=3");
        if($exist_cotent->num_rows>0)
        {
          unset($_SESSION['msg']);
          $_SESSION['error']='This Page is already exist';
          echo "<script>alert('This Page is already exist');</script>
          window.location.href='add_content.php';";
       
        }
        else
        {
        $image = "";
        if(@$_FILES['image']['name'] != '') 
        {
        @$image = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image"]["name"]));
        $path="../images/content/".$image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        }
        $logo = "";
        if(@$_FILES['logo']['name'] != '') 
        {
        @$logo = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["logo"]["name"]));
        $path="../images/main_img/".$logo;
        move_uploaded_file($_FILES['logo']['tmp_name'], $path);
        }
          $query = "update tbl_content set `p_id`='".$p_id."',`page`='".$page."',`p_title`='".$p_title."',`slug`='".$url."',
          `p_description`='".$p_description."',`p_keywords`='".$p_keywords."',`content`='".$content."' ";
          if($image!='')
          {
            $query.=",`image`='".$image."' ";
          }
          if($logo!='')
          {
            $query.=",`logo1`='".$logo."' ";
          }
          $query.=",`update_at`=now() where `id`='".$id."'";
          $sql = $this->con->query($query);
          if($sql)
          {
            $this->portal_log($id,"$title - Updated");
            $_SESSION['msg']='Data Updated Successfully';
            header('location:manage_content.php');
          }
          else
          {
            $_SESSION['error']='Data Not Updated';
          }
        }
      }


      public function add_service($info)
      {
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');
        $p_id = $info['p_id'];
        $p_keywords = mysqli_real_escape_string($this->con,trim($info['p_keywords']));
        $p_title = mysqli_real_escape_string($this->con,trim($info['p_title']));
        $url = str_replace($find,$replace,strtolower($p_title));
        $p_description = mysqli_real_escape_string($this->con,trim($info['p_description']));
        $content = mysqli_real_escape_string($this->con,trim($info['content']));
        $exist_cotent = $this->con->query("select * from tbl_services where page='".$page."'");
        if($exist_cotent->num_rows>0)
        {
          unset($_SESSION['msg']);
          $_SESSION['error']='This Service is already exist';
          echo "<script>alert('This Service is already exist');</script>
          window.location.href='add_service.php';";
       
        }
        else
        {
        $image = "";
        if(@$_FILES['image']['name'] != '') 
        {
        @$image = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image"]["name"]));
        $path="../images/content/".$image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        }
        $logo = "";
        if(@$_FILES['logo']['name'] != '') 
        {
        @$logo = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["logo"]["name"]));
        $path="../images/main_img/".$logo;
        move_uploaded_file($_FILES['logo']['tmp_name'], $path);
        }
      $sql = $this->con->query("INSERT INTO tbl_services(`p_id`,`p_title`,`slug`,`p_description`,`p_keywords`,`content`,`image`,`logo1`,`created_at`) values 
     ('".$p_id."','".$p_title."','".$url."','".$p_description."','".$p_keywords."','".$content."','".$image."','".$logo."',now())");
        if($sql)
        {
        $this->portal_log($id,"$title - Added");
        unset($_SESSION['error']);
        $_SESSION['msg']='Data Inserted Successfully';
        header('location:add_service.php');

        }
        else
        {
        unset($_SESSION['msg']);  
        $_SESSION['msg']='Something Went Wrong';
        header('location:add_service.php');
        }
      }
         
      }

      public function update_service($info,$id)
      {
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');
        $p_id = $info['p_id'];
        $p_title = mysqli_real_escape_string($this->con,trim($info['p_title']));
        $url = str_replace($find,$replace,strtolower($p_title));
        $p_description = mysqli_real_escape_string($this->con,trim($info['p_description']));
        $p_keywords = mysqli_real_escape_string($this->con,trim($info['p_keywords']));
        $content = mysqli_real_escape_string($this->con,trim($info['content']));
        $exist_cotent = $this->con->query("select * from tbl_services where page='".$page."' && id!='".$id."' && status!=3");
        if($exist_cotent->num_rows>0)
        {
          unset($_SESSION['msg']);
          $_SESSION['error']='This Service is already exist';
          echo "<script>alert('This Service is already exist');</script>
          window.location.href='add_service.php';";
       
        }
        else
        {
        $image = "";
        if(@$_FILES['image']['name'] != '') 
        {
        @$image = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image"]["name"]));
        $path="../images/content/".$image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        }
        $logo = "";
        if(@$_FILES['logo']['name'] != '') 
        {
        @$logo = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["logo"]["name"]));
        $path="../images/main_img/".$logo;
        move_uploaded_file($_FILES['logo']['tmp_name'], $path);
        }
          $query = "update tbl_services set `page`='".$page."',`p_title`='".$p_title."',`slug`='".$url."',
          `p_description`='".$p_description."',`p_keywords`='".$p_keywords."',`content`='".$content."' ";
          if($image!='')
          {
            $query.=",`image`='".$image."' ";
          }
          if($logo!='')
          {
            $query.=",`logo1`='".$logo."' ";
          }
          $query.=",`update_at`=now() where `id`='".$id."'";
          $sql = $this->con->query($query);
          if($sql)
          {
            $this->portal_log($id,"$title - Updated");
            $_SESSION['msg']='Data Updated Successfully';
            header('location:manage_service.php');
          }
          else
          {
            $_SESSION['error']='Data Not Updated';
          }
        }
      }


      public function add_blog($info)
      {
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');
        $p_keywords = mysqli_real_escape_string($this->con,trim($info['p_keywords']));
        $page = mysqli_real_escape_string($this->con,trim($info['page']));
        $p_title = mysqli_real_escape_string($this->con,trim($info['p_title']));
        $url = str_replace($find,$replace,strtolower($page));
        $p_description = mysqli_real_escape_string($this->con,trim($info['p_description']));
        $content = mysqli_real_escape_string($this->con,trim($info['content']));
        $short_content = mysqli_real_escape_string($this->con,trim($info['short_content']));
        $exist_cotent = $this->con->query("select * from tbl_blog where p_title='".$p_title."'");
        if($exist_cotent->num_rows>0)
        {
          unset($_SESSION['msg']);
          $_SESSION['error']='This Blog is already exist';
          echo "<script>alert('This Blog is already exist');</script>
          window.location.href='add_blog.php';";
       
        }
        else
        {
        $image = "";
        if(@$_FILES['image']['name'] != '') 
        {
        @$image = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image"]["name"]));
        $path="../images/content/".$image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        }
        $logo = "";
        if(@$_FILES['logo']['name'] != '') 
        {
        @$logo = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["logo"]["name"]));
        $path="../images/main_img/".$logo;
        move_uploaded_file($_FILES['logo']['tmp_name'], $path);
        }
      $sql = $this->con->query("INSERT INTO tbl_blog(`page`,`p_title`,`slug`,`p_description`,`p_keywords`,`short_content`,`content`,`image`,`logo1`,`created_at`) values 
     ('".$page."','".$p_title."','".$url."','".$p_description."','".$p_keywords."','".$short_content."','".$content."','".$image."','".$logo."',now())");
        if($sql)
        {
        $this->portal_log($id,"$title - Added");
        unset($_SESSION['error']);
        $_SESSION['msg']='Data Inserted Successfully';
        header('location:add_blog.php');

        }
        else
        {
        unset($_SESSION['msg']);  
        $_SESSION['msg']='Something Went Wrong';
        header('location:add_blog.php');
        }
      }
         
      }

      public function update_blog($info,$id)
      {
        $find = array(' ','+',',','_','@','#','$','%','^','&','*','(',')','{','}','[',']',':',';','/');
        $replace = array('-','-','-','-','-','-','-','-','-','and','-','-','-','-','-','-','-','-','-','-');
        $p_id = $info['p_id'];
        $p_title = mysqli_real_escape_string($this->con,trim($info['p_title']));
        $url = str_replace($find,$replace,strtolower($page));
        $p_description = mysqli_real_escape_string($this->con,trim($info['p_description']));
        $p_keywords = mysqli_real_escape_string($this->con,trim($info['p_keywords']));
        $content = mysqli_real_escape_string($this->con,trim($info['content']));
        $exist_cotent = $this->con->query("select * from tbl_services where page='".$page."' && id!='".$id."' && status!=3");
        if($exist_cotent->num_rows>0)
        {
          unset($_SESSION['msg']);
          $_SESSION['error']='This Service is already exist';
          echo "<script>alert('This Service is already exist');</script>
          window.location.href='add_service.php';";
       
        }
        else
        {
        $image = "";
        if(@$_FILES['image']['name'] != '') 
        {
        @$image = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image"]["name"]));
        $path="../images/content/".$image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        }
        $logo = "";
        if(@$_FILES['logo']['name'] != '') 
        {
        @$logo = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["logo"]["name"]));
        $path="../images/main_img/".$logo;
        move_uploaded_file($_FILES['logo']['tmp_name'], $path);
        }
          $query = "update tbl_services set `page`='".$page."',`p_title`='".$p_title."',`slug`='".$url."',
          `p_description`='".$p_description."',`p_keywords`='".$p_keywords."',`content`='".$content."' ";
          if($image!='')
          {
            $query.=",`image`='".$image."' ";
          }
          if($logo!='')
          {
            $query.=",`logo1`='".$logo."' ";
          }
          $query.=",`update_at`=now() where `id`='".$id."'";
          $sql = $this->con->query($query);
          if($sql)
          {
            $this->portal_log($id,"$title - Updated");
            $_SESSION['msg']='Data Updated Successfully';
            header('location:manage_service.php');
          }
          else
          {
            $_SESSION['error']='Data Not Updated';
          }
        }
      }

      public function add_testimonial($info)
      {
        
        $name = mysqli_real_escape_string($this->con,trim($info['name']));
        $position = mysqli_real_escape_string($this->con,trim($info['position']));
        $des = mysqli_real_escape_string($this->con,trim($info['des']));
        $image = "";
        if(@$_FILES['image']['name'] != '') 
        {
        @$image = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image"]["name"]));
        $path="../images/content/".$image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        }
      $sql = $this->con->query("INSERT INTO tbl_testimonial(`name`,`position`,`des`,`image`,`created_at`) values 
     ('".$name."','".$position."','".$des."','".$image."',now())");
        if($sql)
        {
        $this->portal_log($id,"$title - Added");
        unset($_SESSION['error']);
        $_SESSION['msg']='Data Inserted Successfully';
        header('location:add_testimonial.php');

        }
        else
        {
        unset($_SESSION['msg']);  
        $_SESSION['msg']='Something Went Wrong';
        header('location:add_testimonial.php');
        }
         
      }

      public function update_testimonial($info,$id)
      {
        $name = mysqli_real_escape_string($this->con,trim($info['name']));
        $position = mysqli_real_escape_string($this->con,trim($info['position']));
        $des = mysqli_real_escape_string($this->con,trim($info['des']));
        $image = "";
        if(@$_FILES['image']['name'] != '') 
        {
        @$image = rand() . '_' .str_replace($find,$replace,strtolower($_FILES["image"]["name"]));
        $path="../images/content/".$image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        }
          $query = "update tbl_testimonial set `name`='".$name."',`position`='".$position."',`des`='".$des."' ";
          if($image!='')
          {
            $query.=",`image`='".$image."' ";
          }
          $query.=",`update_at`=now() where `id`='".$id."'";
          $sql = $this->con->query($query);
          if($sql)
          {
            $this->portal_log($id,"$title - Updated");
            $_SESSION['msg']='Data Updated Successfully';
            header('location:manage_testimonial.php');
          }
          else
          {
            $_SESSION['error']='Data Not Updated';
          }
      }
}


   
?>