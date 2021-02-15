<?php
    require "../../../models/khachhang.php";

    if (isset($_POST['makhachhang']) && isset($_POST['tenkhachhang']) && isset($_POST['sodienthoai']) && isset($_POST['diachi'])  && isset($_POST['ngaysinh']) && isset($_POST['email'])  && isset($_POST['gioitinh'])) {
        echo $makhachhang = $_POST['makhachhang'];
        echo $tenkhachhang = $_POST['tenkhachhang'];
        echo $sodienthoai = $_POST['sodienthoai'];
        echo $diachi = $_POST['diachi'];
        echo $ngaysinh = $_POST['ngaysinh'];
        echo $email = $_POST['email'];
        echo $gioitinh = $_POST['gioitinh'];

        $khachhang = new khachhang();
        $khachhang->suakhachhang($tenkhachhang, $sodienthoai, $diachi, $ngaysinh, $email, $gioitinh, $makhachhang);
    }else{
        echo "Fail";
    }
   
?>