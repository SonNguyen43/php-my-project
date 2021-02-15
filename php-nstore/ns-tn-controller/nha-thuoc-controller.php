<?php
    ob_start();
    session_start(); 

    require "../ns-tn-model/nha-thuoc-class.php";

    if(isset($_GET["yeucau"])){
        $yeucau = $_GET["yeucau"];

        switch ($yeucau) {
            case 'them':
                if(isset($_POST['tennhathuoc']) && isset($_POST['sodienthoai']) && isset($_POST['diachi'])){
                    # nhận các dữ liêu được POST qua
                    $tennhathuoc = $_POST['tennhathuoc'].trim();
                    $sodienthoai = $_POST['sodienthoai'].trim();
                    $diachi = $_POST['diachi'].trim();
                    $ngaybatdau = date("Y-m-d");

                    # khu vực
                    $kv1 = 'Vị Thanh Vị Thuỷ Châu Thành A';
                    $kv2 = 'Huyện Long Mỹ Thị xã Long Mỹ';
                    $kv3 = 'Phụng Hiệp Ngã 7 Châu Thành';
                    if (strpos($kv1, $diachi) !== false) {
                        $khuvuc = "Khu vực 1";
                    }
                    if (strpos($kv2, $diachi) !== false) {
                        $khuvuc = "Khu vực 2";
                    }
                    if (strpos($kv3, $diachi) !== false) {
                        $khuvuc = "Khu vực 3";
                    }
                    

                    $nhathuoc = new nhathuocclass();
                    $nhathuoc->Them($tennhathuoc,$sodienthoai,$diachi,$ngaybatdau, $khuvuc);
                    header("Location: ../index.php?page=nhathuoc&ketqua=themthanhcong");
                }else{
                    header("Location: ../index.php?page=nhathuoc&ketqua=thongtinrong");
                }
            break;
            case 'sua':
                if(isset($_POST['manhathuoc']) && isset($_POST['tennhathuoc']) && isset($_POST['diachi']) && isset($_POST['sodienthoai'])){
                    $manhathuoc = $_POST['manhathuoc'];
                    $tennhathuoc = $_POST['tennhathuoc'];
                    $diachi = $_POST['diachi'];
                    $sodienthoai = $_POST['sodienthoai'];

                    $nhathuoc = new nhathuocclass();

                    $nhathuoc->SuaNhaThuoc($tennhathuoc,$diachi, $sodienthoai,$manhathuoc);
                    header("Location: ../index.php?page=nhathuoc&ketqua=suathanhcong");
                }else{
                    header("Location: ../index.php?page=nhathuoc&ketqua=thongtinrong");
                }
            break;
            case 'xoa':
                if(isset($_POST['manhathuoc'])){
                    # nhận các dữ liêu được POST qua
                    $manhathuoc = $_POST['manhathuoc'];
                    $nhathuoc = new nhathuocclass();

                    $nhathuoc->Xoa($manhathuoc);
                    header("Location: ../index.php?page=nhathuoc&ketqua=xoathanhcong");
                }else{
                    header("Location: ../index.php?page=nhathuoc&ketqua=thongtinrong");
                }
            break;
            case 'suangungban':
                if(isset($_REQUEST['manhathuoc'])){
                    # nhận các dữ liêu được POST qua
                    $manhathuoc = $_REQUEST['manhathuoc'];
                    $nhathuoc = new nhathuocclass();
                    $ngayngungban = date("Y-m-d");

                    if($_REQUEST['trangthai'] == 'conban'){
                        $nhathuoc->SuaNgungBan('ngungban',$ngayngungban,$manhathuoc);
                    }
                    if($_REQUEST['trangthai'] == 'ngungban'){
                        $nhathuoc->SuaNgungBan('conban',$ngayngungban,$manhathuoc);
                    }
                }else{
                }
            break;
            default:
                # code...
                break;
        }
    }else{
        header("Location: ../index.php?ketqua=yeucaukhongxacdinh");
    }
    ob_end_flush();
?>