<?php
    // require "./models/category.php";
    require "./models/product.php";

    $product = new Product();
    $category = new Category();

    $all_product = $product->AllProduct();
?>
<div class="container">
    <div class="row card-body">
        <div class="col-md-12">
            <h4>Sản phẩm</h4>
            <hr>
        </div>
        <?php
            foreach ($all_product as $product) {
                $arrayImages = json_decode($product->images, true);
                ?>  
                    <div class="col-md-4 mt-3">
                        <div class="card shadow-bulma">
                            <img src="./views/quanli/admin/product/images/<?php echo $arrayImages[0];?>" class="card-img-top" alt="..." height="300px;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo substr($product->name, 0, 55) . '...'; ?></h5>
                                <p class="card-text">
                                    <b class="text-success"><i> <i class="fa fa-dollar-sign"></i><?php echo number_format($product->prices);?> VNĐ</i></b>
                                </p>
                                <p class="card-text">
                                    <a href="?danh_muc&id=<?php echo $category->CatagoryInfo($product->category_id)->id;?>" class="text-secondary">
                                        <small><i><i class="fa fa-tag"></i> <?php echo $category->CatagoryInfo($product->category_id)->name; ?></i></small>
                                    </a>
                                </p>
                                <a href="?san_pham&id=<?php echo $product->id; ?>" class="btn btn-primary">Chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>
</div>