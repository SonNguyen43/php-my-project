<?php
    class databaseSanPham{
        public $connect;
        public function __construct(){
            try {
                # gọi file vào
                require "ketnoi.php";
            } catch (Throwable $th) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        Kết nối dữ liệu đến sản phẩm bị lỗi...! Vui lòng liên hệ nhân viên kĩ thuật...!
                    </div>
                <?php
                $this->connect = null;
            }
        }
    }
?>