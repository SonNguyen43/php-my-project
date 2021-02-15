<?php
    class databaseCTHHHT{
        public $connect;
        public function databaseCTHHHT(){
            try {
                require "ket-noi.php";
            } catch (Throwable $th) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        Kết nối dữ liệu đến chi tiết hàng hóa hàng tồn bị lỗi...! Vui lòng liên hệ nhân viên kĩ thuật...!
                    </div>
                <?php
                $this->connect = null;
            }
        }
    }
?>