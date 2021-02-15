<?php
    require "../../../models/khachhang.php";

    if (isset($_POST['tenkhachhang']) && isset($_POST['sodienthoai']) && isset($_POST['diachi']) && isset($_POST['ngaysinh']) && isset($_POST['gioitinh']) && isset($_POST['email'])) {
        $tenkhachhang = $_POST['tenkhachhang'];
        $sodienthoai = $_POST['sodienthoai'];
        $diachi = $_POST['diachi'];
        $ngaysinh = $_POST['ngaysinh'];
        $gioitinh = $_POST['gioitinh'];
        $email = $_POST['email'];

        $khachhang = new khachhang();

        $khachhang->themkhachhang($tenkhachhang, $diachi, $sodienthoai, $ngaysinh, $gioitinh, $email);
    }
   
?>