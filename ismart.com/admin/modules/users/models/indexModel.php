<?php
function get_user_by_username($username) {
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    if(!empty($item)){
        return $item;
    }
    
   
}
function get_info_admin($field, $admin_id){
    $info_admin_id = db_fetch_row("SELECT `$field` FROM `tbl_users` WHERE `user_id` = '{$admin_id}'");
    return  $info_admin_id[$field];
}
function get_list_users() {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}
function add_pages($data){
    return db_insert('tbl_pages' ,$data);
}
function add_user($data){
    return db_insert('tbl_users' ,$data);
}
function user_exists($username , $email){
    $check_user = db_num_rows("SELECT * FROM `tbl_users` WHERE `email`= '{$email}' OR `username`= '{$username}'");
    echo $check_user;
    if($check_user > 0)
        return true;
    return false;
}
function get_user_by_id($id){
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}

function active_user($active_token){
    db_update('tbl_users',array('is_active'=> 1),"`active_token`='{$active_token}'");
}
function check_active_token($active_token){
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `active_token`= '{$active_token}' AND `is_active`='0'");
    echo $check;
    if($check > 0)
        return true;
    return false;
}
function check_email($email){
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `email`= '{$email}'");
  
    if($check > 0)
        return true;
    return false;
}
function check_reset_token($reset_token){
    
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `reset_token`= '{$reset_token}'");

    if($check > 0)
        return true;
    return false;
}
function update_reset_token($data,$email){
    db_update('tbl_users',$data,"`email` = '{$email}'");
}
function update_pass($data,$reset_token){
    db_update('tbl_users',$data,"`reset_token`='{$reset_token}'");
}
function  update_user_logins($username,$data){
    db_update('tbl_users',$data,"`username` = '{$username}'");
}
function update_password($username,$data){
    db_update('tbl_users',$data,"`username` = '{$username}'");
}

function get_admin_info($username){
    $item = db_fetch_row(" SELECT * FROM `tbl_users` WHERE `username` = {$username}");
    return $item;
}
function update_admin($data, $admin_id){ 
    db_update('tbl_users', $data, "`user_id`='{$admin_id}'");
}
function delete_admin($admin_id){
    db_delete('tbl_users', "`user_id` = '{$admin_id}'");
}