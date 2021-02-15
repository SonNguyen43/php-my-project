<?php
    if(isset($_GET['dang_ki'])){
        switch ($_GET['dang_ki']) {
            case 'mat_khau_khong_trung':
                ?>
                    <script>Swal.fire({icon: 'error',title: 'Mật khẩu xác nhận không khớp',showConfirmButton: false,timer: 1500});</script>
                <?php
            break;
            case 'thieu_thong_tin':
                ?>
                    <script>Swal.fire({icon: 'error',title: 'Vui lòng điền đầy đủ thông tin',showConfirmButton: false,timer: 1500});</script>
                <?php
            break;
            case 'tai_khoan_da_ton_tai':
                ?>
                     <script>Swal.fire({icon: 'error',title: 'Tên tài khoản đã tồn tại',showConfirmButton: false,timer: 1500});</script>
                <?php
            break;
        }
    }
    else if(isset($_GET['dang_nhap'])){
        switch ($_GET['dang_nhap']) {
            case 'dang_ki_thanh_cong':
                ?>
                    <script>Swal.fire({icon: 'success',title: 'Đăng kí thành công',showConfirmButton: false,timer: 1500});</script>
                <?php
            break;
        }
    }
?>