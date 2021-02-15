<?php
    require "../../../ns-tn-model/nha-phan-phoi-class.php";

    if(isset($_REQUEST['sodienthoai'])){
        $sodienthoai = $_REQUEST['sodienthoai'];

        $khachhang = new nhaphanphoiclass();
        $thongtin = $khachhang->LayThongTinKhachHangBangSoDienThoai($sodienthoai);

        //echo $thongtin->hovaten;
        if($thongtin != NULL){
        ?>
            <i><b><a data-toggle="modal" data-target="#thaydoiloaikhachhang">
               
                <marquee behavior="alternate" width="10%">>></marquee><u>Nhấn để tạo nhanh</u><marquee behavior="alternate" width="10%"><< </marquee>
            </b></a></i>
        <?php
        }
    }else{
        echo "";
    }
?>

<div class="modal fade" id="thaydoiloaikhachhang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-browns text-light">
                <h5 class="modal-title" id="exampleModalCenterTitle"><u><?php echo $thongtin->hovaten; ?></u></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for=""><b class="text-success">Số điện thoại: </b></label>
                    <div class="alert alert-info rounded-pill p-2" role="alert">
                        <?php echo $thongtin->sodienthoai; ?>
                    </div>
                    <label for=""><b class="text-success">CMND: </b></label>
                    <div class="alert alert-info rounded-pill p-2" role="alert">
                        <?php echo $thongtin->cmnd; ?>
                    </div>
                   
                    <label for=""><b class="text-success">Địa chỉ: </b></label>
                    <div class="alert alert-info rounded-pill p-2" role="alert">
                        <?php echo $thongtin->diachi; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="ns-tn-controller/nha-phan-phoi-controller.php?yeucau=thaydoiloaikhachhang" method="post">
                    <div class="form-group">
                        <input type="text" name="sodienthoai" class="form-control rounded-pill d-none" required readonly value="<?php echo $thongtin->sodienthoai; ?>">
                        <input type="text" name="makhachhang" class="form-control rounded-pill d-none" required readonly value="<?php echo $thongtin->makhachhang; ?>">

                        <button type="button" class="btn btn-brown text-light rounded-pill" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary rounded-pill">Đồng ý</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>