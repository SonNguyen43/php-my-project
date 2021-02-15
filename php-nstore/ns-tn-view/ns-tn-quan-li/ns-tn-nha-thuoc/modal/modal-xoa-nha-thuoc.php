<!-- dữ liệu lấy từ index.php -> xuat-kho.js -->
<div class="modal fade" id="xoanhathuoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-browns text-light">
                <h5 class="modal-title" id="exampleModalCenterTitle">Xóa nhà thuốc</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
                <div class="modal-body">
                    <form action="ns-tn-controller/nha-thuoc-controller.php?yeucau=xoa" method="POST">
                        <div class="form-group">
                            <div>
                                Bạn có muốn xóa nhà thuốc <b id="tennhathuocxoa"></b> này ?
                            </div>
                            <input type="text" name="manhathuoc" id="manhathuoc" class="form-control rounded-pill d-none" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-brown text-light rounded-pill" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-danger text-light rounded-pill">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>