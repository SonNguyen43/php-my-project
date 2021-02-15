
<?php
    # có session - đã đăng nhập
    # isset kiểm tra sự tồn tại của biến
    if(isset($_SESSION['admin'])){
        ?><div class="row w-100">
        <div class="col-md-3"><?php require "includes/navbar_admin.php"; ?></div><?php 
       
        ?><div class="col-md-9"><?php
        
            require "includes/menu_top.php";
            
            if(isset($_GET['danh_muc'])) require "quanli/admin/category/index.php";
            else if(isset($_GET['san_pham'])) require "quanli/admin/product/index.php";
            else if(isset($_GET['nguoi_dung'])) require "quanli/admin/user/index.php";
            else if(isset($_GET['tin_tuc']) && $_GET['tin_tuc'] == 'sua' && $_GET['id'] != '') require "quanli/admin/news/form/edit.php";
            else if(isset($_GET['tin_tuc']))  require "quanli/admin/news/index.php";
            else if(isset($_GET['phan_hoi'])) require "quanli/admin/feedback/index.php";
            else if(isset($_GET['gioi_thieu'])) require "quanli/admin/about/index.php";
            else if(isset($_GET['trang_chu'])) require "quanli/admin/index.php";
            else require "includes/404.php";

        ?></div></div><?php
    }    
    else if(isset($_GET['dang_ki'])) require "form/dang_ki.php";
    else if(isset($_GET['dang_nhap'])) require "form/dang_nhap.php";
    else {
        require "includes/navbar_user.php";
        if(isset($_SESSION['user']) && isset($_GET['gio_hang']) && $_GET['gio_hang'] != '') {
            require "quanli/user/cart/index.php";
        }
        else if(isset($_GET['su_kien'])) {
            require "quanli/user/news/news.php";
        }
        else if(isset($_GET['danh_muc']) && isset($_GET['id'])){
            require "quanli/user/category/list_product_for_category.php";
        } 
        else if(isset($_GET['san_pham']) && isset($_GET['id'])){
            require "quanli/user/product/details.php";
        } 
        else if(isset($_GET['trang_ca_nhan'])){
            require "quanli/user/profile/menu.php";
        } 
        else{
            require "quanli/user/index.php";
        }

        require "./chatbot/index.php";
    };
    
?>
