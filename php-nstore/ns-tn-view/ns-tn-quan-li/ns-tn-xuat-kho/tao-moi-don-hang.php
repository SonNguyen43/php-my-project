<?php
    if(isset($_SESSION['admin'])){
        ?>
        <div class="row">
            <!-- TITLE -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                <?php
                      if(!isset($_GET['id'])){ 
                ?>
                    <div class="position-absolute" style="z-index: 999; left: 10px">       
                       
                    </div>
                <?php
                      }
                ?>
                <div class="text-center">
                    <h3><strong><b>Tạo Mới Đơn Hàng</b></strong></h3>
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
                                <font><div class="mb-3 text-dark rounded-pill card-body bg-custom" direction="left" style="border: #835c3e 2px SOLID">Bạn đang <b>tạo</b> đơn hàng cho nhà phân phối: <b><u><?php echo "  " . $thongtin->hovaten;?></u></b></div></font>
                                    <div class="card bg-custom pb-3 mb-3">
                                        <div class="card-header bg-browns text-light" style="border-radius: 30px 30px 0 0">1. Thêm hàng hóa - Số lượng - Ngày sản xuất</div>
                                        <div class="card-body">
                                            <form action="ns-tn-controller/xuat-kho-controller.php?yeucau=themhanghoavasoluong" method="post">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <select class="form-control rounded-pill" name="mahanghoa" title="Chọn hàng hóa cần thêm">
                                                            <?php 
                                                                try {
                                                                    require "ns-tn-model/hang-hoa-class.php";
                                                                    # lay tat ca hang hoa co san dua vao select box
                                                                    $hanghoa = new hanghoaclass();
                                                                    $thongtin = $hanghoa->LayTatCaHangHoa();

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
                                                            <!-- them so luong cua mon hang vua chon -->
                                                            <input type="number" name="soluong" min="1" class="form-control rounded-pill" placeholder="Số lượng" required title="Số lượng phải lớn hơn 0">
                                                        </div>
                                                        <div class="form-group">
                                                            <!-- them so luong cua mon hang vua chon -->
                                                            <input type="date" name="ngaysanxuat"  class="form-control rounded-pill" required title="Ngày sản xuất của món hàng này">
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
                                                        <th scope="col">Số lượng</th>
                                                        <th scope="col">NSX</th>
                                                        <th scope="col">Chức năng</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        require "ns-tn-model/cthh-don-hang-class.php";
                                                        require "ns-tn-model/don-hang-class.php";

                                                        # lấy thông tin đơn hàng đang tạo
                                                        $donhang = new donhangclass();
                                                        $thongtin = $donhang->LayDonHang($makhachhang);
                                                        $madonhang = $thongtin->MAX;

                                                        $chitiethanghoadonhang = new cthhdhclass();
                                                        $thongtin = $chitiethanghoadonhang->LayHangHoaCuaDonHang($madonhang);
                                                    
                                                        foreach ($thongtin as $tt) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $tt->tenhanghoa; ?></td>
                                                                <td><?php echo $tt->soluong; ?></td>
                                                                <td><?php echo $tt->ngaysanxuat; ?></td>
                                                                <td>
                                                                    <button onclick="SuaThongTinHangHoaDonHang('<?php echo $tt->madonhang?>','<?php echo $tt->makhachhang; ?>','<?php echo $tt->machitiethanghoadonhang?>', '<?php echo $tt->soluong?>', '<?php echo $tt->ngaysanxuat?>')" type="button" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#suathongtindonhang">
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

                                                <a href="index.php?page=quanlixuatkho" class="btn btn-success mt-3 hvr-bounce-out rounded-pill">Xác Nhận Tạo</a>
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
                            <input type="number" value="<?php if(isset($_REQUEST['sodienthoai'])) echo $_REQUEST['sodienthoai'] ?>" class="form-control rounded-pill" placeholder="Nhập số điện thoại" id="sodienthoaithemdonhang" onkeyup="SoDienThoaiThemDonHang()">
                            <div class="form-group mb-0 d-flex justify-content-end">
                                <a class="btn btn-outline-brown dangxuat rounded-pill mt-3 mr-3" href="index.php?page=quanlixuatkho">Trở Về</a>
                                <button type="button" class="btn btn-primary rounded-pill mt-3" onclick="SoDienThoaiThemDonHang()">Tìm</button>
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

    require "modal/modal-sua-don-hang.php";
    require "modal/modal-huy-don-hang.php";
?>

