<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>

<?php
    require "ns-tn-model/nha-phan-phoi-class.php";
    require "ns-tn-model/admin-class.php";
    require "ns-tn-model/don-hang-class.php";
    require "ns-tn-model/cthh-don-hang-class.php";
    require "ns-tn-model/hang-hoa-class.php";

    # tìm thấy tài khoản admin đăng nhập
    if(isset($_SESSION['admin'])){
        ?>
            <!-- TITLE -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                <div class="text-center">
                    <h3><strong><b>Quản Lí Xuất Kho</b></strong></h3>
                </div>
            </div>  <!-- END TITLE -->

            <div class="">
                <div class="row">
                    <!-- MENU -->
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-start mt-3">
                        <a class="btn btn-outline-brown dangxuat rounded-pill ml-3" href="index.php">Trở Về</a>
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-end mt-3">
                        <a href="index.php?page=taomoidonhang" class="rounded-pill btn btn-success d-inline mr-4">Tạo đơn hàng mới</a>
                        <a href="index.php?page=thongke" class="tooltips mr-4 d-inline" style="margin-top:3px;">
                            <img src="ns-tn-public/ns-tn-images/default/pie-chart.png" class="logo rotate" data-toggle="tooltip" data-placement="top" title="Thống kê xuất kho" width="32px" height="32px">
                        </a>
                        <button class="d-inline btn btn-secondary text-light mr-3 rounded-pill" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Tìm đơn hàng
                        </button>
                    </div> 
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
                            <!-- TÌM NHỮNG THÔNG TIN CƠ BẢN -->
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    <label for=""><b>Mã bill: </b></label>
                                    <input type="text" id="mabill" onkeyup="TimDonHang()" class="form-control rounded-pill">
                                </div>  
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    <label for=""><b>Nhập tên: </b></label>
                                    <input type="text" id="tenkhachtim" onkeyup="TimDonHang()" class="form-control rounded-pill">
                                </div>    
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    <label for=""><b>Nhập số điện thoại: </b></label>
                                    <input type="number" id="sodienthoaikhachtim" onkeyup="TimDonHang()" class="form-control rounded-pill">
                                </div>  
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <label for=""><b>Ngày bắt đầu: </b></label>
                                    <input type="date" id="ngaybatdautim" onkeyup="TimDonHang()" class="form-control rounded-pill">
                                </div>  
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <label for=""><b>Ngày kết thúc: </b></label>
                                    <input type="date" id="ngayketthuctim" onkeyup="TimDonHang()" class="form-control rounded-pill">
                                </div>  

                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary mt-3 ml-3 rounded-pill" onclick="TimDonHang()">Tìm</button>
                                    <button type="reset" class="btn btn-success mt-3 ml-3 rounded-pill" onclick="TimDonHang()">Làm trống ô tìm kiếm</button>
                                </div>
                                
                            </div> 
                            <hr>    
                            <div class="row d-block">
                                <!-- TÌM NGÀY SẢN XUẤT CỦA HÀNG HÓA -->
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 ">
                                    <label for=""><b>Ngày sản xuất của sản phẩm: </b></label>
                                    <input type="date" id="ngaysanxuatsanpham" onkeyup="TimDonHangVoiNgaySanXuat()" class="form-control rounded-pill">
                                </div>
                                <button type="button" class="btn btn-primary mt-3 ml-3 rounded-pill" onclick="TimDonHangVoiNgaySanXuat()">Tìm</button>
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
                                <th scope="col" colspan="7">TẤT CẢ ĐƠN HÀNG</th>
                            </tr>
                            <tr class="bg-browns text-light">
                                <th scope="col">#</th>
                                <th scope="col" style="width: 200px">Họ tên</th>
                                <th scope="col">SĐT</th>
                                <th scope="col" style="width: 450px">Địa chỉ</th>
                                <th scope="col" style="width: 250px">Tên sp & số lượng</th>
                                <th scope="col">Ghi chú</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $stt = 1;

                            $donhang = new donhangclass();
                            $thongtin = $donhang->LayTatCaDonHang();
                        
                            foreach ($thongtin as $tt) {
                        ?>
                            <tr>
                                <th scope="row" class="font-weight-normal"><?php echo $stt++; ?></th>
                                <th scope="row" class="font-weight-normal"><b><?php echo $tt->hovaten; ?><b></th>
                                <th scope="row" class="font-weight-normal text-danger"><?php echo $tt->sodienthoai; ?></th>
                                <th scope="row" class="font-weight-normal"><?php echo $tt->diachi; ?></th>
                                <th scope="row" class="font-weight-normal">
                                    <?php 
                                        # lấy chi tiết đơn hàng thông qua mã đơn hàng
                                        $chitiet = new cthhdhclass();
                                        $sanpham = $chitiet->LayHangHoaCuaDonHang($tt->madonhang);

                                        # lấy tên hàng hóa bằng mã hàng hóa của chi tiết đơn hàng
                                        # sử dụng ở dòng foreach
                                        $hanghoa = new hanghoaclass();

                                        foreach ($sanpham as $sp) {
                                            echo "<strong><span class='text-success' data-toggle='tooltip' data-placement='top' title='Ngày sản xuất: $sp->ngaysanxuat'>" .  $hanghoa->LayHangHoaTheoMa($sp->mahanghoa)->tenhanghoa . "</span>: <span>" . $sp->soluong . "</span></strong><br>";
                                        }
                                    ?>
                                </th>
                                <th scope="row" class="font-weight-normal"><?php echo $tt->ghichu; ?></th>
                                <th scope="row" class="font-weight-normal">
                                    <?php
                                        # lấy tên admin để show bằng modal
                                        $admin = new adminclass();
                                        $thongtin = $admin->LayThongTinAdminBangMa($tt->maadmin);
                                        $tenadmin = $thongtin->hovaten;
                                    ?>
                                    <button type="button" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#chitietdonhang" onclick="ChiTietDonHang('<?php echo $tt->ngaytao?>', '<?php echo $tt->mabill?>', '<?php echo $tenadmin?>')">Chi tiết</button>
                                    <a href="index.php?page=suadonhang&id=<?php echo $tt->makhachhang?>&madonhang=<?php echo $tt->madonhang?>" class="btn btn-warning rounded-pill">Sửa</a>
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

