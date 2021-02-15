<div class="card mb-3 shadow-bm">
    <div class="card-body">
        <form method="post" id="form-timsach">
            <div class="form-group">
                <label for="">Nhập từ khóa: </label>    
                <input type="search" required name="tensanpham" id="tensachtim" class="search form-control" autocomplete="off">
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#tensachtim").on("keyup", function() {
            var value = $(this).val().toLowerCase();
                $("#tablesach tr.onRow").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $("#form-timsach").on('submit', function(event){
            event.preventDefault();
        });
    });
</script>
