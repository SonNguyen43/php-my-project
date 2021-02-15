<?php
    ob_start();
    session_start();

    require "../ns-tn-model/nha-phan-phoi-class.php"; 
    require "../ns-tn-model/admin-class.php";     
    require "../ns-tn-model/sua-khach-hang-class.php"; 

    if(isset($_GET["yeucau"])){
        $yeucau = $_GET["yeucau"];

        switch ($yeucau) {
            case 'thaydoiloaikhachhang':
                if(isset($_POST['sodienthoai']) && isset($_POST['makhachhang'])){
                    $sodienthoai = $_POST['sodienthoai'];
                    $makhachhang = $_POST['makhachhang'];
                    $ngaytao = date("Y-m-d");

                    if(isset($_SESSION['admin'])){
                        $tentaikhoan = $_SESSION['admin'];

                        # lấy mã admin
                        $admin = new adminClass();
                        $thongtin = $admin->LayThongTinAdminBangTen($tentaikhoan);
                        $maadmin = $thongtin->maadmin;

                        # thêm mới khi biết mã admin
                        $khachhang = new nhaphanphoiclass();
                        $khachhang->SuaLoaiKhachHang($ngaytao, $maadmin,$sodienthoai,  $makhachhang);
                        header("Location: ../index.php?page=quanlinhaphanphoi&ketqua=themthanhcong");
                    }else{
                        $khachhang = new nhaphanphoiclass();
                        $khachhang->SuaLoaiKhachHang($ngaytao, 0 ,$sodienthoai,  $makhachhang);
                        header("Location: ../index.php?page=quanlinhaphanphoi&ketqua=themthanhcong");
                    }
                }else{
                    header("Location: ../index.php?page=quanlinhaphanphoi&ketqua=thongtinrong");
                }
            break;
            case 'luuthongtinkhachmoi':
                if(isset($_POST['hovaten']) && isset($_POST['sodienthoai']) && isset($_POST['diachi']) && isset($_POST['cmnd'])){
                    $hovaten = trim($_POST['hovaten']);
                    $sodienthoai = trim($_POST['sodienthoai']);
                    $diachi = trim($_POST['diachi']);
                    $cmnd = trim($_POST['cmnd']);
                    $ngaytao = date("Y-m-d");

                    if(strlen($hovaten) <= 0 || strlen($sodienthoai) <= 0 || strlen($diachi) <= 0 || strlen($cmnd) <= 0){
                        header("Location: ../index.php?page=taomoinhaphanphoi&ketqua=thongtinrong");
                    }else{
                        if(isset($_SESSION['admin'])){
                            $tentaikhoan = $_SESSION['admin'];

                            # lấy mã admin
                            $admin = new adminClass();
                            $thongtin = $admin->LayThongTinAdminBangTen($tentaikhoan);
                            $maadmin = $thongtin->maadmin;

                            # thêm mới khi biết mã admin
                            $nhaphanphoi = new nhaphanphoiclass();
                            $nhaphanphoi->ThemNhaPhanPhoiQuaDuong($hovaten, $sodienthoai, $cmnd, $diachi,  $maadmin, $ngaytao);
                            header("Location: ../index.php?page=taomoidonhang&sodienthoai=$sodienthoai");
                        }else{
                            # thêm mới khi không lấy được thông tin admin
                            $nhaphanphoi = new nhaphanphoiclass();
                            $nhaphanphoi->ThemNhaPhanPhoiQuaDuong($hovaten, $sodienthoai, $cmnd, $diachi,  0, $ngaytao);
                            header("Location: ../index.php?page=taomoidonhang&sodienthoai=$sodienthoai");
                        }
                    }
                }else{
                    # không nhận được dữ liệu POST qua
                    header("Location: ../index.php?page=quanlinhaphanphoi&ketqua=thongtinrong");
                }
            break;
            case 'themnhaphanphoi':
                # nhận các thông tin được post qua có đầy đủ không
                if(isset($_POST['hovaten']) && isset($_POST['sodienthoai']) && isset($_POST['diachi']) && isset($_POST['cmnd']) && isset($_POST['tructhuoc']) && isset($_POST['capbac'])){
                    # gán giá trị
                    $hovaten = trim($_POST['hovaten']);
                    $sodienthoai = trim($_POST['sodienthoai']);
                    $diachi = trim($_POST['diachi']);
                    $cmnd = trim($_POST['cmnd']);
                    $tructhuoc = trim($_POST['tructhuoc']);
                    $capbac = trim($_POST['capbac']);
                    $ngaytao = date("Y-m-d");

                    # kiểm tra dữ liệu rỗng
                    if(strlen($hovaten) <= 0 || strlen($sodienthoai) <= 0 || strlen($diachi) <= 0 || strlen($cmnd) <= 0 || strlen($tructhuoc) <= 0 || strlen($capbac) <= 0){
                        header("Location: ../index.php?page=taomoinhaphanphoi&ketqua=thongtinrong");
                    }else if(isset($_POST['mahopdong']) || isset($_POST['macuahang']) || isset($_POST['hethongnhaphanphoi'])){
                        # nếu những thông tin này được post qua tiến hành thêm những thông tin này luôn
                        $mahopdong = trim($_POST['mahopdong']);
                        $macuahang = trim($_POST['macuahang']);
                        $hethongnhaphanphoi = trim($_POST['hethongnhaphanphoi']);

                        $loaikhachhang = 'khachlaunam';

                        if(isset($_SESSION['admin'])){
                            $tentaikhoan = $_SESSION['admin'];

                            # lấy mã admin
                            $admin = new adminClass();
                            $thongtin = $admin->LayThongTinAdminBangTen($tentaikhoan);
                            $maadmin = $thongtin->maadmin;

                            if(isset($_POST['ngaylencap'])){
                                $ngaylencap = $_POST['ngaylencap'];

                                # thêm mới khi biết mã admin
                                $nhaphanphoi = new nhaphanphoiclass();
                                $nhaphanphoi->ThemNhaPhanPhoiVaCuaHang($hovaten, $sodienthoai, $cmnd, $diachi, $capbac, $tructhuoc, $mahopdong, $macuahang, $hethongnhaphanphoi, $loaikhachhang, $maadmin, $ngaytao);
                                
                                # lay khach hang moi tao
                                $makhachhang = $nhaphanphoi->LayKhachHangMoiTao();
                                $max = $makhachhang->MAX;
                                $nhaphanphoi->ThemNgayLenCap($ngaylencap, $max);

                                header("Location: ../index.php?page=quanlinhaphanphoi&ketqua=themthanhcong");
                            }else{
                                header("Location: ../index.php?page=quanlinhaphanphoi&ketqua=themthanhcong");
                            }

                           
                        }else{
                            # thêm mới khi không lấy được thông tin admin
                            $nhaphanphoi = new nhaphanphoiclass();
                            $nhaphanphoi->ThemNhaPhanPhoiVaCuaHang($hovaten, $sodienthoai, $cmnd, $diachi, $capbac, $tructhuoc, $mahopdong, $macuahang, $hethongnhaphanphoi, $loaikhachhang, 0 , $ngaytao);
                            header("Location: ../index.php?page=quanlinhaphanphoi&ketqua=themthanhcong");
                        }
                    }else{
                        # không nhận được dữ liệu POST qua
                        header("Location: ../index.php?page=quanlinhaphanphoi&ketqua=thongtinrong");
                    }
                }
            break;
            case 'suanhaphanohoi':
                if(isset($_POST['ngaylencap']) && isset($_POST['makhachhang']) && isset($_POST['danghi']) && isset($_POST['hovaten']) && isset($_POST['sodienthoai']) && isset($_POST['diachi']) && isset($_POST['cmnd']) && isset($_POST['tructhuoc']) && isset($_POST['capbac'])){         
                    
                    # gán giá trị
                    $makhachhang = trim($_POST['makhachhang']);
                    $maadmin = trim($_POST['maadmin']);
                    $hovaten = trim($_POST['hovaten']);
                    $sodienthoai = trim($_POST['sodienthoai']);
                    $diachi = trim($_POST['diachi']);
                    $cmnd = trim($_POST['cmnd']);
                    $tructhuoc = trim($_POST['tructhuoc']);
                    $capbac = trim($_POST['capbac']);
                    $capbacsua = trim($_POST['capbac']);
                    $danghi = trim($_POST['danghi']);
                    $danghisua = trim($_POST['danghi']);
                    $ngaysua = date("Y-m-d");
                    $ngaylencap = $_POST['ngaylencap'];
                    $maadminsua = 0;
                    $noidungsua = '';

                    $lichsusua = new suakhachhangclass();

                    if(strlen($hovaten) <= 0 || strlen($sodienthoai) <= 0 || strlen($diachi) <= 0 || strlen($cmnd) <= 0 || strlen($tructhuoc) <= 0 || strlen($capbac) <= 0){
                        header("Location: ../index.php?page=suanhaphanphoi&id=$makhachhang&ketqua=thongtinrong");
                    }else if(isset($_POST['mahopdong']) || isset($_POST['macuahang']) || isset($_POST['hethongnhaphanphoi'])){
                        # nếu những thông tin này được post qua tiến hành thêm những thông tin này luôn
                        $mahopdong = trim($_POST['mahopdong']);
                        $macuahang = trim($_POST['macuahang']);
                        $hethongnhaphanphoi = trim($_POST['hethongnhaphanphoi']);

                        $loaikhachhang = 'khachlaunam';

                        if(isset($_SESSION['admin'])){
                            $tentaikhoan = $_SESSION['admin'];

                            # lấy mã admin
                            $admin = new adminClass();
                            $thongtin = $admin->LayThongTinAdminBangTen($tentaikhoan);
                            $maadminsua = $thongtin->maadmin;

                            # sửa khi biết mã admin
                            $nhaphanphoi = new nhaphanphoiclass();

                            # kiểm tra thông tin sửa de thêm vào lịch sử sửa
                            $thaydoithongtin = $nhaphanphoi->LayThongTinKhachHangBangMa($makhachhang);
                            
                            $makhachhanggoc = $thaydoithongtin->makhachhang;
                            $hovatengoc = $thaydoithongtin->hovaten;
                            $sodienthoaigoc = $thaydoithongtin->sodienthoai;
                            $diachigoc = $thaydoithongtin->diachi;
                            $cmndgoc = $thaydoithongtin->cmnd;
                            $tructhuocgoc = $thaydoithongtin->tructhuoc;
                            $capbacgoc = $thaydoithongtin->capbac;
                            $ngaylencapgoc = $thaydoithongtin->ngaylencap;
                            $danghigoc = $thaydoithongtin->danghi;
                            $mahopdonggoc = $thaydoithongtin->mahopdong;
                            $macuahanggoc = $thaydoithongtin->macuahang;
                            $hethongnhaphanphoigoc = $thaydoithongtin->hethongnhaphanphoi;

                            if(strcmp($hovaten, $hovatengoc) < 0 || strcmp($hovaten, $hovatengoc) > 0){
                                $noidungsua = $noidungsua . 'Họ và tên: <span class="text-danger">'. $hovatengoc .'</span> -> <span class="text-success"><b>' .$hovaten. '</b></span><br>';
                            }
                            if(strcmp($sodienthoai, $sodienthoaigoc) < 0 || strcmp($sodienthoai, $sodienthoaigoc) > 0){
                                $noidungsua = $noidungsua . 'Số điện thoại: <span class="text-danger">'. $sodienthoaigoc .'</span> -> <span class="text-success"><b>' .$sodienthoai. '</b></span><br>';
                            }
                            if(strcmp($diachi, $diachigoc) < 0 || strcmp($diachi, $diachigoc) > 0){
                                $noidungsua = $noidungsua .'Địa chỉ: <span class="text-danger">'. $diachigoc .'</span> -> <span class="text-success"><b>' . $diachi. '</b></span><br>';
                            }
                            if(strcmp($cmnd, $cmndgoc) < 0 || strcmp($cmnd, $cmndgoc) > 0){
                                $noidungsua = $noidungsua .'CMND: <span class="text-danger">'. $cmndgoc .'</span> -> <span class="text-success"><b>' . $cmnd. '</b></span><br>';
                            }
                            if(strcmp($tructhuoc, $tructhuocgoc) < 0 || strcmp($tructhuoc, $tructhuocgoc) > 0){
                                $noidungsua = $noidungsua .'Trực thuộc: <span class="text-danger">'. $tructhuocgoc .'</span> -> <span class="text-success"><b>' . $tructhuoc. '</b></span><br>';
                            }
                            if(strcmp($capbac, $capbacgoc) < 0 || strcmp($capbac, $capbacgoc) > 0){
                                if($capbac == 'le'){
                                    $capbac = "Lẽ";
                                }
                                if($capbac == 'si'){
                                    $capbac = "Sỉ";
                                }
                                if($capbac == 'chinhanh'){
                                    $capbac = "Chi nhánh";
                                }
                                if($capbac == 'daili'){
                                    $capbac = "Đại lí";
                                }
                                if($capbac == 'tongdaili'){
                                    $capbac = "Tổng Đại Lí";
                                }
                                if($capbac == 'nhaphanphoi'){
                                    $capbac = "Nhà phân phối";
                                }
                                if($capbac == 'nhaphanphoivang'){
                                   $capbac = "Nhà phân phối vàng";
                                }
                                if($capbac == 'nhaphanphoikimcuong'){
                                    $capbac = "Nhà phân phối kim cương";
                                }
                                if($capbac == 'giamdockinhdoanh'){
                                   $capbac = "Giám đốc kinh doanh";
                                }

                                if($capbacgoc == 'le'){
                                    $capbacgoc = "Lẽ";
                                }
                                if($capbacgoc == 'si'){
                                    $capbacgoc = "Sỉ";
                                }
                                if($capbacgoc == 'chinhanh'){
                                    $capbacgoc = "Chi nhánh";
                                }
                                if($capbacgoc == 'daili'){
                                    $capbacgoc = "Đại lí";
                                }
                                if($capbacgoc == 'tongdaili'){
                                    $capbacgoc = "Tổng Đại Lí";
                                }
                                if($capbacgoc == 'nhaphanphoi'){
                                    $capbacgoc = "Nhà phân phối";
                                }
                                if($capbacgoc == 'nhaphanphoivang'){
                                   $capbacgoc = "Nhà phân phối vàng";
                                }
                                if($capbacgoc == 'nhaphanphoikimcuong'){
                                    $capbacgoc = "Nhà phân phối kim cương";
                                }
                                if($capbacgoc == 'giamdockinhdoanh'){
                                   $capbacgoc = "Giám đốc kinh doanh";
                                }
                                $noidungsua = $noidungsua .'Cấp bậc: <span class="text-danger">'. $capbacgoc .'</span> -> <span class="text-primary"><b>' . $capbac. '</b></span><br>';
                            }

                            if($ngaylencap == NULL){

                            }else if(strcmp($ngaylencap, $ngaylencapgoc) < 0 || strcmp($ngaylencap, $ngaylencapgoc) > 0){
                                $noidungsua = $noidungsua . 'Ngày lên cấp: <span class="text-danger">'.$ngaylencapgoc .'</span> -> <span class="text-primary"><b>' . $ngaylencap. '</b></span><br>';
                            }
                            if(strcmp($danghi, $danghigoc) < 0 || strcmp($danghi, $danghigoc) > 0){
                                if($danghi == 'danghi'){
                                    $danghi = "Đã nghĩ";
                                }
                                if($danghi == 'chuanghi'){
                                    $danghi = "Chưa nghĩ";
                                }
                                if($danghigoc == 'danghi'){
                                    $danghigoc = "Đã nghĩ";
                                }
                                if($danghigoc == 'chuanghi'){
                                    $danghigoc  = "Chưa nghĩ";
                                }    
                                $noidungsua = $noidungsua . 'Còn bán: <span class="text-danger">'. $danghigoc .'</span> -> <span class="text-success"><b>' . $danghi. '</b></span><br>';
                            }   
                            if(strcmp($mahopdong, $mahopdonggoc) < 0 || strcmp($mahopdong, $mahopdonggoc) > 0){
                                if($mahopdonggoc == NULL){
                                    $mahopdonggoc = 'Thêm mới';
                                }
                                $noidungsua = $noidungsua . 'Mã hợp đồng: <span class="text-danger">'. $mahopdonggoc .'</span> -> <span class="text-success"><b>' . $mahopdong. '</b></span><br>';
                            }
                            if(strcmp($macuahang, $macuahanggoc) < 0 || strcmp($macuahang, $macuahanggoc) > 0){
                                if($macuahanggoc == NULL){
                                    $macuahanggoc = 'Thêm mới';
                                }
                                $noidungsua = $noidungsua . 'Mã cửa hàng: <span class="text-danger">' . $macuahanggoc .'</span> -> <span class="text-success"><b>' . $macuahang. '</b></span><br>';
                            }
                            if(strcmp($hethongnhaphanphoi, $hethongnhaphanphoigoc) < 0 || strcmp($hethongnhaphanphoi, $hethongnhaphanphoigoc) > 0){
                                if($hethongnhaphanphoigoc == NULL){
                                    $hethongnhaphanphoigoc = 'Thêm mới';
                                }
                                $noidungsua = $noidungsua . 'Hệ thống nhà phân phối: <span class="text-danger">'. $hethongnhaphanphoigoc .'</span> -> <span class="text-success"><b>' . $hethongnhaphanphoi. '</b></span><br>';
                            }

                            # sửa có ngày lên cấp
                            if($ngaylencap != NULL){
                                if($noidungsua != ""){
                                    # thêm vào lịch sử sửa
                                    $lichsusua->ThemLichSuSua($maadminsua, $makhachhang, $ngaysua, $noidungsua);
                                }
                              
                                $nhaphanphoi->SuaNhaPhanPhoiVaCuaHang($hovaten, $sodienthoai, $cmnd, $diachi, $capbacsua, $tructhuoc, $mahopdong, $macuahang, $hethongnhaphanphoi, $loaikhachhang, $maadmin, $danghisua, $ngaysua, $ngaylencap, $maadminsua, $makhachhang);
                                header("Location: ../index.php?page=suanhaphanphoi&id=$makhachhang&ketqua=suathanhcong");
                            # sửa khong có ngày lên cấp
                            }else{
                                if($noidungsua != ""){
                                    # thêm vào lịch sử sửa
                                    $lichsusua->ThemLichSuSua($maadminsua, $makhachhang, $ngaysua, $noidungsua);
                                }
                                $nhaphanphoi->SuaNhaPhanPhoiVaCuaHangKhongLenCap($hovaten, $sodienthoai, $cmnd, $diachi, $capbacsua, $tructhuoc, $mahopdong, $macuahang, $hethongnhaphanphoi, $loaikhachhang, $maadmin, $danghisua, $ngaysua, $maadminsua, $makhachhang);
                                header("Location: ../index.php?page=suanhaphanphoi&id=$makhachhang&ketqua=suathanhcong");
                            }
                        }else{
                            header("Location: ../index.php?page=suanhaphanphoi&id=$makhachhang&ketqua=suathatbai");
                        }
                    }
                }else{
                    # không nhận được dữ liệu POST qua
                    header("Location: ../index.php?page=quanlinhaphanphoi&ketqua=thongtinrong");
                }
            break;
            default:
                # code...
                break;
        }
    }else{
        header("Location: ../index.php?page=quanlinhaphanphoi&ketqua=yeucaukhongxacdinh");
    }
    ob_end_flush();
?>