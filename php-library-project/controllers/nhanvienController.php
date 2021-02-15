<?php
    ob_start();
    session_start(); 

    # gọi model nhanvien để sử dụng những hàm đã được xây dựng
    require "../models/nhanvien.php";

    # nhận được yêu cầu 
    # isset là để kiểm tra tồn tại cua biến
    if(isset($_GET['yeucau'])){
        switch ($_GET['yeucau']) {
            case 'dangnhap':
                # nhận được đủ 2 dữ liệu để tiến hành kiểm tra
                if (isset($_POST['sodienthoai']) && isset($_POST['matkhau'])) {
                    # lấy user và pass được post qua
                    $sodienthoai = $_POST["sodienthoai"];
                    $matkhau = $_POST["matkhau"];

                    # mã hóa mật khẩu md5
                    $md5 = md5($matkhau, false);

                    ## check đăng nhập
                    # tạo một đối tượng nhân viên mới (OBB) - và sử dụng hàm dangnhap() được xây dựng ở model nhanvien.php
                    $nhanvien = new nhanvien();
                    # $kiemtra đang chưa mã nhân viên
                    $kiemtra = $nhanvien->dangnhap($sodienthoai, $md5);

                    # trả về session nếu tên đăng nhập và mật khẩu chính xác
                    # kiemtra đang chứa mã nhân viên
                    if($kiemtra != NULL){
                        $ma_nhan_vien = $kiemtra;
                        # SESSION là để đăng nhập || COOKIE nhớ đăng nhập
                        $_SESSION['nhanvien'] = $ma_nhan_vien;
                        header("Location: ../?da_dang_nhap");
                    }else{
                        header("Location: ../?that_bai");
                    }
                }
                # nhận không đủ 2 dữ liệu
                else{

                }
            break;
            case 'dangxuat':
                session_destroy();
                header("Location: ../");
            break;

            default:
                break;
        }
    }
    # không nhận được yêu cầu
    else{
        header("Location: ../");
    }
    ob_end_flush();
?>