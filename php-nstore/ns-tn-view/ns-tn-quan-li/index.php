<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>

<div>
<?php
    if(isset($_SESSION['admin'])){
       ?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
            <!-- LOGO -->
            <div class="position-absolute" style="z-index: 999; left: 10px">       
                <a class="btn btn-outline-brown dangxuat rounded-pill" href="ns-tn-controller/admin-controller.php?yeucau=dangxuat">Đăng Xuất</a>
            </div>

            <!-- TIEU DE -->
            <div class="text-center">
                <h1><b class="text-dark" style="text-shadow: 1px 1px #000;">N'Store By Thanh Nhi</b></h1>
            </div>
        </div>
        

        <div class="row mt-3">
            <!-- QUAN LI XUAT KHO -->
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 d-flex justify-content-center mt-3">
                <a href="index.php?page=quanlixuatkho" class="w-100 text-decoration-none">
                    <div class="card mb-3 border border-white card-index-quanli card-1 bg-custom card-menu">
                        <div class="d-flex justify-content-center ">
                            <img src="ns-tn-public/ns-tn-images/default/analytics.png" style="height: 270px; width:270px; padding:50px" alt="" srcset="" width="" class="img-quan-li card-img-top">
                        </div>
                      
                        <div class="card-body">
                            <h3 class="card-title text-center text-browns title-qlad"><strong><b>QUẢN LÍ XUẤT KHO</b></strong></h3>
                        </div>
                    </div>
                </a>
            </div>  <!-- END QUAN LI XUAT KHO -->

            <!-- QUAN LI NHA PHAN PHOI -->
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mt-3 d-flex justify-content-center">
                <a href="index.php?page=quanlinhaphanphoi" class="w-100 text-decoration-none">
                    <div class="card mb-3 border border-white card-index-quanli bg-custom card-menu blur-menu">
                        <div class="d-flex justify-content-center ">
                            <img src="ns-tn-public/ns-tn-images/default/guests.png" style="height: 270px; width:270px;padding:50px" alt="" srcset="" width="" class="img-quan-li card-img-top">
                        </div>
                      
                        <div class="card-body">
                            <h3 class="card-title text-center text-browns title-qlad"><strong><b>Q.LÍ NHÀ PHÂN PHỐI</b></strong></h3>
                        </div>
                    </div>
                </a>
            </div>  <!-- END QUAN LI NHA PHAN PHOI -->

            <!-- QUAN LI TON KHO -->
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mt-3 d-flex justify-content-center">
                <a href="index.php?page=quanlitonkho" class="w-100 text-decoration-none">
                    <div class="card mb-3 border border-white card-index-quanli bg-custom card-menu">
                        <div class="d-flex justify-content-center">
                            <img src="ns-tn-public/ns-tn-images/default/storage.png" style="height: 270px; width:270px;padding:50px" alt="" srcset="" width="" class="img-quan-li card-img-top">
                        </div>
                      
                        <div class="card-body">
                            <h3 class="card-title text-center text-browns title-qlad"><strong><b>QUẢN LÍ TỒN KHO</b></strong></h3>
                        </div>
                    </div>
                </a>
            </div>  <!-- END QUAN LI TON KHO -->

            <!-- QUAN LI HANG HOA -->
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mt-3">
                <a href="index.php?page=hanghoa" class="w-100 text-decoration-none">
                    <div class="card mb-3 border border-white card-index-quanli bg-custom card-menu">
                        <div class="d-flex justify-content-center">
                            <img src="ns-tn-public/ns-tn-images/default/hanghoa.png" style="height: 270px; width:270px;padding:50px" alt="" srcset="" width="" class="img-quan-li card-img-top">
                        </div>
                      
                        <div class="card-body">
                            <h3 class="card-title text-center text-browns title-qlad"><strong><b>QUẢN LÍ HÀNG HÓA</b></strong></h3>
                        </div>
                    </div>
                </a>
            </div>  <!-- END QUAN LI HANG HOA -->

            <!-- QUAN LI NHA THUOC -->
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mt-3">
                <a href="index.php?page=nhathuoc" class="w-100 text-decoration-none">
                    <div class="card mb-3 border border-white card-index-quanli bg-custom card-menu">
                        <div class="d-flex justify-content-center">
                            <img src="ns-tn-public/ns-tn-images/default/nhathuoc.png" style="height: 270px; width:270px;padding:50px" alt="" srcset="" width="" class="img-quan-li card-img-top">
                        </div>
                      
                        <div class="card-body">
                            <h3 class="card-title text-center text-browns title-qlad"><strong><b>QUẢN LÍ NHÀ THUỐC</b></strong></h3>
                        </div>
                    </div>
                </a>
            </div>  <!-- END QUAN LI NHA THUOC -->
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
</div>
