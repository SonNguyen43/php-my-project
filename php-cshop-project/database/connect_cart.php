<?php
    class DatabaseCart{
        public $connect;
        public function __construct(){
            # bắt lỗi ngoại lệ
            try {
                # gọi file vào
                require "connect.php";
            } catch (Throwable $th) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        Kết nối dữ liệu đến giõ hàng bị lỗi...! Vui lòng liên hệ nhân viên kĩ thuật...!
                    </div>
                <?php
                $this->connect = null;
            }
        }
    }
?>