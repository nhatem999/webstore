<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('helper','url');
}

function indexAction() {
    echo "helo";
   
}

function addAction() {
    echo "Thêm dữ liệu";
}

function editAction() {
    $id = (int)$_GET['id'];
     $items = get_user_by_id($id);
     $data['items'] = $items;
    echo "Thêm dữ liệu";
   load_view('edit',$data); //
    // show_array($item);
}
function deleteAction() {
    $id = (int)$_GET['id'];
    $item = get_user_by_id($id);
    db_delete("tbl_users", "`user_id`='{$id}'");
     redirect(base_url("?mod=home&controller=index"));
    
}