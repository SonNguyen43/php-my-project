<!-- $makhachhang lấy từ tao-moi-don-hang.php -->
<div class="modal fade" id="huydonhang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-browns text-light">
                <h5 class="modal-title" id="exampleModalCenterTitle">HỦY ĐƠN HÀNG</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn muốn hủy đơn hàng đang tạo ?
                <form action="ns-tn-controller/xuat-kho-controller.php?yeucau=huydonhang" method="post">
                    <div class="form-group">
                        <input type="text" name="makhachhang" class="form-control rounded-pill d-none" value=<?php echo $makhachhang; ?> readonly >
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-brown text-light mr-3 rounded-pill" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-danger rounded-pill">Tiến Hành Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="huydonhangdatao" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-browns text-light">
                <h5 class="modal-title" id="exampleModalCenterTitle">HỦY ĐƠN HÀNG</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn muốn hủy đơn hàng đang tạo. Tất cả dữ liệu đơn hàng này sẽ bị xóa ?
                <form action="ns-tn-controller/xuat-kho-controller.php?yeucau=huydonhangdatao" method="post">
                    <div class="form-group">
                        <input type="text" name="makhachhang" class="form-control rounded-pill d-none" value=<?php echo $makhachhang; ?> readonly >
                        <input type="text" name="madonhang" class="form-control rounded-pill d-none" value=<?php echo $madonhang; ?> readonly >
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-brown mr-3 rounded-pill" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-danger rounded-pill">Tiến Hành Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>