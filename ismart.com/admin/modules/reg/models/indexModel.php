<?php

function get_list_users() {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function check_login($username, $password){
    $item = get_list_users();
    foreach($item as $user){
             if($username == $user["username"] && ($password) == $user["password"]){
            return true;
        }
    }
    return false;
    }
    

// Trả về true nếu đã login
function is_login() {
    
    if(isset($_SESSION['is_login']))
        return true;
    return false;
}

// Trả về username của người login

function user_login() {
    if(!empty($_SESSION['user_login']))
        return $_SESSION['user_login'];
    return false;
}


