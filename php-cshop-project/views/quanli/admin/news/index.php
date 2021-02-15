<div class="">
    <div class="row">
        <div class="col-md-12">
            <?php require "views/quanli/admin/news/form/add.php"; ?>
        </div>

        <div class="col-md-12" id="list_news"></div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script>
    $(document).ready(function(){
        $("#list_news").load("views/quanli/admin/news/list.php");
    });
</script>