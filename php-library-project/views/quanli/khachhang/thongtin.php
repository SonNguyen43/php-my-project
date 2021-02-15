<?php
    require "../../../models/khachhang.php";

    $khachhang = new khachhang();
    $count = count($khachhang->tatcakhachhang());
?>

<div class="card mb-3 w-100">
    <div class="row no-gutters">
        <div class="col-md-4 pt-3 pl-3">
            <img src="public/images/khachhang.jpg" class="card-img">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><b>Thông tin</b></h5>
                <p class="card-text">
                    <button type="button" class="btn btn-primary">
                    Tổng số khách hàng: <span class="badge badge-light"><i class=""><?php echo $count?></i></span>
                        <span class="sr-only"> </span>
                    </button>

                </p>
            </div>
        </div>
    </div>
</div>