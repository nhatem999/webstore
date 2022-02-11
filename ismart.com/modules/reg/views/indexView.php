<?php
   
    if(isset($_POST['btn-login'])){
        $error = array();
        if(empty($_POST['username'])){
            $error['username'] = "Bạn cần nhập tài khoản";
        }else{
            $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
            if(!preg_match($partten,$_POST['username'],$matchs)){
                $error['username'] ="Tên đăng nhập không đúng định dạng";
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
            $password = $_POST['password'];

        }
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
               redirect(base_url("?mod=home&controller=index")) ;
            }
            else{
                echo "Đăng nhập thất bại";
            }  
                }      
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống điều hướng cơ bản</title>
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="stylesheet" href="public/css/reset.css">
</head>

<body>
    <div id="wp-form-login">
        <h1>Đăng nhập</h1>
        <form action="" method="POST">
            <input type="text" name="username" id="username" placeholder="Username"
                value="<?php if(!empty($_POST["username"])) echo $username;?>"> <br>
            <?php   if(!empty($error['username'])){
                ?>
            <p class="error"> <?php echo $error['username']; ?> </p>
            <?php 
             }
         ?>
            <input type="password" name="password" id="password" placeholder="Password"><br>
            <?php   if(!empty($error['password'])){
                ?>
            <p class="error"> <?php echo $error['password']; ?> </p>
            <?php 
             }
         ?>
            <input type="checkbox" name="remember_me" id="remember_me">
            <label for="remember_me">Remember</label><br>
            <input type="submit" name="btn-login" value="Đăng nhập" id="btn-login"><br>
            <?php   if(!empty($error['account'])){
                ?>
            <p><?php echo $error['account']; ?></p>
            <?php }?>
        </form>
        <a href="">Quên mật khẩu</a>
    </div>

</body>

</html>