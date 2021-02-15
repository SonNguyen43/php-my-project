<?php
    require "./models/user.php";

    if(isset($_SESSION['user'])){
        $user = new User();
        $user_info =  $user->UserInfo($_SESSION['user']);
    }
?>

<nav class="navbar navbar-expand-lg navbar-light pt-3 pb-3 fixed-top shadow-bulma">
    <div class="container">
        <a class="navbar-brand position-relative" href="./">
            <span class="position-absolute shop">
                <span>Shop</span>
            </span>
            <img src="./public/images/logo/logo.png" width="70px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav mr-auto" style="width: 73%; margin-left: 20px">
                <div class="col-md-12">
                    <div class="position-relative">
                       
                        <form action="./" method="GET">
                            <button type="submit" class="position-absolute pl-3 pr-3 rounded border-0" style="background: linear-gradient(to bottom, #f53d2d,#ff6433); top:3px; right:5px;">
                                <i class="fas fa-search  p-2 text-white" style="font-size: 15px"></i>
                            </button>
                            <input type="text" class="form-control p-3 shadow-sm" name="tu_khoa" placeholder="Nhập từ khóa..." autocomplete="off" required>
                        </form>
                        
                    </div>
                </div>
                <?php
                    if(isset($_SESSION['user'])){
                ?>   
                    <div class="col-md-1">
                        <div class="position-relative">
                            <div id="number_product_in_cart"></div>
                            <a href="/DoAnPHP/?gio_hang=<?php echo $_SESSION['user']?>"><img src="./public/images/icon/cart.png" style="width: 35px; height: 35px" /></a>
                        </div>
                    </div>
                <?php 
                    }
                ?>
            </div>
        
        <?php
            if(isset($_SESSION['user'])){
                ?>      
                    <div class="dropdown">
                        <span class="btn btn-white dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <b>
                                <img src="<?php if($user_info->avatar == "noImage.png") echo './public/images/noImage.png'; else echo './views/quanli/user/avatar/'.$user_info->avatar; ?>" id="avatar_navbar" alt="" width="30px" height="30px" class="rounded-circle"> 
                                <?php echo $user_info->display_name; ?>
                            </b>
                        </span>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 250px">
                            <a class="dropdown-item" href="./?trang_ca_nhan=<?php echo $user_info->id; ?>">                
                                <i class="fas fa-user"></i> Trang cá nhân
                            </a>
                            <a class="dropdown-item mt-2" href="controllers/user_controller.php?yeucau=dangxuat">                
                                <i class="fas fa-sign-out-alt text-danger"></i> Đăng Xuất
                            </a>
                        </div>
                    </div>
                <?php
            }else{
                ?>
                    <a href="?dang_nhap" class="text-white text-decoration-none mr-2">Đăng Nhập</a> <span class="text-white">/</span> <a href="?dang_ki" class="text-white text-decoration-none ml-2">Đăng Kí</a>
                <?php
            }
        ?>
        </div>
    </div>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#number_product_in_cart").load("views/includes/number_product_in_cart.php");
    });
</script>

<style>
    a.text-decoration-none:hover{
        opacity: 0.5;
    }
    .navbar{
        background: linear-gradient(to bottom, #f53d2d,#ff6433);
    }
    .shop{
        line-height: 70px;
        font-size: 18px;
        margin-left: 20px;
        color: white;
        font-family: 'Dancing Script', cursive;
        text-shadow: 1px 2px 3px rgba(0,0,0,.7);
    }
</style>

<?php
    if (isset($_GET['tu_khoa'])) {
        ?>
            <div class="container" style="margin-top: 120px;">
                <div class="card">
                    <div class="row card-body">
                        <div class="col-md-12">
                            <h4>Kết quả tìm kiếm</h4>
                            <hr>
                        </div>
                        <?php
                            require "models/product.php";
                            require "models/category.php";
                            $product = new Product();
                            $category = new Category();

                            $tu_khoa = $_GET['tu_khoa'];
                            $all_product = $product->FindProducts($tu_khoa);

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
                                                <p>
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
            </div>
        <?php
    }
?>
