<?php
    if(isset($_SESSION['admin'])){
        ?>
        <div class="row">
            <!-- TITLE -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                <?php   if(!isset($_GET['id'])){ ?>
                    <div class="position-absolute" style="z-index: 999; left: 10px">       
                        <a class="btn btn-outline-brown dangxuat rounded-pill" href="index.php?page=quanlitonkho">Trở Về</a>
                    </div>
                <?php }?>
    
                <div class="text-center">
                    <h4><strong><b>Tạo Mới Đơn Hàng Tồn</b></strong></h4>
                </div>
            </div>  <!-- END TITLE -->

            <!-- THEM HANG HOA VA SO LUONG -->
            <div class="col-12 col-sm-12 col-md-12 mt-3">
            <?php
                # nếu trả về id có nghĩ là trả về mã khách hàng=> thêm hàng hóa và số lượng
                if(isset($_GET['id'])){ 
                    $makhachhang = $_GET['id'];
        
                    require "ns-tn-model/nha-phan-phoi-class.php";
        
                    $khachhang = new nhaphanphoiclass();
                    $thongtin = $khachhang->LayThongTinKhachHangBangMa($makhachhang);
        
                    if($thongtin != NULL){
                        ?>
                            <div class="row d-flex justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10">
                                <font><marquee class="mb-3 text-dark" direction="left" style="background:orange; border-radius: 15px; border: #835c3e 2px SOLID">Bạn đang TẠO đơn hàng tồn cho nhà phân phối: <b><u><?php echo "  " . $thongtin->hovaten;?></u></b></marquee></font>
                                    <div class="card bg-custom pb-3 mb-3">
                                        <div class="card-header bg-browns text-light" style="border-radius: 30px 30px 0 0">1. Thêm hàng hóa - Số lượng - Ngày sản xuất</div>
                                        <div class="card-body">
                                            <form action="ns-tn-controller/hang-ton-controller.php?yeucau=themhanghoavasoluong" method="post">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <select class="form-control rounded-pill" name="mahanghoa" title="Chọn hàng hóa cần thêm">
                                                            <?php 
                                                                require "ns-tn-model/hang-hoa-class.php";
                                                                # lay tat ca hang hoa co san dua vao select box
                                                                $hanghoa = new hanghoaclass();
                                                                $thongtin = $hanghoa->LayTatCaHangHoaKhachDaDat($makhachhang);

                                                                foreach ($thongtin as $tt) {
                                                                    ?>
                                                                        <option value="<?php echo $tt->mahanghoa;?>"><?php echo $tt->tenhanghoa; ?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <!-- ma khach hang -->
                                                            <input type="text" name="makhachhang" class="form-control rounded-pill d-none" value="<?php echo $makhachhang; ?>" required>
                                                            <!-- them so luong cua mon hang vua chon -->
                                                            <input type="number" name="soluong" min="0" class="form-control rounded-pill" placeholder="Số lượng" required title="Số lượng phải lớn hơn 0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary rounded-pill">Thêm</button>
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
                                                        require "ns-tn-model/hang-ton-class.php";

                                                        # lấy thông tin đơn hàng đang tạo
                                                        $donhang = new hangtonclass();
                                                        $thongtin = $donhang->LayDonHang($makhachhang);
                                                        $madonhang = $thongtin->MAX;

                                                        $chitiethanghoadonhang = new cthhhtclass();
                                                        $thongtin = $chitiethanghoadonhang->LayHangHoaCuaDonHang($madonhang);
                                                    
                                                        foreach ($thongtin as $tt) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $tt->tenhanghoa; ?></td>
                                                                <td><?php echo $tt->soluong; ?></td>
                                                                <td>
                                                                    <button onclick="SuaThongTinHangHoaDonHangTon('<?php echo $tt->mahangton?>','<?php echo $tt->makhachhang; ?>','<?php echo $tt->machitiethanghoahangton?>', '<?php echo $tt->soluong?>')" type="button" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#suathongtindonhang">
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
                                                <button type="button" class="btn btn-danger mt-3 hvr-buzz btn-huy-don-hang rounded-pill" data-toggle="modal" data-target="#huydonhang">
                                                    Hủy đơn hàng này
                                                </button>

                                                <a href="index.php?page=quanlitonkho" class="btn btn-success mt-3 hvr-bounce-out rounded-pill">Xác Nhận Tạo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           

                        <?php
                    }else{
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Lỗi...</strong> Không tìm thấy thông tin nhà phân phối này...!
                            </div>
                        <?php
                    }
                # nếu không nhận được id nghĩa là không tìm thấy mã khách hàng => tìm và tạo đơn mới cho khách hàng
                }else{
            ?>
            </div>

                <div class="col-12 col-sm-12 col-md-12 mt-3 d-flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-3 bg-custom">
                            <label for=""><b>Thêm đơn hàng: </b></label>
                            <!-- Khi lưu thông tin khách 'qua đường' từ nha-phan-phoi-controller trả về sodienthoai => lấy ra và in ở đây -->
                            <input type="number" class="form-control rounded-pill" placeholder="Nhập số điện thoại" id="sodienthoaithemdonhang" onkeyup="SoDienThoaiThemDonHangTon()">
                            <div class="form-group mb-0">
                                <button type="button" class="btn btn-primary mt-3 rounded-pill" onclick="SoDienThoaiThemDonHangTon()">Tìm</button>
                            </div>
                        </div>
                    </div>
                </div>
                
               
                <!-- load dữ liệu từ xuat-kho.js để tìm thông tin khách => tạo đơn hàng mới-->
                <div class="col-12 col-sm-12 col-md-12 mt-3 d-flex justify-content-center">
                    <div class="col-md-10">
                        <div class="" id="thongtinkhachthem">
                    
                        </div>
                    </div>
                </div>
        </div>      
        <?php 
                }
        }else{
        ?>
            <div class="alert alert-danger" role="alert">
                Lỗi... Không tìm thấy thông tin tài khoản admin...!
            </div>
        <?php
    }

    require "modal/modal-huy-don-hang.php";
    require "modal/modal-sua-don-hang.php";
?>

<!--  -->