<?php
    require "../../../models/hoadon.php";
    require "../../../models/sach.php";

    $hoadon = new hoadon();

    $sach = new Sach();
    $danhsachsach = $sach->tatcasach();
?>

<div class="card-body">
    <form method="post" id="formthemsanpham" class="text-left">
        <div class="form-group">
            <label for=""><b>Mã Hóa Đơn:</b></label>
            <input type="text" name="mahoadon" id="mahoadonthem" readonly value="<?php echo $hoadon->hoadonhientai()->MAX;?>"><div style="margin-top:-25px"><i class="fas fa-sort-numeric-down"></i></div>
        </div>
        <div class="form-group">
            <label for=""><b>Chọn sản phẩm:</b></label>
            <select required name="masanpham" id="masanphamthem">
                <?php
                    foreach ($danhsachsach as $ds) {
                        ?>
                            <option value="<?php echo $ds->ma_sach; ?>"><?php echo $ds->ten_sach;?></option>
                        <?php
                    }
                ?>
            </select>   
            <div style="margin-top:-25px"><i class="fas fa-genderless"></i></div>
        </div>
        <div class="form-group">
            <label for=""><b>Số Lượng:</b></label>
            <input type="number" required min="1" name="soluong" id="soluongthem"><div style="margin-top:-25px"><i class="fas fa-sort-amount-down"></i></div>
        </div>
        <div class="float-right mt-3">
            <button type="button" class="btn btn-outline-secondary" id="huyhoadon">Hủy hóa đơn</button>
            <button type="sumit" class="btn btn-primary save">Thêm</button>
        </div>
    </form>
</div>

<div class="mt-3">
    <div class="card-body" id="danhsachdonhang">
        
    </div>
</div>


<script>
    $(document).ready(function(){

        // thêm sản phẩm vào hóa đơn
        $("#formthemsanpham").on('submit', function(event){
            event.preventDefault();

            if($("#makhachhangthem").val() != '' && $("#makhachhangthem").val().trim() != 0){
 
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();

                // thêm 
                $.ajax({
                    url: "views/quanli/hoadon/themsanphamchohoadon.php",
                    method: "POST",
                    data: form_data,
                    dataType: 'json',
                    success: function(data){
                        if(data.result == "0"){
                            // alert thông báo
                            Swal.fire({
                                title: 'Error!',
                                title: 'Món hàng đã tồn tại',
                                icon: 'error',
                                confirmButtonText: 'Đóng'
                            });
                        }else{
                            // alert thông báo
                            // Swal.fire({
                            //     // position: 'top-end',
                            //     icon: 'success',
                            //     title: 'Đã thêm',
                            //     showConfirmButton: false,
                            //     timer: 1500
                            // });

                            // thêm thành công reload danh sách
                            $('#danhsachdonhang').load("views/quanli/hoadon/danhsachdonhang.php", {mahoadon: $('#mahoadonthem').val() });

                            // update tổng giá cho hóa đơn (thêm và xóa)
                            $.ajax({
                                url: "views/quanli/hoadon/updatetonggia.php",
                                method: "POST",
                                data: {mahoadon: $('#mahoadonthem').val()},
                                dataType: 'json',
                                success: function(data){
                                    
                                }
                            });  
                        }
                    }
                });
            }else{
                $('#formtaohoadon')[0].reset();
                Swal.fire({
                    title: 'Error!',
                    title: 'Vui lòng điền đầy đủ thông tin',
                    icon: 'error',
                    confirmButtonText: 'Đóng'
                });
            }
        });

        // hủy hóa đơn
        $('#huyhoadon').click(function(){
            var mahoadon = $('#mahoadonthem').val();
            $.ajax({
                url: "views/quanli/hoadon/huyhoadon.php",
                method: "POST",
                data: {mahoadon: mahoadon},
                success: function(data){
                   // alert thông báo
                   Swal.fire({
                        // position: 'top-end',
                        icon: 'success',
                        title: 'Đã hủy đơn hàng',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // chờ thời gian alert xong
                    setTimeout(function(){
                        window.location.href = "../Sach/?hoadon";
                    }, 1500);
                }
            });
        });
    });
</script>