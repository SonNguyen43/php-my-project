<?php
    class DatabaseFeedback{
        public $connect;
        public function __construct(){
            try {
                # gọi file vào
                require "connect.php";
            } catch (Throwable $th) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        Kết nối dữ liệu đến phản hồi bị lỗi...! Vui lòng liên hệ nhân viên kĩ thuật...!
                    </div>
                <?php
                $this->connect = null;
            }
        }
    }
?>