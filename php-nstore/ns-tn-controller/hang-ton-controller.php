<?php
    ob_start();
    session_start();

    require "../ns-tn-model/hang-ton-class.php";   
    require "../ns-tn-model/admin-class.php";
    require "../ns-tn-model/hang-hoa-class.php";
    require "../ns-tn-model/cthh-hang-ton-class.php";

    if(isset($_GET["yeucau"])){
        $yeucau = $_GET["yeucau"];

        switch ($yeucau) {
            case 'taomoidonhang':
                if(isset($_POST['makhachhang']) && $_POST['ngaytao']){
                    $makhachhang = $_POST['makhachhang'];
                    $ngaytao = $_POST['ngaytao'];

                    if(isset($_SESSION['admin'])){
                        $tentaikhoan = $_SESSION['admin'];

                        # lấy mã admin
                        $admin = new adminclass();
                        $thongtin = $admin->LayThongTinAdminBangTen($tentaikhoan);
                        $maadmin = $thongtin->maadmin;

                        $hangton = new hangtonclass();
                        $hangton->ThemDonHangTon($ngaytao, $makhachhang, $maadmin);

                        header("Location: ../index.php?page=taomoihangton&id=$makhachhang");
                    }else{
                        $hangton = new hangtonclass();
                        $hangton->ThemDonHangTon($ngaytao, $makhachhang, 0);

                        header("Location: ../index.php?page=taomoihangton&id=$makhachhang");
                    }
                }else{
                    header("Location: ../index.php?page=taomoihangton&ketqua=thongtinrong");
                }
            break;

            case 'themhanghoavasoluong':
                $makhachhang = $_POST['makhachhang'];

                if(isset($_POST['mahanghoa']) && isset($_POST['soluong']) && isset($_POST['makhachhang'])){
                    # nhận các dữ liêu được POST qua
                    $mahanghoa = trim($_POST['mahanghoa']);
                    $soluong = trim($_POST['soluong']);
                    $makhachhang = $_POST['makhachhang'];

                    # lấy thông tin đơn hàng đang tạo
                    $hangton = new hangtonclass();
                    $thongtin = $hangton->LayDonHang($makhachhang);
                    $mahangton = $thongtin->MAX;

                    # tìm hàng hóa xem đã được thêm vào giỏ hàng chưa
                    $hanghoa = new hanghoaclass();
                    $count = $hanghoa->TimHangHoaDaThemHangTon($mahanghoa , $mahangton);

                    # chưa tồn tại món hàng trong giỏ
                    if($count <= 0){
                        # thêm hàng hóa và số lượng vào đơn hàng
                        $cthh = new cthhhtclass();
                        $cthh->ThemHangHoaVaSoLuong($soluong, $mahanghoa, $mahangton);
                        header("Location: ../index.php?page=taomoihangton&id=$makhachhang&ketqua=themthanhcong");
                    }else{
                        # đã tồn tại món hàng
                        header("Location: ../index.php?page=taomoihangton&id=$makhachhang&ketqua=datontaimonhang");
                    }

                }else{
                    # không nhận đủ dữ liệu POST qua
                    header("Location: ../index.php?page=taomoihangton&id=$makhachhang&ketqua=thongtinrong");
                }
            break;

            case 'huydonhang':
                $makhachhang = $_POST['makhachhang'];

                if(isset($_POST['makhachhang'])){
                    $makhachhang = $_POST['makhachhang']; 

                    $hangton = new hangtonclass();
                    $thongtin = $hangton->LayDonHang($makhachhang);
                    $mahangton = $thongtin->MAX;

                    $hangton->XoaHangHoaTrongDonHang($makhachhang , $mahangton);
                    header("Location: ../index.php?page=quanlitonkho&ketqua=xoathanhcong");
                }
                else{
                    # không nhận đủ dữ liệu POST qua
                    header("Location: ../index.php?page=taomoihangton&id=$makhachhang&ketqua=thongtinrong");
                }
            break;

            case 'suahanghoacuadonhang':
                $makhachhang = $_POST['makhachhang'];
                $mahangton = $_POST['mahangton'];

                if(isset($_POST['mahangton']) && isset($_POST['makhachhang']) && isset($_POST['machitiethanghoahangton']) && isset($_POST['soluong'])){
                    # nhận các dữ liệu POST qua
                    $makhachhang = $_POST['makhachhang'];
                    $machitiethanghoahangton = $_POST['machitiethanghoahangton'];
                    $soluong = trim($_POST['soluong']);
                    $mahangton = $_POST['mahangton'];

                    # độ dài số lượng không được < 0
                    if(strlen($soluong) < 0){
                        header("Location: ../index.php?page=suadonhangton&id=$makhachhang&mahangton=$mahangton&ketqua=thongtinrong");
                        
                    }else if($soluong == 0){
                        # nếu số lượng sửa = 0 => xóa món hàng ra khỏi đơn hàng
                        $cthh = new cthhhtclass();
                        $cthh->XoaMotHangHoaTrongDonHang($makhachhang , $mahangton, $machitiethanghoahangton);
                        header("Location: ../index.php?page=suadonhangton&id=$makhachhang&mahangton=$mahangton&ketqua=suathanhcong");
                    }else{
                        # thay đổi các thông tin của hàng hóa trong đơn hàng
                        $cthh = new cthhhtclass();
                        $cthh->SuaThongTinHangHoa($soluong, $machitiethanghoahangton, $makhachhang);
                        header("Location: ../index.php?page=suadonhangton&id=$makhachhang&mahangton=$mahangton&ketqua=suathanhcong");
                    }
                }else{
                    # không nhận đủ các dữ liệu được POST qua
                    header("Location: ../index.php?page=suadonhangton&id=$makhachhang&mahangton=$mahangton&ketqua=thongtinrong");
                }
            break;

            case 'suahanghoacuadonhangdatao':
                $makhachhang = $_POST['makhachhang'];
                $mahangton = $_POST['mahangton'];

                if(isset($_POST['mahangton']) && isset($_POST['makhachhang']) && isset($_POST['machitiethanghoahangton']) && isset($_POST['soluong'])){
                    # nhận các dữ liệu POST qua
                    $makhachhang = $_POST['makhachhang'];
                    $machitiethanghoahangton = $_POST['machitiethanghoahangton'];
                    $soluong = trim($_POST['soluong']);
                    $mahangton = $_POST['mahangton'];

                    # số lượng không được < 0
                    if(strlen($soluong) < 0){
                        header("Location: ../index.php?page=suadonhangton&id=$makhachhang&mahangton=$mahangton&ketqua=thongtinrong");
                    }else if($soluong == 0){
                        # nếu số lượng sửa = 0 => xóa món hàng ra khỏi đơn hàng
                        $cthh = new cthhhtclass();
                        $cthh->XoaMotHangHoaTrongDonHang($makhachhang , $mahangton, $machitiethanghoahangton);
                        header("Location: ../index.php?page=suadonhangton&id=$makhachhang&mahangton=$mahangton&ketqua=suathanhcong");
                    }else{
                       # thay đổi các thông tin của hàng hóa trong đơn hàng
                       $cthh = new cthhhtclass();
                       $cthh->SuaThongTinHangHoa($soluong, $machitiethanghoahangton, $makhachhang);
                        header("Location: ../index.php?page=suadonhangton&id=$makhachhang&mahangton=$mahangton&ketqua=suathanhcong");
                    }
                }else{
                    # không nhận đủ các dữ liệu được POST qua
                    header("Location: ../index.php?page=suadonhangton   &id=$makhachhang&mahangton=$mahangton&ketqua=thongtinrong");
                }
            break;

            case 'themhanghoavasoluongdatao':
                $makhachhang = $_POST['makhachhang'];
                $mahangton = $_POST['mahangton'];

                if(isset($_POST['mahanghoa']) && isset($_POST['soluong']) && isset($_POST['makhachhang']) && isset($_POST['mahangton'])){
                    # nhận các dữ liêu được POST qua
                    $mahanghoa = trim($_POST['mahanghoa']);
                    $soluong = trim($_POST['soluong']);
                    $makhachhang = $_POST['makhachhang'];
                    $mahangton = $_POST['mahangton'];

                    # tìm hàng hóa xem đã được thêm vào giỏ hàng chưa
                    $hanghoa = new hanghoaclass();
                    $count = $hanghoa->TimHangHoaDaThemHangTon($mahanghoa , $mahangton);


                    // # chưa tồn tại món hàng trong giỏ
                    if($count <= 0){
                        # thêm hàng hóa và số lượng vào đơn hàng
                        $cthh = new cthhhtclass();
                        $cthh->ThemHangHoaVaSoLuong($soluong, $mahanghoa, $mahangton);
                        header("Location: ../index.php?page=suadonhangton&id=$makhachhang&mahangton=$mahangton&ketqua=themthanhcong");
                    }else{
                        # đã tồn tại món hàng
                        header("Location: ../index.php?page=suadonhangton&id=$makhachhang&mahangton=$mahangton&ketqua=datontaimonhang");
                    }

                }else{
                    # không nhận đủ dữ liệu POST qua
                    header("Location: ../index.php?page=suadonhangton&id=$makhachhang&mahangton=$mahangton&ketqua=thongtinrong");
                }
            break;
            case 'huydonhangdatao':
                $makhachhang = $_POST['makhachhang'];
                $mahangton = $_POST['mahangton'];

                if(isset($_POST['makhachhang']) && isset($_POST['mahangton'])){
                    $makhachhang = $_POST['makhachhang']; 
                    $mahangton = $_POST['mahangton'];

                    $donhang = new hangtonclass();
                    $donhang->XoaHangHoaTrongDonHang($makhachhang , $mahangton);
                    header("Location: ../index.php?page=quanlitonkho&ketqua=xoathanhcong");
                }
                else{
                    # không nhận đủ dữ liệu POST qua
                    header("Location: ../index.php?page=quanlitonkho&id=$makhachhang&mahangton=$mahangton&ketqua=thongtinrong");
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