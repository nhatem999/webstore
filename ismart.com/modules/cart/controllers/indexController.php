<?php
function construct(){
   
    load_model('index');
    load('helper', 'url');
}
function indexAction(){
  load_view('index');
}
function add_cartAction(){
    add_cart();
  //  show_array($_SESSION);
   redirect_to('gio-hang.html');
    
}
function update_cartAction(){
  $product_id = $_POST['product_id'];
  $num_order = $_POST['num_order'];
  $item = get_info_product($product_id);
  if(isset($_SESSION['cart']['buy'][$product_id])){
    $_SESSION['cart']['buy'][$product_id]['qty'] = $num_order ;
    $sub_total = $num_order * $item['product_price_new'];
    $_SESSION['cart']['buy'][$product_id]['sub_total'] = $sub_total ;
    update_info_cart();
    $infor_cart = get_info_cart();
    $total = $infor_cart['total'];
    $data = array(
        'sub_total'=> currency_format($sub_total),
        'total' => currency_format($total),
    );
    echo json_encode($data);
    
  }
  
}
function delete_cartAction(){
    $product_id = $_GET['product_id'];
    delete_cart($product_id);
    redirect_to('gio-hang.html');
}
function checkoutAction(){

  load_view('checkout');
}
function districtAction(){
 
 
  $select_district = '<option value="">-- Chọn Quận/Huyện --</option>';
  if(!empty($_POST['province'])){
      $province = $_POST['province'];
      $matp = get_matp_by_province($province);
      $list_district = db_fetch_array("SELECT* FROM `tbl_district` WHERE `matp` = '{$matp}'");
      foreach($list_district as $district){
          $select_district .= '
              <option value="'.$district['name'].'">'.$district['name'].'</option>
      ';
      }
  }
  echo $select_district;
  
}
function select_communeAction(){
  $select_commune = '<option value="">-- Chọn Xã/Phường --</option>';
  if(!empty($_POST['district'])){
      $district = $_POST['district'];
      $maqh = get_matp_by_district($district);
      $select_commune = db_fetch_array("SELECT* FROM `tbl_commune` WHERE `maqh` = '{$maqh}'");
      foreach($select_commune as $commune){
          $select_commune .= '
              <option value="'.$commune['name'].'">'.$commune['name'].'</option>
      ';
      }
  }
  echo $select_commune;
}
function orderAction(){
  global $error,$fullname,$email,$phone,$province,$district,$commune,$note,$payment,$data;
    if(isset($_POST['btn-buy-cart'])){
      $error = array();
        if(empty($_POST['fullname'])){
          $error['fullname'] = "Bạn không được để trống họ tên";
        }
        else{
          $fullname = $_POST['fullname'];
        }
        if(empty($_POST['email'])){
          $error['email'] = "Bạn không được để trống email";
        }else{
          if(!is_email($_POST['email'])){
            $error['email'] = "Email không đúng định dạng";
          }
          else{
            $email = $_POST['email'];
          }
        }
        if(empty($_POST['phone'])){
          $error['phone'] = "Bạn cần nhập số điện thoại";

        }else{
          if(!is_phone($_POST['phone'])){
            $error['phone'] = "Số điện thoại không đúng định dạng";
          }else{
            $phone = $_POST['phone'];
          }
        }
        if(empty($_POST['province'])){
          $error['province'] = "Bạn chưa chọn Thành phố";
        }else{
          $province = $_POST['province'];
        }
        if(empty($_POST['district'])){
          $error['district'] = "Bạn chưa chọn Quận / Huyện";
        }else{
          $district = $_POST['district'];
        }
        if(empty($_POST['commune'])){
          $error['commune'] = "Bạn cần chọn phường xã";
        }else{
          $commune = $_POST['commune'];
        }
        if(empty($_POST['note'])){
          $error['note'] = "Bạn cần nhập địa chỉ nhà";
        }else{
          $note = $_POST['note'];
        }
        if(empty($_POST['payment-method'])){
          $error['payment-method'] = "Bạn cần chọn hình thức thanh toán";
        }else{
          $payment = $_POST['payment-method'];
          if($payment == "direct-vnpay"){
            redirect('vnpay_php/index.php');
          }
         
        }
        if(empty($error)){
          // show_array($_SESSION);
          
          $address =$note .','.$commune.', '.$district.', '.$province;
          $data = array(
            'fullname' => $fullname,
            'email' => $email,
            'payment' => $payment,
            'phone' => $phone,
            'address' => $address,
            'total_price' => $_SESSION['cart']['info']['total'],
            'status' => 'Watting',
            'created_date' => date('d/m/Y H:i:s'),
          );
          insert_order($data);
          
          $list_buy_cart = get_list_buy_cart();
          $product_order =array();
          foreach($list_buy_cart as $item) {
              $product_order = array(
                'order_code' =>'DT'. $phone,
                'product_code' => $item['product_code'],
                'product_qty' => $item['qty'],
                'product_price_new' => $item['product_price_new'],
              );
              insert_product_order($product_order);
        }
        $error['success'] = "Đặt hàng thành công!";
        unset($_SESSION['cart']);
    }
  
}
load_view('checkout');
}