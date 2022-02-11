<?php
get_header();

$data['info_user']=$info_user;
?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=admins&action=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php
        get_sidebar('users');
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="fullname">Tên hiển thị</label>
                        <input type="text" name="fullname" id="fullname" value="<?php if(!empty($info_user['fullname'])){ echo $info_user['fullname'];}?>">
                        <?php echo form_error('fullname'); ?>
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" placeholder="<?php if(!empty($info_user['username'])){ echo $info_user['username'];}?>" readonly="readonly">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php if(!empty($info_user['email'])){ echo $info_user['email'];} ?>">
                        <?php echo form_error('email'); ?>
                        <label for="phone_number">Số điện thoại</label>
                        <?php echo form_error('phone_number'); ?>
                        <input type="tel" name="phone_number" id="phone_number" value="<?php if(!empty($info_user['phone_number'])){ echo '0'.$info_user['phone_number'];} ?>">
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"><?php if(!empty($info_user['address'])){ echo $info_user['address'];} ?></textarea>
                        <label for="role">Ảnh đại diện</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <img id="upload-image" src="<?php if(!empty($info_user['file'])){ echo $info_user['file'];} ?>">
                        </div>
                        <?php echo form_error('avatar'); ?>
                        <?php echo form_error('upload'); ?>
                        <button type="submit" name="btn-update" id="btn-update">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>