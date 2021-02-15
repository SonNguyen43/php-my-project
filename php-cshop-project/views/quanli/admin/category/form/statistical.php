<?php
    require "../../../../../models/category.php";

    $stt= 1;
    $category = new Category();
    $info = $category->AllCategory();
?>

<div class="card mb-3 w-100 shadow border-warning">
    <div class="row no-gutters">
        <div class="col-md-4 pt-3 pl-3 pb-3">
            <img src="views/quanli/admin/category/images/danhmuc2.jpg" class="card-img">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><b>Thông tin</b></h5>
                <p class="card-text">
                    
                    <button type="button" class="btn btn-primary">
                        Tổng số có: <span class="badge badge-light"><i class=""><?php echo count($info); ?></i></span>
                        <span class="sr-only"> </span>
                    </button>

                </p>
            </div>
        </div>
    </div>
</div>