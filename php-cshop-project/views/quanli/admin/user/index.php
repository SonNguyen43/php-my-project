
<div class="row">
    <div class="col-md-12">
        <?php require "views/quanli/admin/user/form/add.php"; ?>
    </div>
    <div class="col-md-6" >
        <?php require "views/quanli/admin/user/form/search.php"; ?>
    </div>
    <div class="col-md-6">
        <div id="statistical" class="d-inline"></div>
    </div>
    <div class="col-md-12" id="list_user"></div>
</div>

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script>
    $(document).ready(function(){
        $("#list_user").load("views/quanli/admin/user/list.php");
        $("#statistical").load("views/quanli/admin/user/form/statistical.php");
    });
</script>

