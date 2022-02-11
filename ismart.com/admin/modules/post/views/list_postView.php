<?php get_header();

    $list_post = list_post();
    $total_post = total_row('tbl_post');
    $status_approved = total_status('tbl_post','Approved');
    $status_watting = total_status('tbl_post','Waitting ...');
    // show_array($list_post);
       // $list_page = db_fetch_array("SELECT * FROM `tbl_pages`");
       $num_per_page = 5;
       # Tổng số bản ghi
       $total_row =  db_num_rows("SELECT * FROM `tbl_post` ");
      
       # So trang 
       $num_page = ceil($total_row/$num_per_page);
      
       // echo $total_row . $num_page;
       $pages = isset($_GET['page']) ? (int)$_GET['page'] : 1;
       // Trang bắt đầu
       $start = ($pages - 1) * $num_per_page;
       
       $list_post = get_post($start,$num_per_page,"");
    //    if(isset($_POST['btn-action'])){
    //    show_array($_POST['checkItem']);
    //    }
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách bài viết</h3>
                    <a href="?mod=post&controller=index&action=add_post" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class=""><a href="?mod=post&controller=index&action=list_post">Tất cả <span class="count">(<?php echo $total_post;?>)</span></a> |</li>
                            <li class=""><a href="?mod=post&controller=index&action=list_post&status=approved">Đã đăng <span class="count">(<?php echo $status_approved;?>)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt <span class="count">(<?php echo $status_watting;?>)</span></a></li>
                            <li class="trash"><a href="">Thùng rác <span class="count">(0)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <form method="POST" >
                    <div class="actions" class="form-actions">
                        
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option <?php if (isset($_POST['actions']) && $_POST['actions'] == 1) echo "selected='selected'"; ?> value="1">Công khai</option>
                                <option <?php if (isset($_POST['actions']) && $_POST['actions'] == 2) echo "selected='selected'"; ?> value="2">Chờ duyệt</option>
                                <option <?php if (isset($_POST['actions']) && $_POST['actions'] == 3) echo "selected='selected'"; ?> value="3">Bỏ vào thủng rác</option>
                            </select>
                            <button type="submit" name="btn-action" id="btn-action">Áp dụng</button>
 
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($list_post)){
                                // $status = $_GET['status'];
                                $temp=$start;
                                foreach($list_post as $item){
                            
                                    $temp++;
                                    ?>
                                    <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $item['post_id'];?>"></td>
                                    <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo $item['title']; ?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=post&controller=index&action=update_post&post_id=<?php echo $item['post_id'] ;?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=post&controller=index&action=delete_post&post_id=<?php echo $item['post_id'] ;?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"><?php echo  $item['post_status']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo  $item['parent_cat']; ?></span></td>
                                    
                                    <td><span class="tbody-text"><?php echo $item['creator']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $item['created_date']; ?></span></td>
                                </tr>
                                    <?php
                                }
                            } ?>
                                
                                
                            </tbody>
                           
                        </table>
                    </div>
                    </form>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                <?php echo get_pagging($num_page,$pages,"?mod=post&controller=index&action=list_post") ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>