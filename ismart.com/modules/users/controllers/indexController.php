<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction() {
    load('helper','format');
    $list_users = get_list_users();
    foreach($list_users as &$user){
        $user['url_update']="?mod=users&controller=users&action=edit&id={$user['user_id']}";
        $user['url_delete']="?mod=users&controller=users&action=delete&id={$user['user_id']}";
    }
    // show_array($list_users);
    $data['list_users'] = $list_users;
    load_view('index', $data);
}

function addAction() {
    echo "Thêm dữ liệu";
}

function updatetAction() {
    $id = (int)$_GET['id'];
    $item = get_user_by_id($id);
  //  load_view('index',$id); //
    // show_array($item);
}
