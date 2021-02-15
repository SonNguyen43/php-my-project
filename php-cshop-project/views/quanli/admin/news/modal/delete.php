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
                <form method="post" id="form_delete_news" class="text-left">
                    <input type="text" name="id" id="news_id_delete" class="p-0 d-none">
                    <div class="form-group">
                        <label for=""><b>Bạn muốn xóa tin tức này ?</b></label>
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
        $("#form_delete_news").on('submit', function(event){
            // không load lại trang
            event.preventDefault();
            if($("#news_id_delete").val() != ''){
                var form_data = $(this).serialize();

                $.ajax({
                    url: "controllers/news_controller.php?yeucau=xoa_tin_tuc",
                    method: "POST",
                    data: form_data,
                    success: function(data){

                        $(".submit").css("display", "none");

                        $(".close_form").click(function(){
                            $("#list_news").load("views/quanli/admin/news/list.php");
                        });

                        Swal.fire({icon: 'success',title: 'Đã xóa',showConfirmButton: false,timer: 1500});
                        
                    }
                });
            }else{
                Swal.fire({icon: 'success',title: 'Không nhận được thông tin',showConfirmButton: false,timer: 1500});
            }
        });
    });
</script>


