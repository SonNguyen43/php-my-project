<?php
    require "ns-tn-model/nha-phan-phoi-class.php";

    if(isset($_SESSION['admin'])){
        ?>
        <div class="row">
            <!-- TITLE -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                <div class="position-absolute" style="z-index: 999; left: 10px">       
                   
                </div>
    
                <div class="text-center">
                    <h3><strong><b>Tạo Mới Nhà Phân Phối</b></strong></h3>
                </div>
            </div>  <!-- END TITLE -->
              
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-3">
                <div class="card p-3 form-them-khach bg-custom mb-3">

                <h6 class="d-flex justify-content-center text-danger mt-2 mb-2 w-100" id="showthongtinsodienthoai"></h6>
                    <!-- FORM THEM -->
                    <form action="ns-tn-controller/nha-phan-phoi-controller.php?yeucau=themnhaphanphoi" method="POST">
                        <div class="form-group">
                            <label for=""><b>Họ và tên:</b> (<span class="need">*</span>)</label>
                            <input type="text" name="hovaten" class="form-control rounded-pill" title="Không được bỏ rỗng trường này" required>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Số điện thoại:</b> (<span class="need">*</span>)</label>
                            <input type="number" name="sodienthoai" id="sodienthoaicheck" onkeyup="CheckSoDienThoai()" class="form-control rounded-pill" title="Không được bỏ rỗng trường này" required> 
                        </div>
                        <div class="form-group">
                            <label for=""><b>Địa chỉ:</b> (<span class="need">*</span>)</label>
                            <input type="text" name="diachi" class="form-control rounded-pill" title="Không được bỏ rỗng trường này" required>
                        </div>
                        <div class="form-group">
                            <label for=""><b>CMND:</b> (<span class="need">*</span>)</label>
                            <input type="number" name="cmnd" class="form-control rounded-pill" title="Không được bỏ rỗng trường này" required>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Trực thuộc:</b>(<span class="need">*</span>)</label>
                            <input type="text" name="tructhuoc" class="form-control rounded-pill" title="Không được bỏ rỗng trường này" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="text-dark"><b>Cấp bậc:</b> (<span class="need">*</span>)</label>
                            <select name="capbac" class="form-control rounded-pill">
                                <option value="si">Sĩ</option>
                                <option value="le">Lẻ</option>
                                <option value="chinhanh">Chi nhánh</option>
                                <option value="daili">Đại lí</option>
                                <option value="tongdaili">Tổng đại lí</option>
                                <option value="nhaphanphoi">Nhà phân phối</option>
                                <option value="nhaphanphoivang">Nhà phân phối vàng</option>
                                <option value="nhaphanphoikimcuong">Nhà phân phối kim cương</option>
                                <option value="giamdockinhdoanh">Giám đốc kinh doanh</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Ngày lên cấp:</b> (<span class="need">*</span>)</label>
                            <input type="date" name="ngaylencap" class="form-control rounded-pill" title="Không được bỏ rỗng trường này (tháng-năm-ngày)" required>
                        </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-3">
                <div class="card p-3 bg-custom">
                    <div class="form-group">
                            <label for=""><b>Mã hợp đồng:</b></label>
                            <input type="text" name="mahopdong" class="form-control rounded-pill" title="Có thể bỏ trống">
                        </div>
                        <div class="form-group">
                            <label for=""><b>Mã cửa hàng: </b></label>
                            <input type="text" name="macuahang" class="form-control rounded-pill" title="Có thể bỏ trống">
                        </div>
                        <div class="form-group">
                            <label for=""><b>Hệ thống nhà phân phối:</b></label>
                            <input type="text" name="hethongnhaphanphoi" class="form-control rounded-pill" title="Có thể bỏ trống">
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center mt-3">
                                    <input type="reset" class="btn btn-danger rounded-pill mr-3" value="Làm trống">
                                    <a class="btn btn-outline-brown dangxuat rounded-pill" href="index.php?page=quanlinhaphanphoi">Trở Về</a>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center mt-3">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="index.php?page=quanlinhaphanphoi" class="btn btn-warning rounded-pill mr-3">Hủy bỏ</a>
                                        <input type="submit" value="Thêm mới" class="btn btn-success rounded-pill">
                                    </div>                     
                                </div>
                            </div>
                        </div>
                    </form>     <!-- END FORM THEM -->
                </div>
            </div>
        </div>      
        <?php
    }else{
        ?>
            <div class="alert alert-danger" role="alert">
                Lỗi... Không tìm thấy thông tin tài khoản admin...!
            </div>
        <?php
    }
?>
        