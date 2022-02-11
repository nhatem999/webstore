<?php
    get_header();
?>
<?php if(isset($_POST['btn_update'])){
        $error =array();//Phất cờ
        // Kiểm tra fullname
    if(empty($_POST['fullname'])){
        $error['fullname']="Không được để trống họ tên";

    }  else{
        $fullname = $_POST['fullname'];     
    }
    if(empty($_POST['gender'])){
        $error['gender']="Không được để trống giới tính";

    }  else{
        $gender = $_POST['gender'];     
    }
  
    if(empty($error)){
        $data = array(
            'fullname' => $fullname,
            'gender' => $gender,
        );
        // db_update("tbl_users",$data," `user_id`=$id");
        update_user($items['user_id'],$data);
        // show_array($items);
    }
    // $items=db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id`=$id");


}
?>
<div id="content">
    <?php
    // show_array($items);
   ?>
    <h1>Cập nhật</h1>
    <form action="" method="POST">
        <label for="fullname">Họ và tên</label><br>
        <input type="text" name="fullname" id="fullname" value="<?php if(!empty($items['fullname'])) echo $items['fullname'];?>">
    
        <select name="gender" id="">
        <option value="">---Chọn giới tính---</option>
            <option <?php if(isset($items['gender']) && $items['gender']=='male') echo "selected='selected'";?> value="male" >Male</option>
            <option <?php if(isset($items['gender']) && $items['gender']=='female') echo "selected='selected'";?> value="female">Female</option>
        </select>
 
        <input type="submit" name="btn_update" value="Cập nhật" id="btn-update">
    </form>
   
</div>
<?php
    get_footer();
?>