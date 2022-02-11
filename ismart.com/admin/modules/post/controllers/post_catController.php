<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib','validation');
    load('helper','url');
    load('helper','slug');
    
}
function add_catAction() {
 
    global $title,$error,$slug,$parent;
    if(isset($_POST['btn-submit'])){
        
        $error = array();

        if(empty($_POST['title'])){     
            $error['title'] = '(*) Bạn cần nhập danh mục';
        } else{
            if(is_exists('tbl_post_cat', 'title', $_POST['title'])){
                $error['title'] = '(*) Danh mục bài viết đã tồn tại';
            } else{
                $title = $_POST['title'];
            }
        }
        if(empty($_POST['slug'])){     
            $error['slug'] = '(*) Bạn chưa nhập slug';
        } else{
            if(is_exists('tbl_post_cat', 'slug', $_POST['slug'])){
                $error['slug'] = '(*) Slug đã tồn tại';
            } else{
                $slug =create_slug ($_POST['slug']);
            }
        }
        if(empty($_POST['parent-cat'])){     
            $error['parent-cat'] = '(*) Bạn chưa chọn danh mục cha';
        } else{
            $parent = $_POST['parent-cat'];
        }   
        
        if(empty($error)){
            $creator = user_login();
            $cat_status = 'Approved';
            $data = array(
                'cat_status' => $cat_status,
                'title' => $title,
                'slug' => $slug,
                'parent_id' => $parent,
                'creator' => $creator,
                'created_date'=> date('d/m/y h:m'),
            );
            add_cat('tbl_post_cat',$data);
            $error['add_cat'] = "Thêm danh mục thành công";
        }

    }
    load_view('add_cat');
}  
function update_catAction() {
    global $title,$error,$slug,$parent;
    if(isset($_POST['btn-submit'])){
        $cat_id = $_GET['cat_id'];
        $error = array();

        if(empty($_POST['title'])){     
            $error['title'] = '(*) Bạn cần nhập danh mục';
        } else{
            if(is_exists('tbl_post_cat', 'title', $_POST['title'])){
                $error['title'] = '(*) Danh mục bài viết đã tồn tại';
            } else{
                $title = $_POST['title'];
            }
        }
        if(empty($_POST['slug'])){     
            $error['slug'] = '(*) Bạn chưa nhập slug';
        } else{
            if(is_exists('tbl_post_cat', 'slug', $_POST['slug'])){
                $error['slug'] = '(*) Slug đã tồn tại';
            } else{
                $slug =create_slug ($_POST['slug']);
            }
        }
        if(empty($_POST['parent-cat'])){     
            $error['parent-cat'] = '(*) Bạn chưa chọn danh mục cha';
        } else{
            $parent = $_POST['parent-cat'];
        }   
        
        if(empty($error)){
            $creator = user_login();
            $cat_status = 'Approved';
            $data = array(
                'cat_status' => $cat_status,
                'title' => $title,
                'slug' => $slug,
                'parent_id' => $parent,
                'creator' => $creator,
                'created_date'=> date('d/m/y h:m'),
            );
            update_cat($data,$cat_id);
            $error['add_cat'] = "Thêm danh mục thành công";
        }

    }
    load_view('update_cat');
}


?>