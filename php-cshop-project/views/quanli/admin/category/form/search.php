<div class="card mb-3 shadow-bulma border-warning">
    <div class="card-body">
        <form method="post" id="form_search_category">
            <h3>Tìm kiếm</h3>
            <div class="form_group">
                <div class="input-group">
                    <input type="text" class="form-control search" name="name" id="search" autocomplete="off" aria-describedby="inputGroupPrepend" required placeholder="Nhập từ khóa..." aria-controls="table_catagory">
                    <div class="invalid-feedback">
                    Please choose a username.
                    </div>
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group mt-3 d-none">
                <input type="submit" class="btn btn-secondary" value="Tìm kiếm" id="btn_search">
            </div>

            <div id="recording" class="text-center mt-3"><div class="spinner-grow text-success" role="status">
                <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-danger" role="status">
                <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-warning" role="status">
                <span class="sr-only">Loading...</span>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#search").on("keyup", function() {
            var name = $(this).val();
            // $("#table_catagory tr.onRow").filter(function() {
            //     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            // });

            $("#list_category").load("views/quanli/admin/category/list.php",{name: name});
        });

        $("#btn_search").on('click', function(event){
            event.preventDefault();
        });
    });
</script>

<!-- JS -->
<script src="public/js/voicesearch.js"></script>

<style>
    #recording{
        display:none;
    }
</style>