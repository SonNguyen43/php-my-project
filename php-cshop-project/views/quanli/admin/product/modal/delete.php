<!-- Modal -->
<div class="modal fade" id="modal_delete_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash"></i> Xóa Sản Phẩm</h5>
                <button type="button" class="close close_form" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_delete_product" class="text-left">
                    <input type="text" name="id" id="product_id_delete" class="p-0 d-none">
                    <div class="form-group">
                        <label for=""><b>Bạn muốn xóa sản phẩm này ?</b></label>
                        <b id="product_name_delete" class="p-0 border-0 text-danger"></b>
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
        $("#form_delete_product").on('submit', function(event){
            // không load lại trang
            event.preventDefault();
            if($("#product_id_delete").val() != ''){
                var form_data = $(this).serialize();

                $.ajax({
                    url: "controllers/product_controller.php?yeucau=xoa",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        Swal.fire({title: 'Đã xóa thành công !',icon: 'success',timer: 1500})

                        $(".submit").css("display", "none");

                        $(".close_form").click(function(){
                            $("#list_product").load("views/quanli/admin/product/list.php");
                        });

                        Swal.fire({icon: 'success',title: 'Đã xóa',showConfirmButton: false,timer: 1500});
                    }
                });
            }else{
                Swal.fire({icon: 'error',title: 'Không nhận được thông tin',showConfirmButton: false,timer: 1500});
            }
        });
    });
</script>
