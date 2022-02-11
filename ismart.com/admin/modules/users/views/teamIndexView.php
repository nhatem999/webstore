<?php get_header();
     $list_adminn = db_fetch_array("SELECT * FROM `tbl_users`");
    // show_array($list_adminn);
    # SỐ bản ghi / trang 
    $num_per_page = 3;
    # Tổng số bản ghi
    $total_row =  db_num_rows("SELECT * FROM `tbl_users`  ");
    # So trang 
    $num_page = ceil($total_row/$num_per_page);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    // Trang bắt đầu
    $start = ($page - 1) * $num_per_page;

    $list_admin = get_user($start,$num_per_page,"");
   

?>
<div id="main-content-wp" class="list-post-page">
<div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users&controller=team&action=addcat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Nhóm quản trị</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">

            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(10)</span></a> |</li>
                            <li class="publish"><a href="">Đã đăng <span class="count">(5)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt <span class="count">(5)</span></a></li>
                            <li class="trash"><a href="">Thùng rác <span class="count">(0)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="GET" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Chỉnh sửa</option>
                                <option value="2">Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Ảnh đại diện</span></td>
                                    <td><span class="thead-text">Tên đăng nhập</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Email</span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                    <td><span class="thead-text">Ngày đăng ký</span></td>
                                    <td><span class="thead-text">Phân quyền</span></td>
                                </tr>
                            </thead>
                            <tbody> <?php 
                                $temp=0;
                                    foreach($list_admin as $admin){
                                        $temp++;
                                        ?>
                                <tr>
                               

                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <img src="<?php if(!empty($admin['file'])) echo $admin['file'];?>" alt="" class="thumb-admin">
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=users&controller=team&action=update&admin_id=<?php echo $admin['user_id'];?>" Update title="Sửa" class="edit"><i class="fa fa-pencil"
                                                        aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=users&controller=team&action=delete_admin&admin_id=<?php echo $admin['user_id']?>" title="Xóa" class="delete"><i class="fa fa-trash"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><a href="?mod=users&controller=team&action=update&admin_id=<?php echo $admin['user_id'];?>"><span class="tbody-text"><?php echo $admin['username'] ; ?></span></a></td>
                                    <td><span class="tbody-text"><?php echo $admin['fullname'] ; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $admin['email'] ; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $admin['address'] ; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $admin['created_date'] ; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $admin['role'] ; ?></span></td>
                                </tr>
                                        <?php
                                    }
                                ?>
                                    
                                
                            </tbody>
                           
                        </table>
                    </div>

                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                  <?php echo get_pagging($num_page,$page,"?mod=users&controller=team&action=index") ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>