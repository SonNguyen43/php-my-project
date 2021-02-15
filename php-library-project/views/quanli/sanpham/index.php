
<div class="container-fluid mb-3" style="margin-top: 75px">

    <div class="row">
        <div class="col-md-4">
            <?php 
                require "views/forms/timkiemsanpham.php"; 
                require "views/forms/themsanpham.php"; 
            ?>
            <div id="thongtin"></div>
        </div>
        <div class="col-md-8" id="danhsachsanpham">
            
        </div>
       
    </div>
</div>


<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>

<script>
    $(document).ready(function(){
        // chỉ load lên 1 lần - để realtime thực hiện ở file themdanhmuc.php
        $("#danhsachsanpham").load("views/quanli/sanpham/danhsach.php");

        // load thông tin
        $("#thongtin").load("views/quanli/sanpham/thongtin.php");
    });
</script>

<style>
     input[type="text"], input[type="password"], input[type="number"],input[type="search"], select {
        width:100%;
        border:none;
        border-bottom:1px solid #ccc;
        outline:none;
        padding-left:25px;
        font-size: 18px;
        background: rgba(255,255,255,.0);
    }

    input[type="text"]:hover, input[type="password"]:hover {
        border-bottom:1px solid #000;
    }

    input[type="text"]:focus, input[type="password"]:focus {
        border-bottom:1px solid #000;
    }
</style>