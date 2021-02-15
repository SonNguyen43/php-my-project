<?php
    require "../../../models/khachhang.php";

    if (isset($_POST['makhachhang'])) {
        echo $makhachhang = $_POST['makhachhang'];

        $xoa = new khachhang();
        $xoa->xoakhachhang($makhachhang);
    }else{
        echo "Fail";
    }
   
?>