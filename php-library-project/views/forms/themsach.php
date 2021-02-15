<?php
    require "./models/nxb.php";
    require "./models/tacgia.php";

    $nxb = new nxb();
    $tacgia = new tacgia();
?>

<div class="card mb-3 shadow-bm">
    <div class="card-body pb-0">
        <form method="post" id="form_themsach">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tên sách: </label>    
                        <input type="text" required name="tensach" id="tensachthem" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Số lượng: </label>    
                        <input type="number" required name="soluong" id="soluongthem" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Đơn giá: </label>    
                        <input type="number" required name="dongia" id="dongiathem" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Mô tả: </label>    
                        <input type="text" required name="mota" id="motathem" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Năm xuất bản: </label>    
                        <input type="date" required name="namxuatban" id="namxuatbanthem" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tác giả</label>
                        <select name="tacgia" id="tacgiathem" class="form-control">
                            <?php
                                foreach ($tacgia->tatcatacgia() as $tg) {
                                    ?>
                                        <option value="<?php echo $tg->ma_tac_gia; ?>"><?php echo $tg->ten_tac_gia; ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nhà xuất bản</label>
                        <select name="nxb" id="nxbthem" class="form-control">
                            <?php
                                foreach ($nxb->tatcanxb() as $nxb) {
                                    ?>
                                        <option value="<?php echo $nxb->manxb; ?>"><?php echo $nxb->tennxb; ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Thêm mới">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){

        $("#form_themsach").on('submit', function(event){
            event.preventDefault();

            if($("#tensachthem").val() != '' && $("#tensachthem").val().trim() != 0
                && $("#namxuatbanthem").val() != '' && $("#namxuatbanthem").val().trim() != 0
                && $("#dongiathem").val() != '' && $("#dongiathem").val().trim() != 0
                && $("#motathem").val() != '' && $("#motathem").val().trim() != 0
                && $("#soluongthem").val() != '' && $("#soluongthem").val().trim() != 0
                && $("#gioitinh").val() != ''){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();
                // thêm 
                $.ajax({
                    url: "views/quanli/sach/them.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        $('#form_themsach')[0].reset();
                        Swal.fire({icon: 'success',  title: 'Đã thêm sách mới',    showConfirmButton: false, timer: 1500 })
                    }
                });
                
                // reload để hiển thị
                $("#danhsachsach").load("views/quanli/sach/danhsach.php");
            }else{
                Swal.fire({ title: 'Error!',title: 'Vui lòng điền đầy đủ thông tin', icon: 'error', confirmButtonText: 'Đóng'})
            }
        });
    });
</script>


