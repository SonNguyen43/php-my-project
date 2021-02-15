<?php
    ob_start();
    session_start(); 

    require "../ns-tn-model/hang-hoa-class.php";

    if(isset($_GET["yeucau"])){
        $yeucau = $_GET["yeucau"];

        switch ($yeucau) {
            case 'themmoi':
                if(isset($_POST['tenhanghoa'])){
                    # nhận các dữ liêu được POST qua
                    $tenhanghoa = $_POST['tenhanghoa'];
                    $hanghoa = new hanghoaclass();

                    $hanghoa->ThemMoi($tenhanghoa);
                    header("Location: ../index.php?page=hanghoa&ketqua=themthanhcong");
                }else{
                    header("Location: ../index.php?page=hanghoa&ketqua=thongtinrong");
                }
            break;
            case 'sua':
                if(isset($_POST['tenhanghoa']) && isset($_POST['mahanghoa'])){
                    # nhận các dữ liêu được POST qua
                    $mahanghoa = $_POST['mahanghoa'];
                    $tenhanghoa = $_POST['tenhanghoa'];
                    $hanghoa = new hanghoaclass();

                    $hanghoa->SuaHangHoa($tenhanghoa,$mahanghoa);
                    header("Location: ../index.php?page=hanghoa&ketqua=suathanhcong");
                }else{
                    header("Location: ../index.php?page=hanghoa&ketqua=thongtinrong");
                }
            break;
            case 'xoa':
                if(isset($_POST['mahanghoa'])){
                    # nhận các dữ liêu được POST qua
                    $mahanghoa = $_POST['mahanghoa'];
                    $hanghoa = new hanghoaclass();

                    $hanghoa->XoaHangHoa($mahanghoa);
                    header("Location: ../index.php?page=hanghoa&ketqua=xoathanhcong");
                }else{
                    header("Location: ../index.php?page=hanghoa&ketqua=thongtinrong");
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