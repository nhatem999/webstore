<?php
function is_username($username){
  
    $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
    if(!preg_match($partten,$username,$matchs)){
      return false;
    }
    return true;
}
function is_phone($phone) {
    $partten = "/^(09|08|01[2|6|8|9])+([0-9]{8})$/";
            if(!preg_match($partten, $_POST['phone_number'],$matchs)){
                return false;
            }
            return true;
        }
function is_fullname($fullname) {
    $partten = "/^[A-Za]{6,32}$/";
    if(!preg_match($partten,$_POST['fullname'],$matches))
        return false;
    return true;    
}
function is_number($number) {
    $pattern = "/^[0-9]*$/";
    if(preg_match($pattern,$number,$matches)) return true;
    return false;
}
function check_role($username) {
    $result = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $result['role'];
}

function is_password($password){
    
    $partten = "/^[A-Z]{1}([\w_\.!@#$%^&*()]+){5,31}$/";
    if(!preg_match($partten,$password,$matchs)){
        return false;
    }
    return true;
}
function is_email($email){

   if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       return false;
   }
   return true;
}
function check_login($username, $password){
    $list_user = get_list_users();
    foreach ($list_user as $user){
        if($username == $user["username"] && md5($password) == $user["password"]){
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


function get_user_admin($username) {
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    if(!empty($item)){
        return $item;
    }
    
   
}

// Trả về username của người login
function user_login() {
    if(!empty($_SESSION['user_login']))
        return $_SESSION['user_login'];
    return false;
}


function info_user($field='id') {
    $list_user = get_list_users();
    if(isset($_SESSION['is_login'])){
        foreach($list_user as $user){
            if($_SESSION['user_login']==$user['username']){
                if(array_key_exists($field,$user)){
                    echo $user[$field];
                }
            }
        }        
    }
    return false;
}

function form_error($lable_field){
    global $error;
    if(!empty($error[$lable_field])) 
    return "<p class='error'>{$error[$lable_field]}</p>";

}
function set_value($lable_field){
    global $$lable_field;
    if(!empty($lable_field)) return $$lable_field;
}
function is_image($file_type, $file_size) {

    $type_allow = array('png', 'jpg', 'gif', 'jpeg');

    if (!in_array(strtolower($file_type), $type_allow)) {
        return false;
    } else {
        if ($file_size > 21000000) {
            return false;
        }
    }
    return true;
}

function get_user($start =1 , $num_per_page = 10 ,$where = ""){
    if(!empty($where))
         $where = "WHERE {$where}";
    $list_admin =db_fetch_array("SELECT * FROM `tbl_users` {$where} LIMIT {$start},{$num_per_page} ");
    return $list_admin;
}

    function get_pagging($num_pages,$page, $base_url ="") {
        $str_pagging ="<ul class='pagging' id='list-paging'>";
        if($page > 1){
            $page_prev = $page - 1;
            $str_pagging .=" <li><a href=\"{$base_url}&page={$page_prev}\">Trước</a></li>";
        }
        for($i=1; $i<=$num_pages; $i++) {
            $active = "";
            if($i == $page){
                $active="Class='active'";
            }
            $str_pagging .= "  <li $active><a href=\"{$base_url}&page={$i}\">{$i}</a></li>";
        }
        if($page < $num_pages){
            $page_next = $page + 1;
            $str_pagging .=" <li><a href=\"{$base_url}&page={$page_next}\">Sau</a></li>";
        }
        $str_pagging .="</ul>";
        return $str_pagging;
    }