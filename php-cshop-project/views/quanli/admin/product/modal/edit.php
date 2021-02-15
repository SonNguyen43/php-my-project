<!-- Modal -->
<div class="modal fade" id="modal_edit_product_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash"></i> Sửa Sản Phẩm</h5>
                <button type="button" class="close close_form" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_edit_product" class="text-left">
                    <div class="form-group">
                        <input type="text" name="id" id="product_id_edit" class="p-0 d-none">
                        <label for="">Màu sắc:</label>  
                        <select class="form-control" required name="color">
                            <option value="Đỏ">Đỏ</option>
                            <option value="Xanh">Xanh</option>
                            <option value="Vàng">Vàng</option>
                        </select>  
                    </div>
                    <div class="form-group">
                        <label for="">Kích thước:</label>  
                        <select class="form-control" required name="size">
                            <option value="30">30</option>
                            <option value="40">40</option>
                            <option value="40">40</option>
                        </select>  
                    </div>
                    <span id="info_product">

                    </span>
                    <div class="float-right">
                        <button type="sumit" class="btn btn-outline-primary submit">Sửa</button>
                        <button type="button" class="btn btn-dark close_form" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#form_edit_product").on('submit', function(event){
            // không load lại trang
            event.preventDefault();
            if($("#product_id_delete").val() != ''){
                var form_data = $(this).serialize();
                $.ajax({
                    url: "controllers/product_controller.php?yeucau=sua_thong_tin_san_pham",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        Swal.fire({title: 'Đã xóa thành công !',icon: 'success',timer: 1500})

                        $(".submit").css("display", "none");

                        $(".close_form").click(function(){
                            $("#list_product").load("views/quanli/admin/product/list.php");
                        });

                        Swal.fire({icon: 'success',title: 'Đã sửa',showConfirmButton: false,timer: 1500});
                    }
                });
            }else{
                Swal.fire({icon: 'error',title: 'Không nhận được thông tin',showConfirmButton: false,timer: 1500});
            }
        });
    });
</script>
