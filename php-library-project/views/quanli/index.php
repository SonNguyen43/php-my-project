<div class="container mb-3" style="margin-top: 80px;">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <img src="public/images/danhmuc.jpeg" alt="" width="100%" height="270px" class="border border-secondary rounded">
                <a href="./?danhmuc" class="text-decoration-none">
                    <div class="card-body shadow-sm rounded">
                        <h5 class="card-title"><i class="fas fa-money-bill-wave-alt"></i> Danh Mục</h5>
                        <hr>
                        <p class="card-text"></p>
                        <p class="card-text"><small class="text-muted">- Admin & Nhân Viên</small></p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-3">
                <img src="public/images/tacgia.png" alt="" width="100%" height="270px" class="border border-secondary rounded">
                <a href="./?tacgia" class="text-decoration-none">
                    <div class="card-body shadow-sm rounded">
                        <h5 class="card-title"><i class="fas fa-money-bill-wave-alt"></i> Tác Giả</h5>
                        <hr>
                        <p class="card-text"></p>
                        <p class="card-text"><small class="text-muted">- Admin & Nhân Viên</small></p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-3">
                <img src="public/images/nhaxuatban_.jpg" alt="" width="100%" height="270px" class="border border-secondary rounded">
                <a href="./?nxb" class="text-decoration-none">
                    <div class="card-body shadow-sm rounded">
                        <h5 class="card-title"><i class="fas fa-money-bill-wave-alt"></i> Nhà Xuất Bản</h5>
                        <hr>
                        <p class="card-text"></p>
                        <p class="card-text"><small class="text-muted">- Admin & Nhân Viên</small></p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-3">
                <img src="public/images/nhanvien.png" alt="" width="100%" height="270px" class="border border-secondary rounded">
                <a href="./?nhanvien" class="text-decoration-none">
                    <div class="card-body shadow-sm rounded">
                        <h5 class="card-title"><i class="fas fa-money-bill-wave-alt"></i> Nhân Viên</h5>
                        <hr>
                        <p class="card-text"></p>
                        <p class="card-text"><small class="text-muted">- Admin & Nhân Viên</small></p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-3">
                <img src="public/images/khachhang.png" alt="" width="100%" height="270px" class="border border-secondary rounded">
                <a href="./?khachhang" class="text-decoration-none">
                    <div class="card-body shadow-sm rounded">
                        <h5 class="card-title"><i class="fas fa-money-bill-wave-alt"></i> Khách Hàng</h5>
                        <hr>
                        <p class="card-text"></p>
                        <p class="card-text"><small class="text-muted">- Admin & Nhân Viên</small></p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-3">
                <img src="public/images/sach.jpg" alt="" width="100%" height="270px" class="border border-secondary rounded">
                <a href="./?sach" class="text-decoration-none">
                    <div class="card-body shadow-sm rounded">
                        <h5 class="card-title"><i class="fas fa-money-bill-wave-alt"></i> Sách</h5>
                        <hr>
                        <p class="card-text"></p>
                        <p class="card-text"><small class="text-muted">- Admin & Nhân Viên</small></p>
                    </div>
                </a>
            </div>
        </div>
        
        <div class="col-md-12">
            <?php require "./views/includes/footer.php" ?>
        </div>

    </div>
</div>


<style>
    .card{
        border:none;
        background:none;
        box-shadow: 0px 0px;
    }
    .card-body{
        background: #fff;
        margin-left: 10%;
        margin-right: 10%;
        margin-top: -65px;
        border: 1px solid #ccc;
        padding-top: 30px;
        padding-bottom: 30px;
        color: #000;
    }
    small{
        color: #ccc;
    }
    .card-body:hover{
        background-color: rgba(0, 0, 0, .7);
        transition: .5s;
        color: white;
    }
    svg{
        height: 270px;
    }
</style>
