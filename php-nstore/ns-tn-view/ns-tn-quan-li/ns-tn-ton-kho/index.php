<?php
    require "ns-tn-model/nha-phan-phoi-class.php";
    require "ns-tn-model/admin-class.php";
    require "ns-tn-model/don-hang-class.php";
    require "ns-tn-model/cthh-hang-ton-class.php";
    require "ns-tn-model/hang-ton-class.php";
    require "ns-tn-model/hang-hoa-class.php";

    # tìm thấy tài khoản admin đăng nhập
    if(isset($_SESSION['admin'])){
        ?>
            <!-- TITLE -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                <div class="position-absolute" style="z-index: 999; left: 10px">       
                    
                </div>
    
                <div class="text-center">
                    <h4><strong><b>Quản Lí Tồn Kho</b></strong></h4>
                </div>
            </div>  <!-- END TITLE -->

            <div class="">
                <div class="row">
                    <!-- MENU -->
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-start mt-3">
                    <a class="btn btn-outline-brown dangxuat rounded-pill ml-3" href="index.php">Trở Về</a>
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-end mt-3 ">
                        <a href="index.php?page=taomoihangton" class=" btn btn-success rounded-pill mr-3">Tạo đơn cập nhật hàng tồn</a>
                        <button class=" btn btn-secondary text-light rounded-pill mr-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Tìm đơn hàng tồn
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
                        <form action="">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <label for=""><b>Nhập tên: </b></label>
                                    <input type="text" id="tenkhachtim" onkeyup="TimDonHangTon()" class="form-control rounded-pill">
                                </div>    
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <label for=""><b>Nhập số điện thoại: </b></label>
                                    <input type="number" id="sodienthoaikhachtim" onkeyup="TimDonHangTon()" class="form-control rounded-pill">
                                </div>  
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <label for=""><b>Ngày bắt đầu: </b></label>
                                    <input type="date" id="ngaybatdautim" onkeyup="TimDonHangTon()" class="form-control rounded-pill">
                                </div>  
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <label for=""><b>Ngày kết thúc: </b></label>
                                    <input type="date" id="ngayketthuctim" onkeyup="TimDonHangTon()" class="form-control rounded-pill">
                                </div>  

                                <button type="button" class="btn btn-primary mt-3 ml-3 rounded-pill" onclick="TimDonHangTon()">Tìm</button>
                                <button type="reset" class="btn btn-success mt-3 ml-3 rounded-pill" onclick="TimDonHangTon()">Làm trống ô tìm kiếm</button>
                            </div> 
                        </form>
                       
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
                                <th scope="col" colspan="5">TẤT CẢ ĐƠN HÀNG TỒN</th>
                            </tr>
                            <tr class="bg-browns text-light">
                                <th scope="col">#</th>
                                <th scope="col">Họ tên</th>
                                <th scope="col">Hàng hóa còn tồn</th>
                                <th scope="col">Ngày kiểm kê</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $stt = 1;

                            $hangton = new hangtonclass();
                            $thongtin = $hangton->LayTatCaHangTon();
                        
                            foreach ($thongtin as $tt) {
                        ?>
                            <tr>
                                <th scope="row" class="font-weight-normal"><?php echo $stt++; ?></th>
                                <th scope="col" class="font-weight-normal"><?php echo $tt->hovaten; ?></th>
                                <th scope="col" class="font-weight-normal">
                                    <?php
                                        $chitiet = new cthhhtclass();
                                        $thongtinchitiet = $chitiet->LayHangHoaCuaDonHang($tt->mahangton);
                                        
                                        foreach ($thongtinchitiet as $ttct) {
                                            echo "<strong> <span class='text-success'>" .  $hangton->LayHangTonTheoMa($ttct->mahanghoa)->tenhanghoa . "</span>: <span>" . $ttct->soluong . "</span></strong><br>";
                                        }
                                    ?>
                                </th>
                                <th scope="col" class="font-weight-normal">
                                <?php 
                                    echo date("d-m-Y", strtotime($tt->ngaytaohangton));  
                                ?>
                                </th>
                                <th scope="col" class="font-weight-normal">

                                    <?php
                                        # lấy tên admin để show bằng modal
                                        $admin = new adminclass();
                                        $thongtin = $admin->LayThongTinAdminBangMa($tt->maadmin);
                                        $tenadmin = $thongtin->hovaten;
                                    ?>

                                    <button type="button" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#chitietdonhang" onclick="ChiTietDonHangTon('<?php echo $tenadmin?>')">Chi tiết</button>
                                    <a href="index.php?page=suadonhangton&id=<?php echo $tt->makhachhang?>&mahangton=<?php echo $tt->mahangton?>" class="btn btn-warning rounded-pill">Sửa</a>
                                </th>
                                
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
    require "modal/modal-chi-tiet-don-hang.php"
?>

