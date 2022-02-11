<?php

function get_list_users() {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}
function update_user($id,$data) {
    // $data = array();
    $users = db_update("tbl_users",$data," `user_id`={$id}");
    return $users;
}
function delete_user($id,$data){
    $uses = db_delete("tbl_users",$data, "`user_id` = '{$id}'");
}

