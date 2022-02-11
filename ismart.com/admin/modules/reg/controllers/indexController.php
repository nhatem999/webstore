<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('helper','validation');
}

function indexAction() {
    
    $list_user = get_list_users();
    $data['list_user'] = $list_user;
    load('helper','url');
    load_view('index',$data);
    // show_array($list_user);
    


}

function addAction() {
 
}

function editAction() {

}
