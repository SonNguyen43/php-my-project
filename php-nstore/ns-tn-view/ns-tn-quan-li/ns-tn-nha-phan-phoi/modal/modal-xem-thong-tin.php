<!-- MODAL XEM THEM THONG TIN NHA PHAN PHOI -->
<div class="modal fade" id="xemthongtinchitiet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-browns text-light">
                <h5 class="modal-title" id="exampleModalCenterTitle"><div id="xem_tenkhachhang"></div></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for=""><b>Mã hợp đồng:</b></label>
                    <div class="form-control rounded-pill" id="xem_mahopdong" readonly></div>
                    <label for=""><b>Mã cửa hàng:</b></label>
                    <div class="form-control rounded-pill" id="xem_macuahang" readonly></div>
                    <label for=""><b>HT NPP:</b></label>
                    <div class="form-control rounded-pill" id="xem_hethongnhaphanphoi" readonly></div>
                    <label for=""><b>Còn bán:</b></label>
                    <div class="form-control rounded-pill" id="xem_danghi" readonly></div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for=""><b>Ngày lên cấp:</b></label>
                            <div class="form-control rounded-pill" id="xem_ngaylencap" readonly></div>
                        </div>
                    </div>

                    <div class="jumbotron p-3 mt-3" style="border-radius: 30px; opacity: 0.5">
                        <label for=""><b>Người tạo:</b></label>
                        <div class="form-control rounded-pill bg-light" id="xem_tenadmin" readonly></div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for=""><b>Ngày tạo:</b></label>
                                <div class="form-control rounded-pill bg-light" id="xem_ngaytao" readonly></div>
                            </div>
                            <div class="col-md-6">
                                <label for=""><b>Ngày sửa:</b></label>
                                <div class="form-control rounded-pill bg-light" id="xem_ngaysua" readonly></div>       
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                            <a id="xem_lichsuthaydoi" href="" class="btn btn-success rounded-pill">Xem lịch sử thay đổi</a>    
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-brown text-light d-flex justufy-content-center" data-dismiss="modal">Đóng</button>
            </div> -->
        </div>
    </div>
</div>