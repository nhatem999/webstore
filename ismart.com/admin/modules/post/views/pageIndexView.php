
<?php get_header(); 
    // $list_page = db_fetch_array("SELECT * FROM `tbl_pages`");
    $num_per_page = 3;
    # Tổng số bản ghi
    $total_row =  db_num_rows("SELECT * FROM `tbl_pages` ");
    # So trang 
    $num_page = ceil($total_row/$num_per_page);
    // echo $total_row . $num_page;
    $pages = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    // Trang bắt đầu
    $start = ($pages - 1) * $num_per_page;

    $list_page = get_page($start,$num_per_page,"");
   

?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">           
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách trang</h3>
                    <a href="?page=add_page" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>            
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(10)</span></a> |</li>
                            <li class="publish"><a href="">Đã đăng <span class="count">(5)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt <span class="count">(5)</span> |</a></li>
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
                                <option value="1">Công khai</option>
                                <option value="1">Chờ duyệt</option>
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
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $temp = 0;
                                if(!empty($list_page)){
                                    foreach ($list_page as $page) {
                                        $temp++;
                                ?>
                                  <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="?mod=pages&$controller=index&action=update_page&id=<?php echo $page['page_id']; ?>" title=""><?php if(!empty($page['title'])) echo $page['title']; ?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=pages&$controller=index&action=update_page&id=<?php echo $page['page_id']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=pages&$controller=index&action=delete_page&id=<?php echo $page['page_id']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"><?php echo $page['category']; ?></span></td>
                                    <td><span class="tbody-text">Hoạt động</span></td>
                                    <td><span class="tbody-text"><?php echo $page['creator']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $page['created_date']; ?></span></td>
                                </tr>
                                <?php
                                    }
                                }
                                    
                                ?>
                              
                               
                            </tbody>
                           
                        </table>
                    </div>
                    <i>Chọn vào checkbox để chọn tất cả</i>

                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                <?php echo get_pagging($num_per_page,$pages,"?mod=pages&controller=index&action=index") ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>