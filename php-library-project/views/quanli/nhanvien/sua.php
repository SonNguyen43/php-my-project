<?php
    require "../../../models/nhanvien.php";

    if (isset($_POST['manhanvien']) && isset($_POST['tennhanvien']) && isset($_POST['sodienthoai'])  
    && isset($_POST['diachi'])  && isset($_POST['ngaysinh'])  && isset($_POST['gioitinh']) && isset($_POST['trangthai'])) {
        $manhanvien = $_POST['manhanvien'];
        $tennhanvien = $_POST['tennhanvien'];
        $sodienthoai = $_POST['sodienthoai'];
        $diachi = $_POST['diachi'];
        $ngaysinh = $_POST['ngaysinh'];
        $gioitinh = $_POST['gioitinh'];
        $trangthai = $_POST['trangthai'];

        $sua = new nhanvien();
        $sua->suanhanvien($tennhanvien, $sodienthoai, $diachi, $ngaysinh, $gioitinh, $trangthai, $manhanvien);
    }
   
?>