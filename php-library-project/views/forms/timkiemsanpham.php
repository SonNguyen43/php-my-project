<div class="card mb-3 shadow-bm">
    <div class="card-body">
        <form method="post" id="form-timsanpham">
            <!-- <h3 class="text-primary" style="font-family: 'Baloo Bhai', cursive;">Tìm Kiếm</h3> -->
            <div class="form-group">
                <label for="">Nhập từ khóa: </label>    
                <input type="search" required name="tensanpham" id="tensanphamtim" class="search" autocomplete="off"><div style="margin-top:-25px"><i class="fas fa-search"></i></div>

                <div id="voice" class="mt-3">
                    <div id="loading">
                        <div class="sk-folding-cube" >
                            <div class="sk-cube1 sk-cube"></div>
                            <div class="sk-cube2 sk-cube"></div>
                            <div class="sk-cube4 sk-cube"></div>
                            <div class="sk-cube3 sk-cube"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#tensanphamtim").on("keyup", function() {
            var value = $(this).val().toLowerCase();
                $("#tablesanpham tr.onRow").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $("#form-timsanpham").on('submit', function(event){
            event.preventDefault();
        });
    });
</script>

<!-- JS -->
<script src="public/js/voicesearch.js"></script>