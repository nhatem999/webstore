<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib','validation');
    load('helper','url');
}

function indexAction() {
    
    load_view('index');
}

