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
                    <h4><strong><b>Tạo Mới Nhà Thuốc</b></strong></h4>
                </div>
            </div>  <!-- END TITLE -->

            <!-- THEM HANG HOA VA SO LUONG -->
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 offset-3 mt-3">
                <div class="card p-3 form-them-khach bg-custom mb-3">
                    <!-- FORM THEM -->
                    <form action="ns-tn-controller/nha-thuoc-controller.php?yeucau=them" method="POST">
                        <div class="form-group">
                            <label for=""><b>Tên nhà thuốc:</b> (<span class="need">*</span>)</label>
                            <input type="text" name="tennhathuoc" class="form-control rounded-pill" title="Không được bỏ rỗng trường này" required>
                        </div>
                        <!-- <div class="form-group">
                            <label for=""><b>Địa chỉ:</b> (<span class="need">*</span>)</label>
                            <input type="text" name="diachi" class="form-control rounded-pill" title="Không được bỏ rỗng trường này" required>
                        </div> -->
                        <div class="form-group">
                        <label for=""><b>Địa chỉ:</b> (<span class="need">*</span>)</label>
                        <select class="form-control rounded-pill" id="exampleFormControlSelect1" name="diachi">
                            <option value="Vị Thanh">KV 1 - Vị Thanh</option>
                            <option value="Vị Thuỷ">KV 1 - Vị Thuỷ</option>
                            <option value="Châu Thành A">KV 1 - Châu Thành A</option>
                            <option value="Huyện Long Mỹ">KV 2 - Huyện Long Mỹ</option>
                            <option value="Thị xã Long Mỹ">KV 2 - Thị xã Long Mỹ</option>
                            <option value="Phụng Hiệp">KV 3 - Phụng Hiệp</option>
                            <option value="Ngã 7">KV 3 - Ngã 7</option>
                            <option value="Châu Thành">KV 3 - Châu Thành</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Số điện thoại:</b> (<span class="need">*</span>)</label>
                            <input type="number" name="sodienthoai" id="sodienthoaicheck" class="form-control rounded-pill" title="Không được bỏ rỗng trường này" required> 
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center mt-3">
                                    <input type="reset" class="btn btn-warning rounded-pill mr-3" value="Làm trống">
                                    <a class="btn btn-outline-brown dangxuat rounded-pill" href="index.php?page=nhathuoc">Trở Về</a>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center mt-3">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <input type="submit" value="Thêm mới" class="btn btn-success rounded-pill">
                                    </div>                     
                                </div>
                            </div>
                        </div>
                    </form>     <!-- END FORM THEM -->
                </div>
            </div>
        </div>      
        <?php 
        }else{
        ?>
            <div class="alert alert-danger" role="alert">
                Lỗi... Không tìm thấy thông tin tài khoản admin...!
            </div>
        <?php
    }
?>

