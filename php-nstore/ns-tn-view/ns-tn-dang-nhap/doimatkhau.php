<div class="d-flex justify-content-center" style="margin-top: -130px">
    <!-- FORM DANG NHAP -->
    <div class="col-12 col-sm-8 col-md-7 col-lg-6 col-xl-5">
        <div class="formdangnhap card box border border-white bg-custom">
        <!-- LOGO -->
        <?php require "ns-tn-view/ns-tn-include/logo.php"; ?>

        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-3 text-center">
            <h4><strong><b style="text-shadow: 1px 1px rgb(40, 167, 69);" class="text-success">ĐỔI MẬT KHẨU</b></strong></h4>
        </div>

        <div> <?php require "ns-tn-view/ns-tn-include/message.php"; ?> </div>

        <form action="ns-tn-controller/admin-controller.php?yeucau=doimatkhau" method="post" class="w-100">   
            <div class="form-group inputBox">
                <input type="text" name="tentaikhoan" required title="Không được để trống">
                <label for="" class="text-dark"><b>Tên tài khoản</b></label>
            </div> 
            <div class="form-group inputBox">
                <input type="password" name="matkhaucu" required title="Không được để trống">
                <label for="" class="text-dark"><b>Mật khẩu cũ</b></label>
            </div> 

            <div class="form-group inputBox">
                <div class="input-group eye">
                    <input type="password" name="matkhaumoi" aria-label="" aria-describedby="basic-addon2" id="" required  title="Không được để trống">
                    <label for="" class="text-dark"><b>Mật khẩu mới</b></label>
                </div>
            </div>

            <div class="form-group inputBox">
                <div class="input-group eye">
                    <input type="password" name="nhaplaimatkhaumoi" aria-label="" aria-describedby="basic-addon2" id="" required  title="Không được để trống">
                    <label for="" class="text-dark"><b>Nhập lại mật khẩu mới</b></label>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center ">
                        <button type="submit" class="btn btn-success hvr-buzz btn-dangnhap">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            Đổi mật khẩu
                        </button>
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center ">
                        <a href="/QuanLiBanHang/" class="btn btn-secondary hvr-buzz">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            Về đăng nhập
                        </a>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>  <!-- END FORM DANG NHAP-->
</div>
