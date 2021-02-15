<div class="">
    <div class="row">
        <div class="col-md-12">
            <?php require "views/quanli/admin/product/form/add.php"; ?>
            <?php require "views/quanli/admin/product/form/search.php"; ?>
        </div>
        <div class="col-md-12" id="list_product"></div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script>
    $(document).ready(function(){
        $("#list_product").load("views/quanli/admin/product/list.php");
    });
</script>