<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
<?php
    require "ns-tn-model/nha-phan-phoi-class.php";
    require "ns-tn-model/admin-class.php";

    # tìm thấy tài khoản admin đăng nhập
    if(isset($_SESSION['admin'])){
        ?>
            <!-- TITLE -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                <div class="position-absolute" style="z-index: 999; left: 10px">       
                   
                </div>
    
                <div class="text-center">
                    <h3><strong><b>Quản Lí Nhà Phân Phối</b></strong></h3>
                </div>
            </div>  <!-- END TITLE -->

            <div class="">
                <div class="row">
                    <!-- MENU -->
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-start mt-3">
                        <a class="btn btn-outline-brown dangxuat rounded-pill ml-3" href="index.php">Trở Về</a>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-end mt-3 ">
                        <a href="index.php?page=taomoinhaphanphoi" class=" btn btn-success rounded-pill mr-3">Tạo nhà phân phối</a>
                        <a href="index.php?page=nhaphanphoivacuahang"><img src="ns-tn-public/ns-tn-images/default/pharmacy.png" class="logo rotate mr-3" data-toggle="tooltip" data-placement="top" title="Nhà phân phối có cửa hàng" data-toggle="tooltip" data-placement="top" title="Thống kê" width="32px" height="32px"></a>
                        <button class=" btn btn-secondary text-light rounded-pill mr-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Tìm nhà phân phối
                        </button>
                    </div>  <!-- END MENU -->
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                <!-- TIM KIEM -->
                <div class="collapse card bg-custom" id="collapseExample">
                    <div class="card-header bg-browns text-light" style="border-radius: 30px 30px 0 0">
                        <h6><strong><b>Tìm kiếm</b></strong></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <label for=""><b>Nhập tên: </b></label>
                                <input type="text" id="tenkhachtim" onkeyup="TimKhachHang()" class="form-control rounded-pill">
                            </div>    
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <label for=""><b>Nhập số điện thoại: </b></label>
                                <input type="number" id="sodienthoaikhachtim" onkeyup="TimKhachHang()" class="form-control rounded-pill">
                            </div>  
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <label for=""><b>Chứng minh nhân dân: </b></label>
                                <input type="number" id="cmnd" onkeyup="TimKhachHang()" class="form-control rounded-pill">
                            </div>
                        </div>           
                    </div>
                </div>  <!-- END TIM KIEM -->
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                <!-- TABLE -->
                <div class="table-responsive-lg" id="bangloc">
                    <!-- TABLE -->
                    <table class="table table-hover table-bordered table-sm table-light text-center mb-3">
                        <thead>
                            <tr>
                                <th scope="col" colspan="8">TẤT CẢ NHÀ PHÂN PHỐI</th>
                            </tr>
                            <tr class="bg-browns text-light">
                                <th scope="col">#</th>
                                <th scope="col" style="width: 200px">Họ tên</th>
                                <th scope="col">SĐT</th>
                                <th scope="col">CMND</th>
                                <th scope="col" style="width: 450px">Địa chỉ</th>
                                <th scope="col" style="width: 100px">Cấp bậc</th>
                                <th scope="col">Trực thuộc</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $nhaphanphoi = new nhaphanphoiclass();
                            $thongtin = $nhaphanphoi->LayTatCaNhaPhanPhoiLauNam();
                            $stt = 1;
                        
                            foreach ($thongtin as $tt) {
                                $admin = new adminclass();
                                $thongtinadmin = $admin->LayThongTinAdminBangMa($tt->maadmin);
                        ?>
                            <tr <?php if($tt->danghi == 'danghi') echo 'style="color: #D8D8D8 "' ?>>
                                <th scope="row"><?php echo $stt++; ?></th>
                                <td><b><?php echo $tt->hovaten ?></b></td>
                                <td class="text-danger"><?php echo $tt->sodienthoai; ?></td>
                                <td><i><?php echo $tt->cmnd; ?><i></td>
                                <td><?php echo $tt->diachi; ?></td>
                                <td class="text-danger">
                                <?php 
                                    if($tt->capbac == 'le') echo 'Khách lẻ'; 
                                    else if($tt->capbac == 'si') echo 'Khách sĩ';
                                    else if($tt->capbac == 'chinhanh') echo 'Chi nhánh';  
                                    else if($tt->capbac == 'daili') echo 'Đại lí'; 
                                    else if($tt->capbac == 'tongdaili') echo 'Tổng đại lí'; 
                                    else if($tt->capbac == 'nhaphanphoi') echo 'Nhà phân phối';
                                    else if($tt->capbac == 'nhaphanphoivang') echo 'Nhà phân phối vàng';
                                    else if($tt->capbac == 'nhaphanphoikimcuong') echo 'Nhà phân phối kim cương';
                                    else if($tt->capbac == 'giamdockinhdoanh') echo 'Giám đốc kinh doanh';
                                ?>
                                </td>
                                <td><?php echo $tt->tructhuoc; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#xemthongtinchitiet" onclick="XemThemThongTin('<?php echo $tt->makhachhang;?>','<?php echo $tt->hovaten ?>','<?php echo $tt->mahopdong;?>', '<?php echo $tt->macuahang;?>', '<?php echo $tt->hethongnhaphanphoi;?>', '<?php echo $tt->danghi;?>', '<?php echo $thongtinadmin->hovaten;?>','<?php echo $tt->ngaytao;?>', '<?php echo $tt->ngaysua; ?>' ,'<?php echo $tt->ngaylencap; ?>')">Chi tiết</button>
                                    <a href="index.php?page=suanhaphanphoi&id=<?php echo $tt->makhachhang; ?>" class="btn btn-warning rounded-pill">Sửa</a>
                                    
                                </td>
                            </tr>
                        <?php
                            }
                        
                        ?>
                        </tbody>
                    </table>    <!-- END TABLE -->
                </div>
            </div>
        <?php
    }else{
            # Không tìm thấy tài khoản admin đăng nhập
        ?>
            <div class="alert alert-danger" role="alert">
                Lỗi... Không tìm thấy thông tin tài khoản admin...!
            </div>
        <?php
    }

    # gọi modal xem thêm thông tin nhà phân phối
    require "modal/modal-xem-thong-tin.php"
?>
