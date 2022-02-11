<?php

    get_header();
?>
<div id="content">
<h1>Danh sách thành viên</h1>
        <table>
            <thead>
                <tr>
                    <td>STT</td>
                    <td>Tên</td>
                    <td>Email</td>
                   
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list_users)) {
                    $t = 0;
                    foreach ($list_users as $user) {
                        $t ++;
                        ?>
                        <tr>
                            <td><?php echo $t; ?></td>
                            <td><?php echo $user['fullname'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><a href="<?php echo $user['url_update'] ?>">Sửa</a></td>
                            <td><a href="<?php echo $user['url_delete'] ?>">Xóa</a></td>
                            
                        </tr>
                        <?php
                    }
                }
                ?>

            </tbody>
        </table>
</div>

<?php

    get_footer();
?>