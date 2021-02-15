<?php
    if(isset($_SESSION['admin'])){
        ?>
        <div class="row">
            <!-- TITLE -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                <div class="text-center">
                    <h4><strong><b>Sửa Nhà Thuốc</b></strong></h4>
                </div>
            </div>  <!-- END TITLE -->

            <!-- THEM HANG HOA VA SO LUONG -->
            <div class="col-12 col-sm-12 col-md-12 mt-3">
            <?php
                if(isset($_GET['id'])){ 
                    $manhathuoc = $_GET['id'];
        
                    require "ns-tn-model/nha-thuoc-class.php";
        
                    $nhathuoc = new nhathuocclass();

                    $count = $nhathuoc->TonTaiNhaThuoc($manhathuoc);
                    $thongtin = $nhathuoc->LayThongTinNhaThuocBangMa($manhathuoc);
        
                    if($thongtin != NULL && $count > 0){
                        ?>
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 offset-3 mt-3">
                                    <div class="card bg-custom" style="border-radius: 30px 30px 30px 30px">
                                        <div class="card-body">
                                            <form action="ns-tn-controller/nha-thuoc-controller.php?yeucau=sua" method="POST">
                                                <input value="<?php echo $thongtin->manhathuoc;?>" type="text" name="manhathuoc" class="form-control rounded-pill d-none" title="Không được bỏ rỗng trường này" required>

                                                <div class="form-group">
                                                    <label for=""><b>Tên nhà thuốc:</b> (<span class="need">*</span>)</label>
                                                    <input value="<?php echo $thongtin->tennhathuoc;?>" type="text" name="tennhathuoc" class="form-control rounded-pill" title="Không được bỏ rỗng trường này" required>
                                                </div>
                                                <div class="form-group">
                                                <label for=""><b>Địa chỉ:</b> (<span class="need">*</span>)</label>
                                                <select class="form-control rounded-pill" id="exampleFormControlSelect1" name="diachi">
                                                    <option value="Vị Thanh" 
                                                    <?php if($thongtin->diachi == 'Vị Thanh') echo 'selected'?>>KV 1 - Vị Thanh</option>

                                                    <option value="Vị Thuỷ"
                                                    <?php if($thongtin->diachi == 'Vị Thuỷ') echo 'selected'?>>KV 1 - Vị Thuỷ</option>

                                                    <option value="Châu Thành A"
                                                    <?php if($thongtin->diachi == 'Châu Thành A') echo 'selected'?>>KV 1 - Châu Thành A</option>

                                                    <option value="Huyện Long Mỹ"
                                                    <?php if($thongtin->diachi == 'Huyện Long Mỹ') echo 'selected'?>>KV 2 - Huyện Long Mỹ</option>

                                                    <option value="Thị xã Long Mỹ"
                                                    <?php if($thongtin->diachi == 'Thị xã Long Mỹ') echo 'selected'?>>KV 2 - Thị xã Long Mỹ</option>

                                                    <option value="Phụng Hiệp"
                                                    <?php if($thongtin->diachi == 'Phụng Hiệp') echo 'selected'?>>KV 3 - Phụng Hiệp</option>

                                                    <option value="Ngã 7"
                                                    <?php if($thongtin->diachi == 'Ngã 7') echo 'selected'?>>KV 3 - Ngã 7</option>

                                                    <option value="Châu Thành"
                                                    <?php if($thongtin->diachi == 'Châu Thành') echo 'selected'?>>KV 3 - Châu Thành</option>
                                                </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><b>Số điện thoại:</b> (<span class="need">*</span>)</label>
                                                    <input value="<?php echo $thongtin->sodienthoai;?>" type="number" name="sodienthoai" id="sodienthoaicheck" class="form-control rounded-pill" title="Không được bỏ rỗng trường này" required> 
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center mt-3">
                                                            <a class="btn btn-outline-brown rounded-pill" href="index.php?page=nhathuoc">Trở Về</a>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center mt-3">
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <input type="submit" value="Thay đổi" class="btn btn-success rounded-pill">
                                                            </div>                     
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>     <!-- END FORM THEM -->
                                        </div>
                                    </div>
                                </div>  
                            </div>
                           

                        <?php
                    }else if($thongtin == NULL){
                        ?>
                            <div class="alert alert-warning" role="alert">
                                <strong>Lỗi...</strong> Không tìm thấy thông tin nhà thuốc này...!
                            </div>
                        <?php
                    }else{
                        ?>
                            <div class="alert alert-warning" role="alert">
                                <strong>Lỗi...</strong> Không tìm thấy thông tin...!
                            </div>
                    <?php
                    }
                # nếu không nhận được id nghĩa là không tìm thấy mã khách hàng => tìm và tạo đơn mới cho khách hàng
                }else if($count <= 0 || $count == NULL){
                    ?>
                    <div class="alert alert-warning" role="alert">
                        <strong>Lỗi...</strong> Không tìm thấy thông tin nhà thuốc này...!
                    </div>
            <?php
                }
            ?>
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

