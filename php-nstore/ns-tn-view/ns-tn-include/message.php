<!-- <div class="row">
    <div class="col-md-12 mt-3">
        <?php
            if(isset($_GET['ketqua'])){
                $ketqua = $_GET['ketqua'];
                    # Nhận biến kết quả và kiểm tra để in ra thông báo
                switch ($ketqua) {
                    case 'yeucaukhongxacdinh':
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show rounded-pill" role="alert" id="message" >
                            <strong>Thất bại!</strong> không xác định được được yêu cầu..!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    break;
                    case 'dangnhapthatbai':
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert" id="message" >
                            <strong>Thất bại!</strong> sai tên tài khoản hoặc mật khẩu..!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    break;
                    case 'dangnhapthanhcong':
                    ?>
                        <div class="alert alert-success alert-dismissible fade show rounded-pill" role="alert" id="message" >
                            <strong>Thành công!</strong> bạn đang đăng nhập với tài khoản quản trị..!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    break;
                    case 'thongtinrong':
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert" id="message" >
                            <strong>Thất bại!</strong> thông tin không được để rỗng..!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    break;
                    case 'themthanhcong':
                    ?>
                        <div class="alert alert-success alert-dismissible fade show rounded-pill" role="alert" id="message" >
                            <strong>Thành công!</strong> đã thêm..!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    break;
                    case 'themthatbai':
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert" id="message" >
                                <strong>TThất bại! </strong> Thao tác không thành công..!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                        break;
                    case 'suathanhcong':
                    ?>
                        <div class="alert alert-success alert-dismissible fade show rounded-pill" role="alert" id="message" >
                            <strong>Thành công!</strong> đã sửa..!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    break;
                    case 'suathatbai':
                        ?>
                            <div class="alert alert-success alert-dismissible fade show rounded-pill" role="alert" id="message" >
                                <strong>Thất bại!</strong> thao tác chưa được thực hiện..!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                    break;
                    case 'xoathanhcong':
                    ?>
                        <div class="alert alert-success alert-dismissible fade show rounded-pill" role="alert" id="message" >
                            <strong>Thành công!</strong> đã xóa..!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    break;
                    case 'datontaimonhang':
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert" id="message" >
                            <strong>Thất bại!</strong> món hàng đã có trong giỏ hàng, bạn có thể thay đổi thông tin tại giỏ hàng..!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    break;
                    case 'thieuthongtin':
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert" id="message" >
                                <strong>Thất bại!</strong> Vui lòng điền đầy đủ thông tin..!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                    break;
                    case 'saithongtincu':
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert" id="message" >
                                <strong>Thất bại!</strong> Sai tên tài khoản hoặc mật khẩu cũ
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                    break;
                    case 'khongtrungmatkhau':
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert" id="message" >
                                <strong>Thất bại!</strong> Mật khẩu nhập lại không trùng nhau
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                    break;
                    case 'doimatkhauthanhcong':
                        ?>
                            <div class="alert alert-success alert-dismissible fade show rounded-pill" role="alert" id="message" >
                                <strong>Thành công!</strong> Đã thay đổi thành công
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                    break;
                }
            }else{

            }
        ?>
    </div>
</div>
 -->
