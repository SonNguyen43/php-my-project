<?php
    require "ns-tn-model/nha-phan-phoi-class.php";
    require "ns-tn-model/admin-class.php";

    if(isset($_GET['id'])){
        $makhachhang = $_GET['id'];

        $nhaphanphoi = new nhaphanphoiclass();
        $thongtin = $nhaphanphoi->LayThongTinKhachHangBangMa($makhachhang);

        if($thongtin == NULL || $thongtin == ""){
           ?>
                <div class="alert alert-warning" role="alert">
                    <strong>Thất bại</strong>... Không tìm thấy tài khoản này...!
                </div>
           <?php
        }else{
            ?>
                <div class="row">
                    <!-- TITLE -->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                        <div class="position-absolute" style="z-index: 999; left: 10px">       
                            
                        </div>
            
                        <div class="text-center">
                            <h3><strong><b>Sửa Nhà Phân Phối</b></strong></h3>
                        </div>
                    </div>  <!-- END TITLE -->
                    
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-3">
                        <!-- FORM SUA -->
                        <div class="card p-3 form-sua-khach bg-custom">
                            <form action="ns-tn-controller/nha-phan-phoi-controller.php?yeucau=suanhaphanohoi" method="POST">
                                <div class="form-group">
                                    <input type="text" name="makhachhang" value="<?php echo $thongtin->makhachhang; ?>" class="form-control rounded-pill d-none" title="Không được bỏ rỗng trường này" required readonly>
                                    <input type="text" name="maadmin" value="<?php echo $thongtin->maadmin; ?>" class="form-control rounded-pill d-none" title="Không được bỏ rỗng trường này" required readonly>
                                    <label for=""><b>Họ và tên:</b> (<span class="need">*</span>)</label>
                                    <input type="text" name="hovaten" value="<?php echo $thongtin->hovaten; ?>" class="form-control rounded-pill" title="Không được bỏ rỗng trường này" required>
                                </div>
                                <div class="form-group">
                                    <label for=""><b>Số điện thoại:</b> (<span class="need">*</span>)</label>
                                    <input type="number" name="sodienthoai" value="<?php echo $thongtin->sodienthoai; ?>" class="form-control rounded-pill" title="Không được bỏ rỗng trường này" required>
                                </div>
                                <div class="form-group">
                                    <label for=""><b>Địa chỉ:</b> (<span class="need">*</span>)</label>
                                    <input type="text" name="diachi" value="<?php echo $thongtin->diachi; ?>" class="form-control rounded-pill" title="Không được bỏ rỗng trường này" required>
                                </div>
                                <div class="form-group">
                                    <label for=""><b>CMND:</b> (<span class="need">*</span>)</label>
                                    <input type="number" name="cmnd" value="<?php echo $thongtin->cmnd; ?>" class="form-control rounded-pill" title="Không được bỏ rỗng trường này" required>
                                </div>
                                <div class="form-group">
                                    <label for=""><b>Trực thuộc:</b>(<span class="need">*</span>)</label>
                                    <input type="text" name="tructhuoc" value="<?php echo $thongtin->tructhuoc; ?>" class="form-control rounded-pill" title="Không được bỏ rỗng trường này" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-dark"><b>Cấp bậc:</b> (<span class="need">*</span>)</label>
                                    <select name="capbac" class="form-control rounded-pill">
                                        <option value="le" <?php if($thongtin->capbac == 'le') echo 'selected'?>>Lẻ</option>
                                        <option value="chinhanh" <?php if($thongtin->capbac == 'chinhanh') echo 'selected'?>>Chi nhánh</option>
                                        <option value="daili" <?php if($thongtin->capbac == 'daili') echo 'selected'?>>Đại lí</option>
                                        <option value="tongdaili" <?php if($thongtin->capbac == 'tongdaili') echo 'selected'?>>Tổng đại lí</option>
                                        <option value="nhaphanphoi" <?php if($thongtin->capbac == 'nhaphanphoi') echo 'selected'?>>Nhà phân phối</option>
                                        <option value="nhaphanphoivang" <?php if($thongtin->capbac == 'nhaphanphoivang') echo 'selected'?>>Nhà phân phối vàng</option>
                                        <option value="nhaphanphoikimcuong" <?php if($thongtin->capbac == 'nhaphanphoikimcuong') echo 'selected'?>>Nhà phân phối kim cương</option>
                                        <option value="giamdockinhdoanh" <?php if($thongtin->capbac == 'giamdockinhdoanh') echo 'selected'?>>Giám đốc kinh doanh</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for=""><b>Ngày lên cấp:</b></label>
                                    <input type="date" name="ngaylencap" class="form-control rounded-pill" title="có thể bỏ trống ô này (tháng-ngày-năm)" value="<?php echo $thongtin->ngaylencap; ?>">
                                </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-3">
                        <div class="card p-3 bg-custom">
                            <div class="form-group">
                                    <label for=""><b>Còn bán: </b></label>
                                    <select name="danghi" class="custom-select my-1 mr-sm-2 rounded-pill" id="inlineFormCustomSelectPref">
                                        <option value="chuanghi" <?php if($thongtin->danghi == 'chuanghi') echo 'selected'?>>Chưa nghĩ</option>
                                        <option value="danghi" <?php if($thongtin->danghi == 'danghi') echo 'selected'?>>Đã nghĩ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for=""><b>Mã hợp đồng:</b></label>
                                    <input type="text" name="mahopdong" value="<?php echo $thongtin->mahopdong; ?>" class="form-control rounded-pill" title="Có thể bỏ trống">
                                </div>
                                <div class="form-group">
                                    <label for=""><b>Mã cửa hàng: </b></label>
                                    <input type="text" name="macuahang" value="<?php echo $thongtin->macuahang; ?>" class="form-control rounded-pill" title="Có thể bỏ trống">
                                </div>
                                <div class="form-group">
                                    <label for=""><b>Hệ thống nhà phân phối:</b></label>
                                    <input type="text" name="hethongnhaphanphoi" value="<?php echo $thongtin->hethongnhaphanphoi; ?>" class="form-control rounded-pill" title="Có thể bỏ trống">
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="d-flex justify-content-start col">
                                            <a class="btn btn-outline-brown dangxuat rounded-pill" href="index.php?page=quanlinhaphanphoi">Trở Về</a>
                                        </div>
                                        <div class="d-flex justify-content-end col">
                                            <a href="index.php?page=quanlinhaphanphoi" class="btn btn-warning mr-3 rounded-pill">Hủy bỏ</a>
                                            <input type="submit" value="Sửa thông tin" class="btn btn-success hvr-bounce-out rounded-pill">
                                        </div>
                                    </div>
                                    
                                        
                                    </div>
                                </div>
                            </form>     <!-- END FORM SUA-->

                            <!-- THONG TIN NGUOI CAP NHAT -->
                            <div class="jumbotron mt-3 p-3" style="border-radius: 30px">
                                <?php 
                                    $admin = new adminclass();
                                    $thongtinadmin = $admin->LayThongTinAdminBangMa($thongtin->maadminsua);
                                ?>
                                <label for=""><b>Ngày sửa:</b></label><span><?php echo " " . $thongtin->ngaysua ?></span> <br>
                                <label for=""><b>Người sửa:</b></label><span><?php if($thongtinadmin != NULL || $thongtinadmin != "") echo " " . $thongtinadmin->hovaten ?></span>
                            </div>  <!-- END THONG TIN NGUOI CAP NHAT -->
                        </div>
                    </div>
                </div>    
            <?php
        }
    }else{
        # Không tìm thấy tài khoản được GET qua
    ?>
        <div class="alert alert-danger" role="alert">
            Lỗi... Không tìm thấy thông tin tài khoản cần sửa...!
        </div>
    <?php
    }
?>