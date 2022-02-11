<?php global $success;?>
<?php get_header(); ?>
<div id="main-content-wp" class="change-pass-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
    <?php get_sidebar('users'); ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                    <p class="success-pass"><?php if(!empty($success)){
                            echo($success['pass']);
                        }?></p><?php
                       
                            echo form_error('reset-pass');
                        
                        ?>
                        <label for="old-pass">Mật khẩu cũ</label>
                        <input type="password" name="pass-old" id="pass-old" value="<?php if(!empty($_POST['pass-old'])) echo $_POST['pass-old']; ?>">
                        <?php echo form_error('password'); ?>
                        <label for="new-pass">Mật khẩu mới</label>
                        <input type="password" name="new-pass" id="new-pass" value="<?php if(!empty($_POST['new-pass'])) echo $_POST['new-pass']; ?>">
                        <?php echo form_error('new-password'); ?>
                        <label for="confirm-pass">Xác nhận mật khẩu</label>
                        <input type="password" name="confirm-pass" id="confirm-pass" value="<?php if(!empty($_POST['confirm-pass'])) echo $_POST['confirm-pass']; ?>">
                        <?php echo form_error('confirm-password'); ?>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>