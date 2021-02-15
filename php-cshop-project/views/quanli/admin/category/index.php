<div class="row">
    <div class="col-md-12">
        <?php require "form/add.php";?>
    </div>
    <div class="col-md-4">
        
        <div><?php require "form/search.php";?></div>
        <div id="statistical"></div>

    </div>
    <div class="col-md-8" id="list_category"></div>
</div>

<!-- JS -->
<script>
    $(document).ready(function(){
        $("#list_category").load("views/quanli/admin/category/list.php");

        $("#statistical").load("views/quanli/admin/category/form/statistical.php");
    });
</script>

