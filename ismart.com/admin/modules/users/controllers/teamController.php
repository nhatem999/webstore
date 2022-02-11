<?php

function construct(){
    load_model('index');
    load('lib','validation');
    load('helper','url');
    load('lib','email');
}
function indexAction(){
    load_view('teamIndex');
}
function addcatAction(){

    global $error,$fullname,$password,$username,$email,$role,$email,$data,$alert;
    if(isset($_POST['btn-add-admin'])){
        $error =array();
        if(empty($_POST['fullname'])){
            $error['fullname'] = "Bạn cần nhập họ tên"; 
        }else{        
                $fullname = $_POST['fullname'];     
        }
        if(empty($_POST['Username'])){
            $error['username'] = "Bạn cần điền tên đăng nhập"; 
        }else{
            if(!is_username($_POST['Username'])){
                $error['username']= "Tên không đúng định dạng";
            }else{
                if(db_num_rows("SELECT*FROM `tbl_users` WHERE `username` = '{$_POST['Username']}'") >=1){
                    $error['username'] = 'Username đã tồn tại';
                } else{
                    $username = $_POST['Username'];
                }
            }   
        }
        if(empty($_POST['password'])){
            $error['password'] = "Bạn cần điền mật khẩu"; 
        }else{
            if(!is_password($_POST['password'])){
                $error['password'] = "Mật khẩu chưa đúng định dạng"; 
            }
                $password = $_POST['password'];
            
        }
        if(empty($_POST['email'])){
            $error['email'] = "Bạn cần nhập email"; 
        }else{
           if(!is_email($_POST['email'])){
               $error['email']="Email chưa đúng định dạng";
           }
         else{
              if(db_num_rows("SELECT*FROM `tbl_users` WHERE `email` = '{$_POST['email']}'") >=1){
                    $error['email'] = 'Email đã tồn tại';
                } else{
                    $email = $_POST['email'];
                }
               }
            
        }
        // check upload file
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            }
        } else {
            $error['upload_image'] = "(*) Bạn chưa upload tệp";
        }
       if(empty($_POST['role'])){
           $error['parent-cat']="Bạn cần chọn quyền";
       }else{
           $role = $_POST['role'];
       }
    //    Not error
        if(empty($error)){
        //     // update
            $alert =array();
            $avatar = upload_image('public/images/upload/admins/', $type);
             $creator = $_SESSION['user_login'];
            // show_array($_SESSION);
            $data = array(
                'fullname' => $fullname,
                'username' =>$username,
                'password' =>md5($password),
                'email' =>$email,
                'role' =>$role,
                'file' => $avatar,
                'creator' =>$creator,
                'created_date'=> date("d/m/Y"),
            );
            // show_array($_POST); 
             add_user($data);
             $alert['creat_admin']="Đăng ký tài khoản admin thành công";
        }
        //   show_array($data);
      
    
}
load_view('add_cat');
}
function updateAction(){

load('helper', 'image');
load('helper', 'slug');
global $error, $email, $fullname, $tel, $address, $avatar, $admin_status, $role;
if(isset($_GET['admin_id'])){
    $admin_id = $_GET['admin_id'];
}
if (isset($_POST['btn-update-admin'])) {
    $error = array();
    // Check fullname
    if (empty($_POST['fullname'])) {
        $error['fullname'] = 'Không được để trống Họ và tên';
    } else {
        if (!(strlen($_POST['fullname']) >= 2 && strlen($_POST['fullname']) <= 32)) {
            $error['fullname'] = 'Họ và tên từ 2 đến 32 ký tự';
        } else {
            $fullname = $_POST['fullname'];
        }
    }
    // Check email
    if (empty($_POST['email'])) {
        $error['email'] = 'Không được để trống email';
    } else {
        $email = $_POST['email'];
    }
    // Check tell
    if (!empty($_POST['phone_number'])) {
        $tel = $_POST['phone_number'];
    }
    // Check address
    if (!empty($_POST['address'])) {
        $address = $_POST['address'];
    }
    // check upload file
    if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
        $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $size = $_FILES['file']['size'];
        if (!is_image($type, $size)) {
            $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
        } else {
            $old_thumb = get_info_admin('file', $admin_id);
            if(!empty($old_thumb)){
                delete_image($old_thumb);
                $avatar = upload_image('public/images/upload/admins/', $type); 
            } else {
                $avatar = upload_image('public/images/upload/admins/', $type);
            }
        }
    } else{
        $avatar = get_info_admin('file', $admin_id);
    }

    // Check role
    if (empty($_POST['role'])) {
        $error['role'] = 'Bạn chưa chọn danh mục';
    } else {
        $role = $_POST['role'];
    }
    // check not error
    if (empty($error)) {
        $data = array(
        'fullname' => $fullname,
        'email' => $email,
        'file' => $avatar,
        'phone_number' => $tel,
        'address' => $address,
        'role' => $role,
     
        'created_date'=> date('d/m/y h:m'),
        );
        update_admin($data, $admin_id);
        $error['admin'] = "Cập nhật ADMIN thành công"."<br>"."<a href='?mod=users&controller=team&action=index'>Trở về danh sách ADMIN</a>";
    }
}

    load_view('update_admin');
}
function delete_adminAction(){
    $admin_id = $_GET['admin_id'];
    delete_admin($admin_id);
  
        load_view('teamIndex');
    
}