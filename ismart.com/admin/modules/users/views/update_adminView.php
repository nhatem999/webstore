<?php 
    global $error;
    //  show_array($error);
    if(isset($_GET['admin_id'])){
        $admin_id = $_GET['admin_id'];
        $role = get_info_admin('role', $admin_id);
        $avatar = get_info_admin('file', $admin_id);
       
    }
?>
<?php get_header(); ?>
<div id="main-content-wp" class="info-account-page">
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
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="fullname">Tên hiển thị</label>
                        <input type="text" name="fullname" id="fullname" value="<?php echo get_info_admin('fullname', $admin_id) ?>" placeholder="">
                        <?php echo form_error('fullname');?>
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" placeholder="<?php echo get_info_admin('username', $admin_id) ?>" readonly="readonly">
                        <?php echo form_error('username');?>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo get_info_admin('email', $admin_id) ?>">
                        <?php echo form_error('email');?>
                        <label for="phone_number">Số điện thoại</label>
                        <input type="tel" name="phone_number" id="phone_number" value="<?php get_info_admin('phone_number', $admin_id) ?>">
                        <?php echo form_error('phone_number');?>
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" id="address" value="<?php echo get_info_admin('address', $admin_id) ?>">
                        <label for="role">Ảnh đại diện</label>
                        <?php echo form_error('address');?>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <img id="upload-image" src="<?php if(!empty($avatar)){ echo $avatar;} else{ echo 'public/images/img-thumb.png';} ?>">
                        </div>
                        <?php echo form_error('upload_image');?>
                        <label for="role">Phân quyền</label>
                        <select name = 'role'>
                            <option value="">--Chọn--</option>
                            <option <?php if(isset($role) && $role == '1') echo "selected='selected'"; ?> value="1">1</option>
                            <option <?php if(isset($role) && $role == '2') echo "selected='selected'"; ?> value="2">2</option>
                            <option <?php if(isset($role) && $role == '3') echo "selected='selected'"; ?> value="3">3</option>
                        </select>
                        <?php echo form_error('role')?>
                        <button type="submit" name="btn-update-admin" id="btn-update-admin">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>