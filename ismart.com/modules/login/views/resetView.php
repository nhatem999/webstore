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
        <h1>Khôi phục mật khẩu </h1>
        <form action="" method="POST">
            <input type="text" name="email" id="email" placeholder="Email"
                value=""> <br>

            <input type="submit" name="btn-reset" value="Gửi yêu cầu" id="btn-login"><br>
            <?php echo form_error('email'); ?>
     
        </form>
        <a href="<?php echo base_url("?mod=login&action=login");?>">Đăng nhập</a><br>
        <a href="<?php echo base_url("?mod=login&action=reg"); ?>">Đăng ký</a>
    </div>

</body>

</html>