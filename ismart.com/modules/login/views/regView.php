
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Đăng Ký tài khoản</title>
                <link rel="stylesheet" href="public/css/login.css">
                <link rel="stylesheet" href="public/css/reset.css">
            </head>

            <body>
                <div id="wp-form-login">
                    <h1>Đăng ký tài khoản</h1>
                    <form action="" method="POST">
                        <input type="text" name="fullname" id="fullname" placeholder="Fullname"
                            value="<?php echo set_value('fullname'); ?>">
                        <?php echo form_error('fullname'); ?>
                        <input type="text" name="username" id="username" placeholder="Username"
                            value="<?php echo set_value('username'); ?>"> 
                        <?php echo form_error('username'); ?>
                        <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" placeholder="email"
                            >
                        <?php echo form_error('email'); ?>
                        <input type="password" name="password" id="password" placeholder="Password">
                        <?php echo form_error('password'); ?>
                        <input type="submit" name="btn-reg" value="Đăng ký" id="btn-reg">
                        <?php echo form_error('account'); ?>
                    </form>
                    <a href="<?php echo base_url("?mod=login&action=login"); ?>" id="lost-pass">Đăng nhập</a>
                 
                </div>

            </body>



</html>