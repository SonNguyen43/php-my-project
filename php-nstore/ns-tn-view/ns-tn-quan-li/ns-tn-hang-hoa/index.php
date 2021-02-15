<?php
    require "ns-tn-model/hang-hoa-class.php";
    require "ns-tn-model/admin-class.php";

    # tìm thấy tài khoản admin đăng nhập
    if(isset($_SESSION['admin'])){
        ?>
            <!-- TITLE -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                <div class="position-absolute" style="z-index: 999; left: 10px">       
                    
                </div>
    
                <div class="text-center">
                    <h4><strong><b>Quản Lí Hàng Hóa</b></strong></h4>
                </div>
            </div>  <!-- END TITLE -->

            <div class="">
                <div class="row">
                    <!-- MENU -->
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-start mt-3">
                        <a class="btn btn-outline-brown dangxuat rounded-pill ml-3" href="index.php">Trở Về</a>
                    </div>
                    <div class="col-12 col-sm-12 colmd-6 col-lg-6 col-xl-6 d-flex justify-content-end mt-3">
                        <div class="btn btn-success rounded-pill mr-3" data-toggle="modal" data-target="#taomoihanghoa">Tạo Mới Hàng Hóa</div>
                        <button class=" btn btn-secondary text-light mr-3 rounded-pill" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Tìm Hàng Hóa
                        </button>
                    </div>  <!-- END MENU -->
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                <!-- TIM KIEM -->
                <div class="collapse card bg-custom" id="collapseExample">
                    <div class="card-header bg-browns text-light" style="border-radius: 30px 30px 0 0">
                        <h6><strong><b>Tìm kiếm</b></strong></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label for=""><b>Nhập tên: </b></label>
                                <input type="text" id="tenhanghoatim" onkeyup="TimHangHoa()" class="form-control rounded-pill">
                            </div>    
                        </div>           
                    </div>
                </div>  <!-- END TIM KIEM -->
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                <!-- TABLE -->
                <div class="table-responsive-lg" id="bangloc">
                    <!-- TABLE -->
                    <table class="table table-hover table-bordered table-sm table-light text-center mb-3">
                        <thead>
                            <tr>
                                <th scope="col" colspan="8">TẤT CẢ HÀNG HÓA</th>
                            </tr>
                            <tr class="bg-browns text-light">
                                <th scope="col">#</th>
                                <th scope="col">Tên Hàng Hóa</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $hanghoa = new hanghoaclass();
                            $thongtin = $hanghoa->LayTatCaHangHoa();
                            $stt = 1;
                        
                            foreach ($thongtin as $tt) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $stt++; ?></th>
                                <td><b><?php echo $tt->tenhanghoa ?></b></td>
                                <td>
                                    <button class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#suahanghoa" onclick="SuaHangHoa('<?php echo $tt->mahanghoa;?>','<?php echo $tt->tenhanghoa ?>')">Sửa</button>
                                    <button class="btn btn-danger rounded-pill" title="Nhấp 2 lần" ondblclick="XoaHangHoa('<?php echo $tt->mahanghoa;?>','<?php echo $tt->tenhanghoa ?>')">Xóa</button>  
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>    <!-- END TABLE -->
                </div>
            </div>

            <!-- Modal thêm -->
            <div class="modal fade" id="taomoihanghoa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tạo mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="ns-tn-controller/hang-hoa-controller.php?yeucau=themmoi" method="POST">
                            <label for="">Nhập tên hàng hóa: </label>
                            <input name="tenhanghoa" type="text" class="form-control rounded-pill">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary rounded-pill">Tạo mới</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Model sửa -->
            <div class="modal fade" id="suahanghoa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa hàng hóa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="ns-tn-controller/hang-hoa-controller.php?yeucau=sua" method="POST">
                            <input name="mahanghoa" id="mahanghoasua" type="text" class="form-control rounded-pill d-none">
                            <label for="">Tên hàng hóa: </label>
                            <input name="tenhanghoa" id="tenhanghoasua" type="text" class="form-control rounded-pill">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary rounded-pill">Thay đổi</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Model xóa -->
            <div class="modal fade" id="xoahanghoa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xóa hàng hóa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="ns-tn-controller/hang-hoa-controller.php?yeucau=xoa" method="POST">
                            <input name="mahanghoa" id="mahanghoaxoa" type="text" class="form-control rounded-pill d-none">
                            Bạn có chắn muốn xóa
                            <b><div id="tenhanghoaxoa" class="d-inline"></div></b> ?
                            <hr>
                            <div class="text-danger font-italic"><span class="font-weight-bold">CẢNH BÁO: </span> Những dữ liệu liên quan đến sản phẩm này sẽ bị xóa đi. Bạn có chắc chắn không ?</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-outline-danger rounded-pill">Xóa</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        <?php
    }else{
            # Không tìm thấy tài khoản admin đăng nhập
        ?>
            <div class="alert alert-danger" role="alert">
                Lỗi... Không tìm thấy thông tin tài khoản admin...!
            </div>
        <?php
    }
?>
