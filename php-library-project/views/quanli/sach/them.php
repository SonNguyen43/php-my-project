<?php
    require "../../../models/sach.php";

    if (isset($_POST['tensach']) && isset($_POST['soluong']) && isset($_POST['dongia']) 
        && isset($_POST['mota']) && isset($_POST['namxuatban']) && isset($_POST['tacgia']) 
        && isset($_POST['nxb'])) {
       
        $tensach = $_POST['tensach'];
        $soluong = $_POST['soluong'];
        $dongia = $_POST['dongia'];
        $mota = $_POST['mota'];
        $namxuatban = $_POST['namxuatban'];
        $tacgia = $_POST['tacgia'];
        $nxb = $_POST['nxb'];

        $them = new Sach();

        $them->themsach($tensach,$soluong, $dongia, $mota, $namxuatban, $tacgia, $nxb);
    }
   
?>