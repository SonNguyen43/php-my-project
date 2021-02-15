<?php
    ob_start();
    session_start();

    require "../ns-tn-model/admin-class.php";   

    if(isset($_GET["yeucau"])){
        $yeucau = $_GET["yeucau"];

        switch ($yeucau) {
            case 'dangxuat':
                # Thoát khỏi session khi đã đăng nhập
                session_destroy();
                header("Location: ../index.php");
            break;
            case 'dangnhap':
                if(isset($_POST["tentaikhoan"]) && isset($_POST["matkhau"])){
                   
                    # lấy user và pass được post qua
                    $tentaikhoan = $_POST["tentaikhoan"];
                    $matkhau = $_POST["matkhau"];

                    # mã hóa mật khẩu
                    $md5 = md5($matkhau, false);

                    # check đăng nhập xem phải là admin
                    $admin = new adminclass();
                    $revalue_admin = $admin->CheckDangNhap($tentaikhoan, $md5);

                    # trả về session nếu tên đăng nhập và mật khẩu chính xác
                    if($revalue_admin != NULL){
                        $_SESSION['admin'] = $tentaikhoan;

                        header("Location: ../index.php?page=quanli&ketqua=dangnhapthanhcong");
                    }else{
                        header("Location: ../index.php?ketqua=dangnhapthatbai");
                    }
                }else{
                    # nếu không nhận được tai khoan mat khau post qua
                    header("Location: ../index.php?ketqua=taikhoankhongxacdinh");
                }
            break;
            case "doimatkhau":
                if(isset($_POST["tentaikhoan"]) && isset($_POST["matkhaucu"]) && isset($_POST["matkhaumoi"]) && isset($_POST["nhaplaimatkhaumoi"])){
                    $tentaikhoan = trim($_POST['tentaikhoan']);
                    $matkhaucu = trim($_POST['matkhaucu']);
                    $matkhaumoi = trim($_POST['matkhaumoi']);
                    $nhaplaimatkhaumoi = trim($_POST['nhaplaimatkhaumoi']);

                    if ($tentaikhoan != '' && $matkhaucu != '' && $matkhaumoi != '' && $nhaplaimatkhaumoi != '') {
                        $md5 = md5($matkhaucu, false);
                        $admin = new adminclass();
                        
                        $count = $admin->CheckMatKhauCu($tentaikhoan, $md5);

                        # đã nhập đúng tên tài khoản và mật khẩu cũ
                        if($count == 1){
                            $maadmin = $admin->LayThongTinAdminBangTen($tentaikhoan)->maadmin;
                            #kiểm tra mật khẩu mới có trùng không
                            if($matkhaumoi == $nhaplaimatkhaumoi){
                                $admin->SuaThongTinMatKhau(md5($matkhaumoi,false), $maadmin);
                                header("Location: ../?page=doimatkhau&ketqua=doimatkhauthanhcong");
                            }else{
                                header("Location: ../?page=doimatkhau&ketqua=khongtrungmatkhau");
                            }
                        }else{
                            header("Location: ../?page=doimatkhau&ketqua=saithongtincu");
                        }


                    }else{
                        header("Location: ../?page=doimatkhau&ketqua=thieuthongtin");
                    }

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