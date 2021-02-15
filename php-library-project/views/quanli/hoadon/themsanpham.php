<?php
    require "../../../models/hoadon.php";
    require "../../../models/khachhang.php";

    if (isset($_POST['makhachhang']) && isset($_POST['manhanvien'])) {
        $ma_khach_hang = $_POST['makhachhang'];
        $ma_nhan_vien = $_POST['manhanvien'];
        $ngay_lap = date('Y-m-d');

        $them = new hoadon();

        $khachhang = new khachhang();
        $count = count($khachhang->thongtinkhachhang($ma_khach_hang));

        if($count == 0){
            // đã tồn tại - trả về không được thêm
            $data = array(
                'result'          =>      "0",
            );
        }else{
            // chưa tồn tại - trả về được thêm
            $data = array(
                'result'          =>      "1",
            );

            // thêm
            $them->themhoadon($ngay_lap,$ma_nhan_vien,$ma_khach_hang);
        }
        
        echo json_encode($data);
    }
   
?>