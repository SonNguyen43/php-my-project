
<div class="container mb-3" style="margin-top: 75px">
    <div class="row">
        <div class="col-md-12">
            <?php 
               // require "views/forms/timkiemsach.php"; 
                require "views/forms/themsach.php"; 
            ?>
        </div>
        <div class="col-md-12" id="danhsachsach"></div>
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
        $("#danhsachsach").load("views/quanli/sach/danhsach.php");
    });
</script>