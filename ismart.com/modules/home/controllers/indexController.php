<?php

function construct() {
    load('helper', 'url');
    load_model('index');
}

function indexAction() {

    load_view('index');

}
function buy_nowAction() {
    add_cart();
    redirect('thanh-toan.html');
}
function search_productsAction() {
    global $list_search,$value;
    if(isset($_POST['sm-s'])){

        if(!empty($_POST['s'])){
           $value = $_POST['s'];
           load_view('search_products',$value);
        }else{
            load_view('index');
        }
       
    }else{
        load_view('index');
    }
   
}


function editAction() {
    
}
