<div class="container">
    <div class="card-custom mb-3 shadow-sm">
        <div class="card-body">
            <h4>Danh mục</h4>
            <hr>
            <div class="row text-center">
                <?php
                    require "./models/category.php";

                    $category = new Category();
                
                    $info = $category->AllCategory();
                    

                    foreach ($info as $if) {
                        ?>
                            <a href="?danh_muc&id=<?php echo $if->id?>" class="col-6 col-md-2 mt-3 text-decoration-none scroll">
                                <img src="./views/quanli/admin/category/images/<?php echo $if->image; ?>" alt="" width="100px" height="100px" class="rounded-circle">
                                <h6 class="text-dark"><?php echo $if->name; ?></h6>
                            </a>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>