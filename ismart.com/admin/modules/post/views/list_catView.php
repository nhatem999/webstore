
<?php get_header();
 $data_post_cat = db_fetch_array('SELECT* FROM `tbl_post_cat`');
 $list_post_cat_all = data_tree($data_post_cat, 0);
    // $cat_id = db_num_rows("SELECT `parent_id` FROM `tbl_post_cat`");
    $num_per_page = 10;
    # Tổng số bản ghi
    $total_row =  db_num_rows("SELECT * FROM `tbl_post_cat` ");
    # So trang 
    $num_page = ceil($total_row/$num_per_page);
    // echo $total_row . $num_page;
    $pages = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    // Trang bắt đầu
    $start = ($pages - 1) * $num_per_page;
    $list_post_cat = array_slice($list_post_cat_all, $start, $num_per_page);
    
    // $list_page = get_cat($start,$num_per_page,"");
?>
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách danh mục</h3>
                    <a href="?mod=post&controller=post_cat&action=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                               
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <?php if (!empty($list_post_cat_all)) {
                                 $num_order = array();
                                 $order = 0;
                                    foreach($list_post_cat_all as $post_cat_all){
                                        $order++;
                                        $num_order['num_order'] =  $order;
                                        update_cat($num_order, $post_cat_all['cat_id']);
                                    }
                                    ?>
                                <tbody>
                                <?php foreach ($list_post_cat as $post_cat) {
                                   
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $post_cat['cat_id'] ?>"></td>
                                            <td><span class="tbody-text"><?php echo $post_cat['num_order']?></h3></span>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo str_repeat('--', $post_cat['level']).' '.$post_cat['title']?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=post&controller=post_cat&action=update_cat&cat_id=<?php echo $post_cat['cat_id']?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=post&controller=post_cat&action=delete_cat&cat_id=<?php echo $post_cat['cat_id']?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>

                                            <td><span class="tbody-text "><?php echo $post_cat['cat_status']?></span></td>
                                            <td><span class="tbody-text"><?php echo $post_cat['creator']?></span></td>
                                            <td><span class="tbody-text"><?php echo $post_cat['created_date']?></span></td>
                                     
                                        </tr>
                                        <?php
                                    }}
                                    ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <?php echo get_pagging($num_page,$pages,"?mod=post&controller=index&action=list_cat") ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>