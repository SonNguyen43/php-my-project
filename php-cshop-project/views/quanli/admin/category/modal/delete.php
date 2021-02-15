<!-- Modal -->
<div class="modal fade" id="delete_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash"></i> Xóa Danh Mục</h5>
                <button type="button" class="close close_form" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_delete_category" class="text-left">
                    <input type="text" name="id" id="catagory_id_delete" class="p-0 d-none">
                    <div class="form-group">
                        <label for=""><b>Bạn muốn xóa danh mục này:</b></label>
                        <b id="catagory_name_delete" class="p-0 border-0 text-danger"></b> ?
                    </div>
                    <div class="float-right">
                        <button type="sumit" class="btn btn-outline-danger submit">Xóa</button>
                        <button type="buttom" class="btn btn-dark close_form" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script>
    $(document).ready(function(){
        $("#form_delete_category").on('submit', function(event){
            // không load lại trang
            event.preventDefault();
            if($("#catagory_id_delete").val() != ''){
                var form_data = $(this).serialize();

                $.ajax({
                    url: "controllers/category_controller.php?yeucau=xoa",
                    method: "POST",
                    data: form_data,
                    success: function(data){

                        $(".submit").css("display", "none");

                        $(".close_form").click(function(){
                            $("#list_category").load("views/quanli/admin/category/list.php");
                        });

                        Swal.fire({icon: 'success',title: 'Đã xóa',showConfirmButton: false,timer: 1500});
                        $("#statistical").load("views/quanli/admin/category/form/statistical.php");
                    }
                });
            }else{
                Swal.fire({icon: 'error',title: 'Không nhận được thông tin',showConfirmButton: false,timer: 1500});
            }
        });
    });
</script>
