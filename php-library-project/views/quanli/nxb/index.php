
<div class="container mb-3" style="margin-top: 75px">
    <!-- <h3 class="text-center text-success" style="font-family: 'Baloo Bhai', cursive;">Quản Lí Nhân Viên</h3> -->

    <div class="row">
        <div class="col-md-4">
            <?php 
                // require "views/forms/timkiemnxb.php"; 
                require "views/forms/themnxb.php"; 
            ?>
        </div>
        <div class="col-md-8" id="danhsachnxb"></div>
        
    </div>
</div>

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
          <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
              <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>
<script>
    $(document).ready(function(){
        // chỉ load lên 1 lần - để realtime thực hiện ở file themdanhmuc.php
        $("#danhsachnxb").load("views/quanli/nxb/danhsach.php");
    });
</script>


<style>
     input[type="text"], input[type="password"], input[type="date"], input[type="number"], input[type="search"],input[type="email"],  select {
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

