<?php
    require "../../../models/sanpham.php";

    if (isset($_POST['tensanpham']) && isset($_POST['gia']) && isset($_POST['madanhmuc'])) {
        $tensanpham = $_POST['tensanpham'];
        $gia = $_POST['gia'];
        $madanhmuc = $_POST['madanhmuc'];

        $them = new sanpham();
        $them->themsanpham($tensanpham, $gia, $madanhmuc);
    }
   
?>