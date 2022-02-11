<?php
//===========
//  slider
//===========
# update slider
function update_slider($data, $slider_id){
    db_update('tbl_sliders', $data, "`slider_id`='{$slider_id}'");
}
# delete slider
function delete_slider($slider_id) {
    db_delete("tbl_sliders", "`slider_id` = {$slider_id}");
}
# get info slider
function get_info_slider($field, $slider_id){
    $info_slider = db_fetch_row("SELECT `$field` FROM `tbl_sliders` WHERE `slider_id` = '{$slider_id}'");
    if(!empty($info_slider)){
        return  $info_slider[$field];
    }
}
# show payment
function show_payment($data){
    if($data == 1){
        $data = 'Thanh toán tại nhà';
        return $data;
    } else if($data == 2){
        $data = 'Thanh toán ngân hàng';
        return $data;
    }
}
# show status
function show_status_active($data){
    if($data == 1){
        $data = 'Approved';
        return $data;
    } else if($data == 2){
        $data = 'Waitting...';
        return $data;
    } else{
        $data = 'Trash';
        return $data;
    }
}
//=============
//ADD SLIDER
//=============
function add_slider($data){
    db_insert("tbl_sliders", $data);
}
//==============
// PHÂN TRANG
//==============
function get_sliders($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $list_sliders = db_fetch_array("SELECT* FROM `tbl_sliders` {$where} LIMIT {$start}, {$num_per_page}");
    return $list_sliders;
} 
function is_exists($table, $key, $value) {
    $check = db_num_rows("SELECT * FROM `{$table}` WHERE `{$key}` = '{$value}'");
    if ($check > 0) {
        return true;
    }
    return false;
}
function get_admin_info($username){
    $item = db_fetch_row(" SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $item;
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
function get_page($start =1 , $num_per_page = 10 ,$where = ""){
    if(!empty($where))
         $where = "WHERE {$where}";
    $list_page =db_fetch_array("SELECT * FROM `tbl_sliders` {$where} LIMIT {$start},{$num_per_page} ");
    return $list_page;
}