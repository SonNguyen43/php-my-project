
<div class="container-fluid mb-3" style="margin-top: 75px">
    <!-- <h3 class="text-center text-success" style="font-family: 'Baloo Bhai', cursive;">Quản Lí Danh Mục</h3> -->

    <div class="row">
        <div class="col-md-6">
            <?php require "views/forms/themhoadon.php"; ?>
        </div>
        <div class="col-md-6">
            <?php require "views/forms/timkiem_thongke_hoadon.php"; ?>
        </div>
        <div class="col-md-12" id="danhsachhoadon">
            
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        // chỉ load lên 1 lần - để realtime thực hiện ở file themdanhmuc.php
        $("#danhsachhoadon").load("views/quanli/hoadon/danhsach.php");
    });
</script>

<style>
     input[type="text"], input[type="number"], input[type='search'], select {
        width:100%;
        border:none;
        border-bottom:1px solid #ccc;
        outline:none;
        padding-left:25px;
        font-size: 18px;
        background: rgba(255,255,255,.0);
    }

    input[type="text"]:hover, input[type="number"]:hover {
        border-bottom:1px solid #000;
    }

    input[type="text"]:focus, input[type="number"]:focus {
        border-bottom:1px solid #000;
    }
</style>

