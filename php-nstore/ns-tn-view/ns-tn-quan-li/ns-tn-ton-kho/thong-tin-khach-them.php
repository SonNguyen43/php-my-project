<div class="card p-3 mb-3 bg-custom">
    <?php
        require "../../../ns-tn-model/nha-phan-phoi-class.php";
        require "../../../ns-tn-model/hang-ton-class.php";

        if(isset($_REQUEST['sodienthoai'])){
            $sodienthoai = $_REQUEST['sodienthoai'];

            if(strlen($sodienthoai) >= 10){
                $khachhang = new nhaphanphoiclass(); 
                $thongtin = $khachhang->TimNhaPhanPhoiTheoSoDienThoai($sodienthoai);
                
                if($thongtin != NULL){
                    ?>
                        <strong class="text-center">Kết Quả Tìm Được</strong>
                        <small class="text-center">
                            <?php
                                if($thongtin->loaikhachhang == "khachlaunam"){
                                    echo "(Khách Lâu Năm)";
                                }else if($thongtin->loaikhachhang == "khachquaduong"){
                                    echo "(Khách Từng Đặt Hàng)";
                                }else{
                                    echo "(Khách Chưa Từng Đặt Hàng !)";
                                }
                            ?>
                        </small>
                        <div>
                            <label for=""><b>Tên nhà phân phối:</b></label>
                            <input type="text" value="<?php echo $thongtin->hovaten; ?>" class="form-control rounded-pill" readonly>
                            <label for=""><b>Địa chỉ:</b></label>
                            <input type="text" value="<?php echo $thongtin->diachi; ?>" class="form-control rounded-pill" readonly>
                            <label for=""><b>CMND:</b></label>
                            <input type="text" value="<?php echo $thongtin->cmnd; ?>" class="form-control rounded-pill" readonly>
                            <label for=""><b>SĐT:</b></label>
                            <input type="text" value="<?php echo $thongtin->sodienthoai; ?>" class="form-control rounded-pill" readonly>
                        </div>
                        <div class="mt-3">
                            <button type="button" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#taodonhang">
                                Tạo đơn hàng tồn
                            </button>
                        </div>
                    <?php
                }else{
                    ?>
                        <strong class="text-center">Nhà Phân Phối Chưa Từng Đặt Hàng</strong>
                        <small class="text-center">(Không Thể Tạo Đơn Hàng Tồn)</small>
                    <?php  
                }
            }else{
                ?>
                   <label for="" class="text-center">Đang tìm thông tin nhà phân phối </label>
                    <div class="d-flex justify-content-center">
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-success" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-danger" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-warning" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                <?php
            }
        }else{
            # Không tìm thấy tài khoản được GET qua
        ?>
            <div class="alert alert-danger" role="alert">
                Lỗi... Không tìm thấy thông tin tài khoản vừa tìm...!
            </div>
        <?php
        }
    ?>
</div>

<?php
    require "modal/modal-tao-don-hang.php";
?>
