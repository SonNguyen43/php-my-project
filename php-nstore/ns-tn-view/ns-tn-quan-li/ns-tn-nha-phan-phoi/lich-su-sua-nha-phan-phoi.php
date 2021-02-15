<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
    <div class="position-absolute" style="z-index: 999; left: 10px">       
        <a class="btn btn-outline-brown dangxuat rounded-pill" href="index.php?page=quanlinhaphanphoi">Trở Về</a>
    </div>

    <div class="text-center">
        <h3><strong><b>Lịch sử thay đổi thông tin</b></strong></h3>
    </div>
</div>  <!-- END TITLE -->
<?php
    require "ns-tn-model/nha-phan-phoi-class.php";
    require "ns-tn-model/sua-khach-hang-class.php";
    require "ns-tn-model/admin-class.php";

    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];

        $nhaphanphoi = new nhaphanphoiclass();
        $count = $nhaphanphoi->DemKhachhang($id);

       
        # ID không tồn tại
        if($count <= 0){
            ?>
                <div class="alert alert-danger" role="alert">
                    Lỗi... Không tìm thấy thông tin tài khoản cần xem...!
                </div>
            <?php
        # Không tìm thấy request ID 
        }else if($id ==  NULL){
            ?>
                <div class="alert alert-danger" role="alert">
                    Lỗi... Không tìm thấy thông tin tài khoản cần xem...!
                </div>
            <?php
        # 
        }else{
            $suakhachhang = new suakhachhangclass();
            $thongtin = $suakhachhang->LayLichSuSua($id);

            $admin = new adminclass();
           

            $stt = 1;

            ?>
              <div class="table-responsive-lg mt-3">
                <table class="table table-secondary table-hover table-bordered table-sm text-center table-bordered mb-3 border border-dark">
                    <thead class="bg-browns text-light">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ngày cập nhật</th>
                        <th scope="col">Người sửa</th>
                        <th scope="col">Nội dung thay đổi</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php

            foreach ($thongtin as $tt) {
                ?>
                        <tr class="">
                            <th scope="row"><?php echo $stt++; ?></th>
                            <td><?php 
                                echo date("d-m-Y", strtotime($tt->ngaytao));  
                            ?></td>
                            <td>
                                <?php 
                                    $thongtinadmin = $admin->LayThongTinAdminBangMa($tt->maadmin);
                                    echo $tenadmin = $thongtinadmin->hovaten;
                                ?>
                            </td>
                            <td><?php echo $tt->noidungsua?></td>
                        </tr>
                <?php
            }
            ?> 
                    </tbody>
                </table>
            </div>
            <?php
        }
    }else{
        ?>
            <div class="alert alert-danger" role="alert">
                Lỗi... Không tìm thấy thông tin tài khoản cần xem...!
            </div>
        <?php
    }
?>