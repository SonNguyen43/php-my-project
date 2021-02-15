<?php
    require "../../../models/sanpham.php";

    if (isset($_POST['masanpham']) && isset($_POST['tensanpham']) && isset($_POST['gia'])  && isset($_POST['madanhmuc'])) {
        $masanpham = $_POST['masanpham'];
        $tensanpham = $_POST['tensanpham'];
        $gia = $_POST['gia'];
        $madanhmuc = $_POST['madanhmuc'];

        $sua = new sanpham();
        $sua->suasanpham($tensanpham, $gia,$madanhmuc,$masanpham);
    }
   
?>