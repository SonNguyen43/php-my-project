<?php
    if(isset($_SESSION['admin'])){
        ?>
        <div class="row">
            <!-- TITLE -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                <div class="position-absolute" style="z-index: 999; left: 10px">       
                    <a class="btn btn-outline-brown dangxuat rounded-pill" href="index.php?page=quanlitonkho">Trở Về</a>
                </div>
    
                <div class="text-center">
                    <h4><strong><b>Sửa Đơn Hàng Tồn</b></strong></h4>
                </div>
            </div>  <!-- END TITLE -->

            <!-- THEM HANG HOA VA SO LUONG -->
            <div class="col-12 col-sm-12 col-md-12 mt-3">
            <?php
                # nếu trả về id có nghĩ là trả về mã khách hàng=> thêm hàng hóa và số lượng
                if(isset($_GET['id']) && isset($_GET['mahangton'])){ 
                    $makhachhang = $_GET['id'];
                    $mahangton = $_GET['mahangton'];
        
                    require "ns-tn-model/nha-phan-phoi-class.php";
                    require "ns-tn-model/hang-ton-class.php";
        
                    # kiểm tra xem thằng khách này có tồn tại không => thêm đơn hàng
                    $khachhang = new nhaphanphoiclass();
                    $thongtin = $khachhang->LayThongTinKhachHangBangMa($makhachhang);

                    # kiểm tra xem thằng khách này với đơn hàng của nó có tồn tại không => sửa đơn hàng
                    $donhang = new hangtonclass();
                    $count = $donhang->TimDonHangCuaKhachHang($makhachhang, $mahangton);
        
                    if($thongtin != NULL && $count > 0){
                        ?>
                            <div class="row d-flex justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10">
                                <font><marquee class="mb-3 text-dark" direction="left" style="background:orange; border-radius: 15px; border: #835c3e 2px SOLID">Bạn đang SỬA đơn hàng cho nhà phân phối: <b><u><?php echo "  " . $thongtin->hovaten;?></u></b></marquee></font>
                                    <div class="card bg-custom pb-3 mb-3">
                                        <div class="card-header bg-browns text-light" style="border-radius: 30px 30px 0 0">1. Thêm hàng hóa - Số lượng - Ngày sản xuất</div>
                                        <div class="card-body">
                                            <form action="ns-tn-controller/hang-ton-controller.php?yeucau=themhanghoavasoluongdatao" method="post">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <select class="form-control rounded-pill" name="mahanghoa" title="Chọn hàng hóa cần thêm">
                                                            <?php 
                                                                try {
                                                                    require "ns-tn-model/hang-hoa-class.php";
                                                                    # lay tat ca hang hoa co san dua vao select box
                                                                    $hanghoa = new hanghoaclass();
                                                                    $thongtin = $hanghoa->LayTatCaHangHoaKhachDaDat($makhachhang);

                                                                    foreach ($thongtin as $tt) {
                                                                        ?>
                                                                                <option value="<?php echo $tt->mahanghoa;?>"><?php echo $tt->tenhanghoa; ?></option>
                                                                        <?php
                                                                    }
                                                                } catch (\Throwable $th) {
                                                                    echo $th;
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <!-- ma khach hang -->
                                                            <input type="text" name="makhachhang" min="1" class="form-control rounded-pill d-none" value="<?php echo $makhachhang; ?>" required>
                                                              <!-- ma khach hang -->
                                                              <input type="text" name="mahangton" min="1" class="form-control rounded-pill d-none" value="<?php echo $mahangton; ?>" required>
                                                            <!-- them so luong cua mon hang vua chon -->
                                                            <input type="number" name="soluong" min="0" class="form-control rounded-pill" placeholder="Số lượng" required title="Số lượng phải lớn hơn 0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <button class="btn btn-primary rounded-pill">Thêm vào giỏ hàng</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form> <!-- END FORM -->
                                        </div>
                                    </div>
                                </div>  <!-- END THEM HANG HOA VA SO LUONG -->

                                <!-- GIO HANG -->
                                <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10">
                                    <div class="card bg-custom mb-3">
                                        <div class="card-header bg-browns text-light" style="border-radius: 30px 30px 0 0">
                                            2. Giỏ hàng
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-sm text-center">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Tên hàng</th>
                                                        <th scope="col">Số lượng còn</th>
                                                        <th scope="col">Chức năng</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        require "ns-tn-model/cthh-hang-ton-class.php";

                                                        # lấy thông tin đơn hàng đang tạo

                                                        $chitiethanghoadonhang = new cthhhtclass();
                                                        $thongtin = $chitiethanghoadonhang->LayHangHoaCuaDonHang($mahangton);
                                                    
                                                        foreach ($thongtin as $tt) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $tt->tenhanghoa; ?></td>
                                                                <td><?php echo $tt->soluong; ?></td>
                                                                <td>
                                                                    <button onclick="SuaThongTinHangHoaDonHangTon('<?php echo $tt->mahangton?>','<?php echo $tt->makhachhang; ?>','<?php echo $tt->machitiethanghoahangton?>', '<?php echo $tt->soluong?>')" type="button" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#suathongtindonhangdatao">
                                                                        Sửa
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>

                                            <div class="mt-0">
                                                <button type="button" class="btn btn-danger mt-3 hvr-buzz btn-huy-don-hang rounded-pill" data-toggle="modal" data-target="#huydonhangdatao">
                                                    Hủy đơn hàng này
                                                </button>

                                                <a href="index.php?page=quanlitonkho" class="btn btn-success mt-3 hvr-bounce-out rounded-pill">Xác Nhận Thay Đổi</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                           

                        <?php
                    }else if($thongtin == NULL){
                        ?>
                            <div class="alert alert-warning" role="alert">
                                <strong>Lỗi...</strong> Không tìm thấy thông tin nhà phân phối này...!
                            </div>
                        <?php
                    }else{
                        ?>
                            <div class="alert alert-warning" role="alert">
                                <strong>Lỗi...</strong> Không tìm thấy thông tin nhà phân phối hoặc đơn hàng này...!
                            </div>
                    <?php
                    }
                # nếu không nhận được id nghĩa là không tìm thấy mã khách hàng => tìm và tạo đơn mới cho khách hàng
                }else if($count <= 0 || $count == NULL){
                    ?>
                    <div class="alert alert-warning" role="alert">
                        <strong>Lỗi...</strong> Không tìm thấy thông tin nhà phân phối hoặc đơn hàng này...!
                    </div>
            <?php
                }
            ?>
        </div>      
        <?php 
            
        }else{
        ?>
            <div class="alert alert-danger" role="alert">
                Lỗi... Không tìm thấy thông tin tài khoản admin...!
            </div>
        <?php
    }

    require "modal/modal-sua-don-hang.php";
    require "modal/modal-huy-don-hang.php";
?>

