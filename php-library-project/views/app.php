<div class="row w-100">
    <div class="col-md-3">
        <?php 
            if(isset($_SESSION['nhanvien'])){
                require "./views/includes/menu_right.php";
            }
         ?>
    </div>
    <div class="col-md-9">
        <?php
            # có session - đã đăng nhập
            if(isset($_SESSION['nhanvien'])){
                require "./views/includes/navbar.php";
                require "includes/gotop.php";

                # tìm thấy yêu cầu trang
                if(isset($_GET['nhanvien'])) require "views/quanli/nhanvien/index.php";

                else if(isset($_GET['sanpham'])) require "views/quanli/sanpham/index.php";

                else if(isset($_GET['khachhang'])) require "views/quanli/khachhang/index.php";

                else if(isset($_GET['tacgia'])) require "views/quanli/tacgia/index.php";
                
                else if(isset($_GET['nxb'])) require "views/quanli/nxb/index.php";

                else if (isset($_GET['danhmuc'])) require "views/quanli/danhmuc/index.php";
                
               else if(isset($_GET['sach'])) require "views/quanli/sach/index.php";

               else if(isset($_GET['hoadon'])) require "views/quanli/hoadon/index.php";
                
                # không tìm thấy yêu cầu trang
                else require 'quanli/index.php';
                
            }    
            # chưa đăng nhập
            else {
                require "forms/dangnhap.php";
            }
        ?>
    </div>
</div>