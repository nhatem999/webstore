<?php

function construct() {
    load_model('index');
    load('lib','validation');
    load('helper','url');
    load('lib','email');
  
}

function indexAction() {
    
    $list_user = get_list_users();
    $data['list_user'] = $list_user;
    load_view('index',$data);
    
}
function regAction() {
    global $error ,$username ,$password , $email, $fullname,$config;
    if(isset($_POST['btn-reg'])){
        $error = array();
        if(empty($_POST['fullname'])){
            $error['fullname']="Ban can nhap ho ten";
        }
        else{
            $fullname=$_POST['fullname'];
        }
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
        if(empty($_POST['username'])){
            $error['username'] = "Bạn cần nhập tài khoản";
        }else{
            if(!is_username($_POST['username'])){
                $error['username']= "Tài khoản không đúng định dạng";
            }
            else{
                $username = $_POST['username'];
            }
            
        }
   
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
           if(!user_exists($username,$email)){
               $content = "";
               $active_token = md5($username.time());
               $data = array(
                   'fullname' =>$fullname,
                   'username' => $username,
                   'password' => $password,
                   'email' =>  $email,
                   'active_token' => $active_token,
                   'reg_date'=> time(),
               );
               add_user($data);
               $link_active = base_url("?mod=login&action=active&active_token={$active_token}");
               $content = " <p>Bạn vui lòng nhấp vào đây để kích hoạt tài khoản:{$link_active}</p> ";
               echo send_mail('hoangvuminhnhat1@gmail.com','Hoàng VŨ Minh Nhật','Kích hoạt tài khoản', $content);
               redirect("?mod=login&action=login");
           }else{
               $error['account'] = "Email hoặc username đã tồn tại trên hệ thông";
           }

       }
        
    }
    load_view('reg');
}

function loginAction() {
    load_view('index');
 
}
function activeAction(){
    $active_token = $_GET['active_token'];
    if(check_active_token($active_token)){
        active_user($active_token);
        $link_logins = base_url('?mod=login&action=login');
        echo "Bạn đã kích hoạt thành công, Vui lòng bấm vào đây để <a href='{$link_logins}'>Đăng Nhập</a>";
    }else{
        echo "Yêu cầu kích hoạt không thành công hoặc tài khoản đã được kích hoạt trước đó";
    }
    
}
function resetAction() {
   
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

function logoutAction() {
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=login&action=login");
}
function resetOKAction() {
    load_view('resetOK');
}