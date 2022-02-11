<?php global $alert;?>
<?php get_header(); ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar('users'); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm người quản trị</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                <p class="alert"> <?php if(!empty($alert['creat_admin'])){
                        echo $alert['creat_admin'];
                    } ?></p>
                   
                    <form method="POST" enctype="multipart/form-data">
                        <label for="fullname">Tên hiển thị</label>
                        <input type="text" name="fullname" id="fullname" placeholder="">
                        <?php echo form_error('fullname'); ?>
                        <label for="Username">Tên đăng nhập</label>
                        <input type="text" name="Username" id="Username" placeholder="">
                        <?php echo form_error('username'); ?>
                        <label for="password">Mật khẩu</label>
                        <input type="password" name="password" id="password" placeholder="">
                        <?php echo form_error('password'); ?>
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" >
                        <?php echo form_error('email'); ?>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img  src="public/images/<?php if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){ echo 'upload/admins/'.$_FILES['file']['name'];} else{ echo 'img-thumb.png';}?>">
                        </div>
                        <?php echo form_error('upload_image')?>
                        <label>Phân quyền</label>
                        <select name="role">
                            <option value="">--Chọn--</option>
                            <option <?php if(!empty($_POST['role']) && $_POST['role'] == '1') echo "selected='selected'"; ?> value="1">1</option>
                            <option <?php if(!empty($_POST['role']) && $_POST['role'] == '2') echo "selected='selected'"; ?> value="2">2</option>
                            <option <?php if(!empty($_POST['role']) && $_POST['role'] == '3') echo "selected='selected'"; ?> value="3">3</option>
                        </select>
                        <button type="submit" name="btn-add-admin" id="btn-add-admin">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>