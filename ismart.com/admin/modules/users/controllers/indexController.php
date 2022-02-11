<?php

function construct() {
    load_model('index');
    load('lib','validation');
    load('helper','url');
    load('lib','email');
  
}

function indexAction() {
    
    // $list_user = get_list_users();

    
}

function loginAction() {
  
    echo date('d/m/Y h:m:s');
    global $error,$username,$password;
   
    if(isset($_POST['btn-login'])){
        $error = array();
        if(empty($_POST['username'])){
            $error['username'] = "Bạn cần nhập tài khoản";
        }else{
            if(!is_username($_POST['username'])){
                $error['username'] ="Tên đăng nhập không đúng định dạng";
            }

            else{
                $username = $_POST['username'];
            }
            
        }
        if(empty($_POST['password'])){
            $error['password'] = "Bạn cần nhập mật khẩu";
        }else{
            if(!is_password($_POST['password'])){
                $error['password']="Mật khẩu không đúng định dạng";
            }
      else{
            $password = $_POST['password'];

        }
        }
        
    
    if(empty($error)){
        
        if(!empty($username) && !empty($password)){
            if(check_login($username,$password)){
                  if(isset($_POST['remember_me'])){
                    setcookie('is_login',true, time()+3600);
                    setcookie('user_login','unitop',time()+3600);     
                }
                // Lưu trữ phiên đăng nhập
                $_SESSION['is_login']=true;
                $_SESSION['user_login']=$username;
                show_array($_SESSION) ;
               redirect(base_url("?mod=users&controller=team&action=index")) ;
            }
            else{
             
                $error['account'] = "Đăng nhập thất bại";
            }  
                }      
        }
    }
     
    load_view('index');
 
}

function resetAction() {
    global $password,$data,$error,$success;
    $info_user = get_user_by_username(user_login());
    if(isset($_POST['btn-submit'])){
        $error = array();
        if(empty($_POST['pass-old'])){
            $error['password'] = "Bạn cần nhập mật khẩu";
        }else{
            $partten = "/^[A-Z]{1}([\w_\.!@#$%^&*()]+){5,31}$/";
        if(!preg_match($partten,$_POST['pass-old'],$matchs)){
            $error['password']="Mật khẩu không đúng định dạng";
        }
        else{
            $password = $_POST['pass-old'];
            if($info_user['password'] == md5($password)){
                if(empty($_POST['new-pass'])){
                    $error['new-password'] = "Bạn cần nhập mật khẩu";
                }else{
                    $partten = "/^[A-Z]{1}([\w_\.!@#$%^&*()]+){5,31}$/";
                    if(!preg_match($partten,$_POST['pass-old'],$matchs)){
                        $error['new-password']="Mật khẩu không đúng định dạng";
                    }else{
                        $password = $_POST['new-pass'];
                        if(empty($_POST['confirm-pass'])){
                            $error['confirm-password'] = "Bạn cần xác nhạn mật khẩu";
                        } 
                        else{
                            $partten = "/^[A-Z]{1}([\w_\.!@#$%^&*()]+){5,31}$/";
                            if(!preg_match($partten,$_POST['pass-old'],$matchs)){
                                $error['confirm-password']="Mật khẩu không đúng định dạng";
                            }
                            else{
                               
                                if($_POST['confirm-pass']==$password){
                                   
                                    $success= array();
                                    $data = array(
                                        'password' => md5($password),
                                    );
                                    // update_pass($data,$reset_token);
                                    update_password(user_login(),$data);
                                    $success['pass']="Đổi mật khẩu thành công";
                                }else{
                                    $error['reset-pass']="Xác nhận  mật khẩu sai";
                                }
                            }
                        }
                    }
                }
                
            }
            else{
                $error['password']="Mật khẩu sai";
            }
        }
        }
             if(empty($error)){
            $data = array(
                'password' => $password,
            );
            // update_pass($data,$reset_token);
            //  redirect("?mod=login&action=resetOK"); 
        }
    }
   
    load_view('reset');

}

function logoutAction() {
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=users&action=login");
}
function resetOKAction() {
    load_view('resetOK');
    global $error,$password,$username;

    $reset_token = $_GET['reset_token'];
   //  echo $reset_token;
   if(!empty($reset_token)){
       if(check_reset_token($reset_token)){
           if(isset($_POST['btn-new-pass'])){
               $error = array();
               if(empty($_POST['password'])){
                   $error['password'] = "Bạn cần nhập mật khẩu";
               }else{
                   $partten = "/^[A-Z]{1}([\w_\.!@#$%^&*()]+){5,31}$/";
               if(!preg_match($partten,$_POST['password'],$matchs)){
                   $error['password']="Mật khẩu không đúng định dạng";
               }else{
                   $password =md5($_POST['password']);
               }
               }
                    if(empty($error)){
                   $data = array(
                       'password' => $password,
                   );
                   update_pass($data,$reset_token);
                    redirect("?mod=login&action=resetOK"); 
               }
           }
           load_view('newPass');
         
       }else{
           echo "Yeu cau ko hop le";
       }}
       else{
           if(isset($_POST['btn-reset'])){
               $error = array();
               if(empty($_POST['email'])){
                   $error['email']="Ban không được để trông email";
               }
               else{
                   if(!is_email($_POST['email'])){
                       $error['email']= "Email không đúng định dạng";
                   }
                   else{
                       $email = $_POST['email'];
                   }
               }
               #kết luận 
               if(empty($error)){
                  
                       if(check_email($email)){
                           $reset_token = md5($email.time());
                           $data = array(
                               'reset_token' => $reset_token
                           );
                           // Cập nhật mã reset cho user cần khôi phục mật khẩu
                           update_reset_token($data,$email);
                           // GỬi link khôi phcun cho người dùng
                           $link_reset = base_url("?mod=login&action=reset&reset_token={$reset_token}");
                           $content = "<p>Bạn vui lòng click vào <a href='{$link_reset}'>Đây</a> để thiết lập lại mật khẩu</p>
                           <
                           <p>Nếu không phải yêu cầu của bạn , bạn vui lòng bỏ qua email này</p>";
                           send_mail($email,'','Khôi phục mật khẩu PHP Master',$content);
                       }else{
                           $error['email']="Email Không tồn tại trên hệ thống";
                       }
                   }
                   
               }
               load_view('reset');
       }
}
function newpassAction(){
   
}
function info_accountAction() {
    load('helper','image');
    global $error,$fullname,$address,$email,$phone,$address,$email,$data,$avatar;
    if(isset($_POST['btn-update'])){
        $data = array();
        $error =array();
        if(empty($_POST['fullname'])){
            $error['fullname'] = "Bạn cần nhập họ tên"; 
        }else{     
                $fullname = $_POST['fullname'];  
                $data['fullname'] =$fullname; 
        }
        if(empty($_POST['phone_number'])){ 
            $error['phone_number'] = "Bạn cần nhập số phone"; 
        }else{
            if(!is_phone($_POST['phone_number'])){
                $error['phone_number']='SỐ điện thoại phải bắt đầu từ sô 0';
            }else{
                $phone = $_POST['phone_number'];
                $data['phone_number'] =$phone; 
            }
        }
        if(empty($_POST['email'])){
            $error['email'] = "Bạn cần nhập email"; 
        }
        else{
            $email = $_POST['email'];
            $data['email'] =$email; 
        }
        if(empty($_POST['address'])){
                $error['address'] = "Bạn cần nhập địa chỉ"; 
            }
            else{
                $address = $_POST['address'];
                $data['address'] =$address; 
            }
             // check upload file
        if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
            if($_FILES["file"]["name"]!=NULL)
{

                if($_FILES["file"]["type"]=="image/jpeg"
                ||$_FILES["file"]["type"]=="image/png"
                ||$_FILES["file"]["type"]=="image/gif"
                            )
                {
                if($_FILES["file"]["size"]>1048576)
                {
                echo "file quá nang";
                }

                // kiem tra su ton tai cua file
                elseif (file_exists("" . $_FILES["file"]["name"])) 
                {
                echo $_FILES["file"]["name"]." file da ton tai. ";
                }

                else{

                $path = "public/images/upload/admins/"; // file luu vào thu muc chua file upload
                $tmp_name = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $type = $_FILES['file']['type']; 
                $size = $_FILES['file']['size']; 
                // Upload file
                move_uploaded_file($tmp_name,$path.$name);
                $avatar = $path.$name;
                $data['file'] =$avatar; 
                }
                }
                else {
               $error['avatar']=  "file duoc chon khong hop le";
                }
                }
                else 
                {
                $error['avatar']=  "vui long chon file";
                }
        } 
   
        if(empty($error)){
        
             update_user_logins(user_login(),$data);
             $error['upload'] = "Cập nhật thành công";
        }
    }  
    $info_user = get_user_by_username(user_login());
     $data['info_user'] = $info_user;
    load_view('info_account',$data);
}
