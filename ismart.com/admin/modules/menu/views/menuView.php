<?php get_header(); ?>
<?php
    $list_products = db_fetch_array("SELECT * FROM `tbl_products`");
    $list_posts = db_fetch_array("SELECT * FROM `tbl_post_cat`");
    $list_menus = db_fetch_array("SELECT * FROM `tbl_menus`");
    // show_array($list_menus);

?>
<div id="main-content-wp" class="add-cat-page menu-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="#" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Menu</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section-detail clearfix">
                <div id="list-menu" class="fl-left">
                    <form  method="POST" action="">
                    <?php echo form_error('menu'); ?>
                        <div class="form-group">
                            <label for="title">Tên menu</label>
                            <input type="text" name="title" id="title" value="<?php if(!empty($_POST['title'])) echo $_POST['title'];?>">
                        </div>
                        <?php echo form_error('title'); ?>
                        <p class='mess_error'></p>
                        <div class="form-group">
                            <label for="url-static">Đường dẫn tĩnh</label>
                            <input type="text" name="url_static" id="url-static" value="<?php if(!empty($_POST['url_static'])) echo $_POST['url_static'];?>">
                            <p>Chuỗi đường dẫn tĩnh cho menu</p>
                        </div>
                        <?php echo form_error('url_static'); ?>
                        <div class="form-group clearfix">
                            <label>Trang</label>
                            <p>Trang liên kết đến menu</p>
                        </div>
                        <div class="form-group clearfix">
                            <label>Danh mục sản phẩm</label>
                            <select name="product_id">
                            <option value="0">-- Chọn --</option>
                            <?php
                                foreach ($list_products as $item) {
                                    ?>
                                    <option value="<?php echo $item['product_id'];?>"><?php echo $item['product_title'] ?></option>
                                    <?php
                                }
                            ?>
                           </select>
                            <p>Danh mục sản phẩm liên kết đến menu</p>
                        </div>
                        <div class="form-group clearfix">
                            <label>Danh mục bài viết</label>
                            <select name="post_id">
                                <option value="0">-- Chọn --</option>
                                <?php
                                foreach ($list_posts as $item) {
                                    ?>
                                    <option value="<?php echo $item['cat_id'];?>"><?php echo $item['title'] ?></option>
                                    <?php
                                }
                            ?>
                            </select>
                            <p>Danh mục bài viết liên kết đến menu</p>
                        </div>
                     
                        <div class="form-group">
                            <label for="menu-order">Thứ tự</label>
                            <input type="text" name="menu_order" id="menu-order" value="<?php if(!empty($_POST['menu_order'])) echo $_POST['menu_order'];?>">
                        </div>
                        <?php echo form_error('menu_order')?>
                        <p class='mess_error'></p>
                        <div class="form-group">
                            <button type="submit" name="sm_add" id="btn-save-list">Lưu danh mục</button>
                        </div>
                    </form>
                </div>
                <div id="category-menu" class="fl-right">
                    <div class="actions">
                        <select name="post_status">
                            <option value="-1">Tác vụ</option>
                            <option value="delete">Xóa vĩnh viễn</option>
                        </select>
                        <button type="submit" name="sm_block_status" id="sm-block-status">Áp dụng</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên menu</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Slug</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Thứ tự</span></td>
                                </tr>
                            </thead>
                            <tbody>
                           
                                <?php
                                $temp = 0;
                                
                                foreach ($list_menus as $menu){
                                   $temp ++;
                                        
                                        ?>
                                         <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="2"></td>
                                    <td><span class="tbody-text"><?php echo $temp;?></span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="?mod=menu&controller=index&action=update_menu&menu_id=<?php echo $menu['menu_id'];?>" title=""><?php echo $menu['menu_title'];?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=menu&controller=index&action=update_menu&menu_id=<?php echo $menu['menu_id'];?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=menu&controller=index&action=delete_menus&menu_id=<?php echo $menu['menu_id'];?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td style="text-align: center;"><span class="tbody-text"><?php echo $menu['menu_url_static'];?></span></td>
                                    <td style="text-align: center;"><span class="tbody-text"><?php echo $menu['menu_order'];?></span></td>
                                    </tr>
                                        <?php
                                    
                                    
                                }
                                    ?> 
                               

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên menu</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Slug</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Thứ tự</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>