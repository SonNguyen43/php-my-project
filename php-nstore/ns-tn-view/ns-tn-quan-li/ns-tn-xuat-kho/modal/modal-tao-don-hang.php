<!-- dữ liệu lấy từ thong-tin-khach-them.php -->
<div class="modal fade" id="taodonhang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-browns text-light">
                <h5 class="modal-title" id="exampleModalCenterTitle">TẠO ĐƠN HÀNG</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="ns-tn-controller/xuat-kho-controller.php?yeucau=taomoidonhang" method="post">
                    <div class="form-group">
                        <input type="text" name="makhachhang" value="<?php echo $thongtin->makhachhang; ?>" class="form-control rounded-pill d-none" readonly>

                        <label for=""><b>Nhập mã bill:</b> </label>
                        <input type="text" name="mabill" class="form-control rounded-pill" required title="Không được để trống trường này">

                        <label for=""><b>Ghi chú:</b> </label>
                        <textarea name="ghichu" class="form-control" placeholder="Có thể bỏ trống ghi chú" style="border-radius: 30px"></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-brown text-light mr-3 rounded-pill" data-dismiss="modal">Đóng</button>
                        <input type="submit" class="btn btn-success rounded-pill" value="Xác nhận">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>