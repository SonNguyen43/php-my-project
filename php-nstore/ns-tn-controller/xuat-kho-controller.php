<?php
    ob_start();
    session_start(); 

    require "../ns-tn-model/don-hang-class.php";
    require "../ns-tn-model/admin-class.php";
    require "../ns-tn-model/hang-hoa-class.php";
    require "../ns-tn-model/cthh-don-hang-class.php";

    if(isset($_GET["yeucau"])){
        $yeucau = $_GET["yeucau"];

        switch ($yeucau) {
            case 'taomoidonhang':
                if(isset($_POST['makhachhang']) && isset($_POST['mabill']) && isset($_POST['ghichu'])){
                    # nhận các dữ liêu được POST qua
                    $makhachhang = $_POST['makhachhang'];
                    $mabill = trim($_POST['mabill']);
                    $ngaytao = date("Y-m-d");
                    $ghichu = trim($_POST['ghichu']);

                    if(strlen($maadmin) < 0){
                        # không lấy được mã admin
                        header("Location: ../index.php?page=taomoidonhang&ketqua=thongtinrong");
                    }else if(isset($_SESSION['admin'])){
                        # lấy được mã admin
                        $tentaikhoan = $_SESSION['admin'];

                        # lấy mã admin
                        $admin = new adminclass();
                        $thongtin = $admin->LayThongTinAdminBangTen($tentaikhoan);
                        $maadmin = $thongtin->maadmin;
                      
                        # thêm đơn hàng có mã admin
                        $donhang = new donhangclass();
                        $themdonhang = $donhang->ThemNhaPhanPhoiVaCuaHang($mabill, $ngaytao, $makhachhang, $ghichu, $maadmin);
                        header("Location: ../index.php?page=taomoidonhang&id=$makhachhang");
                    }else{
                         # thêm đơn hàng không có mã admin
                         $donhang = new donhangclass();
                         $themdonhang = $donhang->ThemNhaPhanPhoiVaCuaHang($mabill, $ngaytao, $makhachhang, $ghichu , 0);
                         header("Location: ../index.php?page=taomoidonhang&id=$makhachhang");
                    }
                }else{
                    header("Location: ../index.php?page=taomoidonhang&ketqua=thongtinrong");
                }
            break;
            case 'themhanghoavasoluong':
                $makhachhang = $_POST['makhachhang'];

                if(isset($_POST['mahanghoa']) && isset($_POST['soluong']) && isset($_POST['ngaysanxuat']) && isset($_POST['makhachhang'])){
                    # nhận các dữ liêu được POST qua
                    $mahanghoa = trim($_POST['mahanghoa']);
                    $soluong = trim($_POST['soluong']);
                    $ngaysanxuat = $_POST['ngaysanxuat'];
                    $makhachhang = $_POST['makhachhang'];

                    # lấy thông tin đơn hàng đang tạo
                    $donhang = new donhangclass();
                    $thongtin = $donhang->LayDonHang($makhachhang);
                    $madonhang = $thongtin->MAX;

                    # tìm hàng hóa xem đã được thêm vào giỏ hàng chưa
                    $hanghoa = new hanghoaclass();
                    $count = $hanghoa->TimHangHoaDaThem($mahanghoa , $madonhang);

                    # chưa tồn tại món hàng trong giỏ
                    if($count <= 0){
                        # thêm hàng hóa và số lượng vào đơn hàng
                        $cthh = new cthhdhclass();
                        $cthh->ThemHangHoaVaSoLuong($soluong, $ngaysanxuat, $mahanghoa, $madonhang);
                        header("Location: ../index.php?page=taomoidonhang&id=$makhachhang&ketqua=themthanhcong");
                    }else{
                        # đã tồn tại món hàng
                        header("Location: ../index.php?page=taomoidonhang&id=$makhachhang&ketqua=datontaimonhang");
                    }

                }else{
                    # không nhận đủ dữ liệu POST qua
                    header("Location: ../index.php?page=taomoidonhang&id=$makhachhang&ketqua=thongtinrong");
                }
            break;
            case 'themhanghoavasoluongdatao':
                $makhachhang = $_POST['makhachhang'];

                if(isset($_POST['mahanghoa']) && isset($_POST['soluong']) && isset($_POST['ngaysanxuat']) && isset($_POST['makhachhang'])){
                    # nhận các dữ liêu được POST qua
                    $mahanghoa = trim($_POST['mahanghoa']);
                    $soluong = trim($_POST['soluong']);
                    $ngaysanxuat = $_POST['ngaysanxuat'];
                    $makhachhang = $_POST['makhachhang'];

                    # lấy thông tin đơn hàng đang tạo
                    $donhang = new donhangclass();
                    $thongtin = $donhang->LayDonHang($makhachhang);
                    $madonhang = $thongtin->MAX;

                    # tìm hàng hóa xem đã được thêm vào giỏ hàng chưa
                    $hanghoa = new hanghoaclass();
                    $count = $hanghoa->TimHangHoaDaThem($mahanghoa , $madonhang);

                    # chưa tồn tại món hàng trong giỏ
                    if($count <= 0){
                        # thêm hàng hóa và số lượng vào đơn hàng
                        $cthh = new cthhdhclass();
                        $cthh->ThemHangHoaVaSoLuong($soluong, $ngaysanxuat, $mahanghoa, $madonhang);
                        header("Location: ../index.php?page=suadonhang&id=$makhachhang&madonhang=$madonhang&ketqua=themthanhcong");
                    }else{
                        # đã tồn tại món hàng
                        header("Location: ../index.php?page=suadonhang&id=$makhachhang&madonhang=$madonhang&ketqua=datontaimonhang");
                    }

                }else{
                    # không nhận đủ dữ liệu POST qua
                    header("Location: ../index.php?page=suadonhang&id=$makhachhang&madonhang=$madonhang&ketqua=thongtinrong");
                }
            break;
            case 'huydonhang':
                $makhachhang = $_POST['makhachhang'];

                if(isset($_POST['makhachhang'])){
                    $makhachhang = $_POST['makhachhang']; 

                    # xóa chi tiết hàng hóa - đơn hàng của khách hàng
                    # lấy thông tin đơn hàng đang tạo
                    $donhang = new donhangclass();
                    $thongtin = $donhang->LayDonHang($makhachhang);
                    $madonhang = $thongtin->MAX;

                    $donhang->XoaHangHoaTrongDonHang($makhachhang , $madonhang);
                    header("Location: ../index.php?page=quanlixuatkho&ketqua=xoathanhcong");
                }
                else{
                    # không nhận đủ dữ liệu POST qua
                    header("Location: ../index.php?page=taomoidonhang&id=$makhachhang&ketqua=thongtinrong");
                }
            break;
            case 'huydonhangdatao':
                $makhachhang = $_POST['makhachhang'];

                if(isset($_POST['makhachhang']) && isset($_POST['madonhang'])){
                    $makhachhang = $_POST['makhachhang']; 
                    $madonhang = $_POST['madonhang'];

                    $donhang = new donhangclass();
                    $donhang->XoaHangHoaTrongDonHang($makhachhang , $madonhang);
                    header("Location: ../index.php?page=quanlixuatkho&ketqua=xoathanhcong");
                }
                else{
                    # không nhận đủ dữ liệu POST qua
                    header("Location: ../index.php?page=taomoidonhang&id=$makhachhang&ketqua=thongtinrong");
                }
            break;
            case 'suahanghoacuadonhangdatao':
                $makhachhang = $_POST['makhachhang'];

                if(isset($_POST['madonhang']) && isset($_POST['makhachhang']) && isset($_POST['machitiethanghoadonhang']) && isset($_POST['soluong']) && isset($_POST['ngaysanxuat'])){
                    # nhận các dữ liệu POST qua
                    $makhachhang = $_POST['makhachhang'];
                    $machitiethanghoadonhang = $_POST['machitiethanghoadonhang'];
                    $soluong = trim($_POST['soluong']);
                    $ngaysanxuat = $_POST['ngaysanxuat'];
                    $madonhang = $_POST['madonhang'];

                    # số lượng không được < 0
                    if(strlen($soluong) < 0){
                        header("Location: ../index.php?page=suadonhang&id=$makhachhang&madonhang=$madonhang&ketqua=thongtinrong");
                    }else if($soluong == 0){
                        # nếu số lượng sửa = 0 => xóa món hàng ra khỏi đơn hàng
                        $cthh = new cthhdhclass();
                        $cthh->XoaMotHangHoaTrongDonHang($makhachhang , $madonhang, $machitiethanghoadonhang);
                        header("Location: ../index.php?page=suadonhang&id=$makhachhang&madonhang=$madonhang&ketqua=suathanhcong");
                    }else{
                        # thay đổi các thông tin của hàng hóa trong đơn hàng
                        $cthh = new cthhdhclass();
                        $cthh->SuaThongTinHangHoa($soluong, $ngaysanxuat, $machitiethanghoadonhang, $makhachhang);
                        header("Location: ../index.php?page=suadonhang&id=$makhachhang&madonhang=$madonhang&ketqua=suathanhcong");
                    }
                }else{
                    # không nhận đủ các dữ liệu được POST qua
                    header("Location: ../index.php?page=suadonhang&id=$makhachhang&madonhang=$madonhang&ketqua=thongtinrong");
                }
            break;
            case 'suahanghoacuadonhang':
                $makhachhang = $_POST['makhachhang'];

                if(isset($_POST['madonhang']) && isset($_POST['makhachhang']) && isset($_POST['machitiethanghoadonhang']) && isset($_POST['soluong']) && isset($_POST['ngaysanxuat'])){
                    # nhận các dữ liệu POST qua
                    $makhachhang = $_POST['makhachhang'];
                    $machitiethanghoadonhang = $_POST['machitiethanghoadonhang'];
                    $soluong = trim($_POST['soluong']);
                    $ngaysanxuat = $_POST['ngaysanxuat'];
                    $madonhang = $_POST['madonhang'];

                    # số lượng không được < 0
                    if(strlen($soluong) < 0){
                        header("Location: ../index.php?page=taomoidonhang&id=$makhachhang&ketqua=thongtinrong");
                    }else if($soluong == 0){
                        # nếu số lượng sửa = 0 => xóa món hàng ra khỏi đơn hàng
                        $cthh = new cthhdhclass();
                        $cthh->XoaMotHangHoaTrongDonHang($makhachhang , $madonhang, $machitiethanghoadonhang);
                        header("Location: ../index.php?page=taomoidonhang&id=$makhachhang&ketqua=suathanhcong");
                    }else{
                        # thay đổi các thông tin của hàng hóa trong đơn hàng
                        $cthh = new cthhdhclass();
                        $cthh->SuaThongTinHangHoa($soluong, $ngaysanxuat, $machitiethanghoadonhang, $makhachhang);
                        header("Location: ../index.php?page=taomoidonhang&id=$makhachhang&ketqua=suathanhcong");
                    }
                }else{
                    # không nhận đủ các dữ liệu được POST qua
                    header("Location: ../index.php?page=taomoidonhang&id=$makhachhang&ketqua=thongtinrong");
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