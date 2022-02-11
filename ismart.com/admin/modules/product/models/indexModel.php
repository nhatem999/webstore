<?php
function get_product($start =1 , $num_per_page = 5 ,$where = ""){
    if(!empty($where))
         $where = "WHERE {$where}";
    $list_page =db_fetch_array("SELECT * FROM `tbl_products` {$where} LIMIT {$start},{$num_per_page} ");
    return $list_page;
}
// get info product
function get_info_product($types,$product_id){
    $info_product_id = db_fetch_row("SELECT {$types} FROM `tbl_products` WHERE `product_id` = '{$product_id}'");
    if(!empty($info_product_id)){
        return  $info_product_id[$types];
    }
}
function update_product($data, $product_id){
    db_update('tbl_products', $data, "`product_id` = '{$product_id}'");
}
function get_products($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $list_productss = db_fetch_array("SELECT* FROM `tbl_products` {$where} LIMIT {$start}, {$num_per_page}");
    return $list_productss;
} 
function get_info_user() {
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$_SESSION['user_login']}'");
    return $item;
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
function add_product($data) {
    db_insert('tbl_products', $data);
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
function get_admin_info($username){
    $item = db_fetch_row(" SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $item['username'];
}



function update_cat($data, $cat_id){
    db_update('tbl_produc_cat', $data, "`cat_id` = '{$cat_id}'");
}
function update_status($data, $field){
    db_update('tbl_post', $data, "`post_id`= '{$field}'");
}
function delete_status($data, $field){
    db_delete('tbl_post', $data, "`post_id`= '{$field}'");
}
function get_page($start =1 , $num_per_page = 10 ,$where = ""){
    if(!empty($where))
         $where = "WHERE {$where}";
    $list_page =db_fetch_array("SELECT * FROM `tbl_pages` {$where} LIMIT {$start},{$num_per_page} ");
    return $list_page;
}
function get_cat($start =1 , $num_per_page = 10 ,$where = ""){
    if(!empty($where))
         $where = "WHERE {$where}";
    $list_page =db_fetch_array("SELECT * FROM `tbl_post_cat` {$where} LIMIT {$start},{$num_per_page} ");
    return $list_page;
}
function get_post($start =1 , $num_per_page = 5 ,$where = ""){
    if(!empty($where))
         $where = "WHERE {$where}";
    $list_page =db_fetch_array("SELECT * FROM `tbl_post` {$where} LIMIT {$start},{$num_per_page} ");
    return $list_page;
}
function get_info_post_cat($field, $page_id){
    $info_page_id = db_fetch_row("SELECT `$field` FROM `tbl_post_cat` WHERE `cat_id` = '{$page_id}'");
    return  $info_page_id[$field];
}
function is_exists($table, $key, $value) {
    $check = db_num_rows("SELECT * FROM `{$table}` WHERE `{$key}` = '{$value}'");
    if ($check > 0) {
        return true;
    }
    return false;
}
function add_post($data) {
    db_insert('tbl_post', $data);
}
function update_post($data, $post_id){
    db_update('tbl_post', $data, "`post_id`='{$post_id}'");
}
function delete_post($post_id) {
    db_delete("tbl_post", "`post_id` = {$post_id}");
}

function list_cat($table){
    $item = db_fetch_array("SELECT * FROM `{$table}`");
    return $item;
}
function list_post(){
    $item = db_fetch_array("SELECT * FROM `tbl_post`");
    return $item;
}
function add_cat($table,$data) {
    db_insert($table, $data);
}
function total_row($table){
    $item = db_num_rows("SELECT * FROM `{$table}`");
    return $item;

}
function total_status($table,$field){
    $item = db_num_rows("SELECT * FROM `{$table}` WHERE `post_status` = '{$field}'");
    return $item;

}
# get_info_cat
function get_info_cat($field, $cat_id){
    $info_cat = db_fetch_row("SELECT `$field` FROM `tbl_post_cat` WHERE `cat_id` = '{$cat_id}'");
    return  $info_cat[$field];
}
function get_info_cat_parent($field, $cat){
    $info_cat = db_fetch_row("SELECT `$field` FROM `tbl_produc_cat` WHERE `title` = '{$cat}'");
    return  $info_cat[$field];
}
function get_info_post($field, $post_id){
    $info_post_id = db_fetch_row("SELECT `$field` FROM `tbl_post` WHERE `post_id` = '{$post_id}'");
    return  $info_post_id[$field];
}
function get_info_post_status($field, $where=""){
    if(!empty($where))
          $where = "WHERE {$where}";
    $list_post =db_fetch_array("SELECT * FROM `tbl_post` {$where} `post_status` = '{$field}' ");
    return $list_post;
   
}
function db_num_page($tbl, $record){
    global $conn;
    #Số lượng trang
    $sql = "SELECT* FROM $tbl";
    $num_rows = db_num_rows($sql);
    $num_page = ceil($num_rows / $record);
    # danh sách số thứ tự trang 1,2,3,4....
    $list_num_page = array();
    for ($i = 1; $i <= $num_page; $i++) {
        $list_num_page[] = $i;
    }
    return $list_num_page;
}
