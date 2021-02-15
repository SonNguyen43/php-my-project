<?php
    require "../../../models/hoadon.php";
    require "../../../models/sanphamchohoadon.php";

    if (isset($_POST['mahoadon'])) {
        $mahoadon = $_POST['mahoadon'];

        $sanpham = new sanphamchohoadon();
        $sanpham-> xoasanphamcuahoadon($mahoadon);

        $hoadon = new hoadon();
        $hoadon->xoahoadon($mahoadon);

    }
   
?>