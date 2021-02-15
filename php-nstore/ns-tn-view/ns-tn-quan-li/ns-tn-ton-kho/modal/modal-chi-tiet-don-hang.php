<!-- dữ liệu lấy từ index.php -> xuat-kho.js -->
<div class="modal fade" id="chitietdonhang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-browns text-light">
                <h5 class="modal-title" id="exampleModalCenterTitle">CHI TIẾT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Người tạo: </label> <b><span id="nguoitao"></span></b>
                    <!-- <input type="text" id="nguoitao" class="form-control rounded-pill" readonly> -->
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-brown text-light rounded-pill" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>