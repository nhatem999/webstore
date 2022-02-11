<?php
global $temp;
   $cat = $_POST['parent'];
   $parent_id = get_info_cat_parent('cat_id',$cat);
   // show_array($list_cat);
   $list_cat = db_fetch_array("SELECT * FROM `tbl_produc_cat`");
//    $temp=array();
   foreach($list_cat as $items){
       if($items['parent_id'] == $parent_id){
           $temp[] =  $items['title'];
           echo $items['title'];

       }
   }
  

   // show_array($temp);

?>