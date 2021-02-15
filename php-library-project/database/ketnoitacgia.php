<?php
    class databaseTacGia{
        public $connect;
        public function __construct(){
            try {
                # gọi file vào
                require "ketnoi.php";
            } catch (Throwable $th) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        Kết nối dữ liệu đến tác giả bị lỗi...! Vui lòng liên hệ nhân viên kĩ thuật...!
                    </div>
                <?php
                $this->connect = null;
            }
        }
    }
?>