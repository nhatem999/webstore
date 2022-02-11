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
        <h1>MẬT KHẨU MỚI</h1>
        <form action="" method="POST">
            <input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>" placeholder="New password"
                value=""> <br>

            <input type="submit" name="btn-new-pass" value="Lưu" id="btn-new-pass"><br>
            <?php echo form_error('password'); ?>
     
        </form>
        <a href="<?php echo base_url("?mod=login&action=login");?>">Đăng nhập</a><br>
        <a href="<?php echo base_url("?mod=login&action=reg"); ?>">Đăng ký</a>
    </div>

</body>

</html>