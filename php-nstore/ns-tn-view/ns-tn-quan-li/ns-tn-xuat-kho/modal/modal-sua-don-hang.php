<!-- dữ liệu lấy từ xuat-kho.js SuaThongTinHangHoaDonHang() -->
<div class="modal fade" id="suathongtindonhang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-browns text-light">
                <h5 class="modal-title" id="exampleModalCenterTitle">SỬA THÔNG TIN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="ns-tn-controller/xuat-kho-controller.php?yeucau=suahanghoacuadonhang" method="post">
                    <div class="form-group">
                        <input type="text" name="makhachhang" id="makhachhangsua" class="form-control rounded-pill d-none" readonly require>
                        <input type="text" name="madonhang" id="madonhangsua" class="form-control rounded-pill d-none" readonly require>
                        <input type="text" name="machitiethanghoadonhang" id="machitiethanghoadonhangsua" class="form-control rounded-pill d-none" readonly require>
                        <label for="">Số lượng: </label>
                        <input type="number" name="soluong" min="0" id="soluongsua" class="form-control rounded-pill" title="Số lượng lớn hơn hoặc bằng 0 - nếu bằng 0 thì sẽ tự động xóa món hàng ra khỏi đơn hàng">
                        <label for="">Ngày sản xuất: </label>
                        <input type="date" name="ngaysanxuat" id="ngaysanxuatsua" class="form-control rounded-pill" title="Ngày sản xuất của món hàng này">
                    </div>

                    <div class="form-group">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-brown text-light mr-3 rounded-pill" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary rounded-pill">Thay đổi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Sửa đơn hàng đã tạo -->
<div class="modal fade"  id="suathongtindonhangdatao" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-browns text-light">
                <h5 class="modal-title" id="exampleModalCenterTitle">SỬA THÔNG TIN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="ns-tn-controller/xuat-kho-controller.php?yeucau=suahanghoacuadonhangdatao" method="post">
                    <div class="form-group">
                        <input type="text" name="makhachhang" id="makhachhangsuadatao" class="form-control rounded-pill d-none" readonly require>
                        <input type="text" name="madonhang" id="madonhangsuadatao" class="form-control rounded-pill d-none" readonly require>
                        <input type="text" name="machitiethanghoadonhang" id="machitiethanghoadonhangsuadatao" class="form-control rounded-pill d-none" readonly require>
                        <label for="">Số lượng: </label>
                        <input type="number" name="soluong" min="0" id="soluongsuadatao" class="form-control rounded-pill" title="Số lượng lớn hơn hoặc bằng 0 - nếu bằng 0 thì sẽ tự động xóa món hàng ra khỏi đơn hàng">
                        <label for="">Ngày sản xuất: </label>
                        <input type="date" name="ngaysanxuat" id="ngaysanxuatsuadatao" class="form-control rounded-pill" title="Ngày sản xuất của món hàng này">
                    </div>

                    <div class="form-group">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-brown text-light mr-3 rounded-pill" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary rounded-pill">Thay đổi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>