<?php global $error,$username,$password;
// show_array($error);
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
       

    </div>

</body>

</html>