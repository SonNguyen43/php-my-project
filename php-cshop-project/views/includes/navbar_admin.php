<?php
    require "./models/user.php";
    if(isset($_SESSION['admin'])){
        $user = new User();
        $user_info =  $user->UserInfo($_SESSION['admin']);
    }
?>

<div class="menu fixed-top">
    <div class="position-relative text-center">
        <span class="position-absolute shop">
            <span>Shop</span>
        </span>
        <img src="./public/images/logo/logo.png" width="200px" class="mt-3">
        <hr class="bg-white">
        <h4 class="text-white"><b><?php echo $user_info->display_name . " "; ?></b> <small>(admin)</small></h4>
        <hr class="bg-white">

        <a class="<?php if(isset($_GET['trang_chu'])) {echo "active";} ?>" href="?trang_chu"><div class="alert  rounded-0 font-weight-bold"><i class="fas fa-home"></i> Trang chủ</div></a>
        <a class="<?php if(isset($_GET['danh_muc'])) {echo "active";} ?>" href="?danh_muc"><div class="alert  rounded-0 font-weight-bold"><i class="fas fa-cubes"></i> Danh Mục</div></a>
        <a class="<?php if(isset($_GET['san_pham'])) {echo "active";} ?>" href="?san_pham"><div class="alert  rounded-0 font-weight-bold"><i class="fab fa-apple"></i> Sản Phẩm</div></a>
        <a class="<?php if(isset($_GET['nguoi_dung'])) {echo "active";} ?>" href="?nguoi_dung"><div class="alert  rounded-0 font-weight-bold"><i class="fas fa-users"></i> Người Dùng</div></a>
        <a class="<?php if(isset($_GET['tin_tuc'])) {echo "active";} ?>" href="?tin_tuc"><div class="alert  rounded-0 font-weight-bold"><i class="fas fa-newspaper"></i> Tin Tức</div></a>
        <a class="<?php if(isset($_GET['phan_hoi'])) {echo "active";} ?>" href="?phan_hoi"><div class="alert  rounded-0 font-weight-bold"><i class="fas fa-comment-dots"></i> Phản Hồi</div></a>
        <a class="<?php if(isset($_GET['gioi_thieu'])) {echo "active";} ?>" href="?gioi_thieu"><div class="alert  rounded-0 font-weight-bold"><i class="fas fa-address-card"></i> Giới Thiệu</div></a>
       
    </div>
</div>

<style>
    body{background-color: #e9ebee;}
    .menu{
        width: 100%;
        height: 100vh;
        overflow: hidden;
        background: #f26522;
        position:sticky;
        /* background: linear-gradient(to bottom, #f53d2d,#ff6433); */
    }
    div.menu div div{
        text-align: center;
    }
    div.menu div div:hover{
        /* border-bottom: 5px solid red;
        box-shadow: 3px 3px rgba(255,255,255,.1); */
        text-shadow: 3px 3px 3px rgba(255,255,255,.5);
        color: #fff;
    }
    div.menu div a{
        text-decoration: none;
        color: #000;
    }
    div.menu div a.active{
        color: #fff;
    }
    .shop{
        line-height: 230px;
        font-size: 4em;
        margin-left: 50px;
        color: white;
        font-family: 'Dancing Script', cursive;
        text-shadow: 1px 2px 3px rgba(0,0,0,.7);
    }
</style>