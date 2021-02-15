<?php
    ob_start();
    session_start(); 

    # gọi model USER để sử dụng những hàm đã được xây dựng
    require "../models/user.php";
    require "../models/cart.php";

    # nhận được yêu cầu 
    if(isset($_GET['yeucau'])){
        switch ($_GET['yeucau']) {
            case 'dangki':
                # tên biến $ten_ben trong php
                $display_name = $_POST['display_name'];
                $user_name = $_POST['user_name'];
                $email = $_POST['email'];
                $phone_number = $_POST['phone_number'];

                $password = $_POST['password'];
                $password_confirm = $_POST['password_confirm'];

                # sử dụng model để thêm
                $user = new User();

                #kiểm tra tên tài khoản đã tồn tại chưa
                $count_user_name = $user->CheckUserName($user_name);

                # kiểm tra 2 điều kiện
                # 1. kiểm tra dữ liệu có trỗng không (strlen)
                # 2. mật khẩu có trunng nhau không

                # điều kiện sai
                if(trim($display_name) == '' || trim($user_name) == '' || trim($email) == '' || trim($phone_number) == '' || trim($password) == '' || trim($password_confirm) == ''){
                    header("Location: ../?dang_ki=thieu_thong_tin");
                }else if($count_user_name > 0){
                    header("Location: ../?dang_ki=tai_khoan_da_ton_tai");
                }
                else{
                     # điều kiện sai
                    if ($password != $password_confirm) {
                        header("Location: ../?dang_ki=mat_khau_khong_trung");
                    }else{
                        $user->AddUser($display_name,$email,$phone_number,$user_name,md5($password));

                        $maxID = $user->MaxUserID()->id;
                        $cart = new Cart();
                        $cart->AddCartForUser($maxID);
                        header("Location: ../?dang_nhap=dang_ki_thanh_cong");
                    }
                }
            break;
            case 'dangnhap':
                # nhận được đủ 2 dữ liệu để tiến hành kiểm tra
                if (isset($_POST['user_name']) && isset($_POST['password'])) {
                    # lấy user và pass được post qua
                    $user_name = $_POST["user_name"];
                    $password = $_POST["password"];

                    # mã hóa mật khẩu md5
                    $md5 = md5($password);

                    # check đăng nhập
                    $user = new User();
                    $kiemtra = $user->DangNhap($user_name, $md5);

                    # trả về session nếu tên đăng nhập và mật khẩu chính xác
                    # kiểm tra lúc này là id của user đăng nhập được trả về từ hàm DangNhap()
                    if($kiemtra != NULL){

                        $user_info = $user->UserInfo($kiemtra);

                        # user đăng nhập
                        if($user_info->user_type == 'user'){
                            # đăng nhập bằng SESSION
                            $_SESSION['user'] = $kiemtra;

                            header("Location: ../?trang_chu");
                        }else{
                            #admin đăng nhập
                            $_SESSION['admin'] = $kiemtra;
                            header("Location: ../?trang_chu");
                        }
                    }else{
                        header("Location: ../?dang_nhap");
                    }
                }
                # nhận không đủ 2 dữ liệu
                else{
                    header("Location: ../?dang_nhap");
                }
            break;
            case 'dangxuat':
                session_destroy();
                header("Location: ../");
            break;
            case 'dangkichoadmin':
                # tên biến $ten_ben trong php
                $display_name = $_POST['display_name'];
                $password = $_POST['password'];
                $user_name = $_POST['user_name'];
                $email = $_POST['email'];
                $phone_number = $_POST['phone_number'];
                $sex = $_POST['sex'];
                $birthday = $_POST['birthday'];
                $ship_address = $_POST['ship_address'];

                # sử dụng model để thêm
                $user = new User();

                #kiểm tra tên tài khoản đã tồn tại chưa
                $count_user_name = $user->CheckUserName($user_name);

                if($count_user_name > 0){
                    
                }else{
                    #kiểm tra tên tài khoản đã tồn tại chưa
                    $userforadmin = $user->AddUserForAdmin($user_name,md5($password),$display_name,$email,$phone_number,$sex,$birthday,$ship_address);
                }
            break;
            case 'sua':
                    if (isset($_POST['id'])  && isset($_POST['display_name'])  && isset($_POST['email'])  && isset($_POST['phone_number']) 
                    && isset($_POST['sex'])  && isset($_POST['birthday']) && isset($_POST['ship_address'])) {
                        
                        $id = $_POST['id'];
                        $display_name = $_POST['display_name'];
                        $email = $_POST['email'];
                        $phone_number = $_POST['phone_number'];
                        $sex = $_POST['sex'];
                        $birthday = $_POST['birthday'];
                        $ship_address = $_POST['ship_address'];
    
                        $user = new User();
                        $user -> EditUser($display_name,$email,$phone_number,$sex,$birthday,$ship_address,$id);
                    }else{
                        echo "Không nhận đủ thông tin";
                    }
            break;
            case 'xoa':
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];

                    $user = new User();

                    $user->DeleteUser($id);
                }
            break;

            case 'suamatkhau':
                if (isset($_POST['id']) && isset($_POST['password_new']) && isset($_POST['password'])) {
                    $id = $_POST['id'];
                    $password = $_POST['password'];
                    $password_new = $_POST['password_new'];

                    $user = new User();

                    $count = $user->CheckOldPassword(md5($password),$id);

                    if($count <= 0){
                        // trả về không được sửa
                        $data = array(
                            'result'          =>      "0",
                        );
                    }else{
                        //  trả về được sửa
                        $data = array(
                            'result'          =>      "1",
                        );
            
                        // sửa
                        $user->EditPassword(md5($password_new),$id);
                    }
                    
                    echo json_encode($data);
                }
            break;

            case 'doiavatar':
                if (isset($_POST['user_id']) && isset($_POST) && !empty($_FILES['avatar'])) {
                    $user_id = $_POST['user_id'];

                     // xóa ảnh cũ
                    $user = new User();
                    $image = $user->UserInfo($user_id)->avatar;
                    unlink('../views/quanli/user/avatar/' . $image);
                   
                    // tiến hành upload ảnh mới
                    $fileName = rand() . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], '../views/quanli/user/avatar/' . $fileName);
            
                    // thêm thông tin mới
                    $user = new User();
                    $user->EditAvatar($fileName,$user_id);

                    $data = array(
                        'result'          =>      $fileName,
                    );
        
                    echo json_encode($data);
                }else{
                    echo "Fail";
                }
            break;
            // default:
            //     break;
        }
    }
    # không nhận được yêu cầu
    else{
        header("Location: ../?dangnhapthatbai");
    }
    ob_end_flush();
?>