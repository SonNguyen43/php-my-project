<?php
    require "./models/nhanvien.php";

    $nhanvien = new nhanvien();
    $thongtin = $nhanvien->thongtinnhanvienbangmanhanvien($_SESSION['nhanvien']);
?>

<div class="menu-left shadow position-fixed p-3">
    <h2 class="mt-3 text-center text-danger">Nhà Sách Giá Trên Trời</h2>
    <hr>
    <h3 class="text-center text-success"><?php echo $thongtin->ten_nhan_vien; ?></h3>
    <div class="text-center"> <small ><span class="dacbiet">꧁</span> <span class="text-primary">(<?php echo $thongtin->type; ?>)</span> <span class="dacbiet">꧂</span> </small></div>
    <hr>

    <a href="./?danhmuc" class="alert border text-center d-block text-decoration-none <?php if(isset($_GET['danhmuc'])) {echo "text-danger active";} ?>" >Quản lí Danh Mục</a>
    <a href="./?tacgia" class="alert border text-center d-block text-decoration-none  <?php if(isset($_GET['tacgia'])) {echo "text-danger active";} ?>">Quản lí Tác Giả</a>
    <a href="./?nxb" class="alert border text-center d-block text-decoration-none  <?php if(isset($_GET['nxb'])) {echo "text-danger active";} ?>">Quản lí Nhà Xuất Bản</a>
    <a href="./?nhanvien" class="alert border text-center d-block text-decoration-none  <?php if(isset($_GET['nhanvien'])) {echo "text-danger active";} ?>">Quản lí Nhân Viên</a>
    <a href="./?khachhang" class="alert border text-center d-block text-decoration-none  <?php if(isset($_GET['khachhang'])) {echo "text-danger active";} ?>">Quản lí Khách Hàng</a>
    <a href="./?sach" class="alert border text-center d-block text-decoration-none  <?php if(isset($_GET['sach'])) {echo "text-danger active";} ?>">Quản lí Sách</a>
    <a href="./?hoadon" class="alert border text-center d-block text-decoration-none  <?php if(isset($_GET['hoadon'])) {echo "text-danger active";} ?>">Quản lí Hóa Đơn</a>
   
   <div class="fixed-bottom">
        <form method="POST" action="controllers/nhanvienController.php?yeucau=dangxuat" class="form-inline mr-5 my-2 my-lg-0">
            <button class="btn btn-outline-danger btn-sm" type="submit" style="width: 300px; margin-bottom: 5px">Đăng Xuất</button>
        </form>
   </div>
</div>

<style>
    a.alert{
        color: #3c3c3c;
        box-shadow:0 .125rem .25rem rgba(0,0,0,.075);
    }
    a.active{
        box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.2), 0 0px 0 1px rgba(10, 10, 10, 0.02);
    }
    .menu-left{
        height: 100vh;
        overflow: hidden;
    }
</style>

