<?php
    require "./models/category.php";
    require "./models/product.php";

    $category = new Category();
    $product = new Product();
?>
<div class="container card">
    <div class="row card-body" style="margin-top: 110px;">
        <?php
            if(isset($_GET['danh_muc']) && isset($_GET['id'])){
                $id_category = $_GET['id'];

                $count = $category->CheckCategory($id_category);

                # tồn tại danh mục
                if($count > 0){
                    $all_product_by_category = $product->AllProductByCategory($id_category);
                    ?>
                        <h1 class="ml-3 col-md-12 text-center" style="font-family: 'Pacifico', cursive;" >
                            <?php echo $category->CatagoryInfo($id_category)->name; ?>
                            <img src="./views/quanli/admin/category/images/<?php echo $category->CatagoryInfo($id_category)->image;?>" alt="..." width="40px" height="40px" class="rounded-circle">
                        </h1>
                        <div class="col-md-12"><hr></div>
                    <?php
                    foreach ($all_product_by_category as $product) {
                        $arrayImages = json_decode($product->images, true);
                        ?>  
                           <div class="col-md-4 mt-3">  
                                <div class="card shadow-bulma">
                                    <img src="./views/quanli/admin/product/images/<?php echo $arrayImages[0];?>" class="card-img-top" alt="..." height="300px;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo substr($product->name, 0, 55) . '...'; ?></h5>
                                        <p class="card-text">
                                            <b class="text-success"><i> <i class="fa fa-dollar-sign"></i> <?php echo number_format($product->prices);?> VNĐ</i></b>
                                        </p>
                                        <p class="card-text">
                                            <a href="?danh_muc&id=<?php echo $category->CatagoryInfo($id_category)->id;?>" class="text-secondary">
                                                <small><i><i class="fa fa-tag"></i> <?php echo $category->CatagoryInfo($id_category)->name; ?></i></small>
                                            </a>
                                        </p>
                                        <a href="?san_pham&id=<?php echo $product->id; ?>" class="btn btn-primary">Chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                }else{
                    ?>
                    <div style="margin-top: 110px"><?php  require "./views/includes/404.php"; ?></div>
                <?php
                }
            }else{
                ?>
                <div style="margin-top: 110px"><?php  require "./views/includes/404.php"; ?></div>
            <?php
            }
        ?>
    </div>
</div>