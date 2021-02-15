<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>
<?php
    session_start();
    require "../../../models/nhanvien.php";
    $nhavien = new nhanvien();
    $danhsach = $nhavien->tatcanhanvien();
?>

<script>
    $(document).ready(function(){

        $('#tablenhanvien').dataTable( {
            "language": {
            "sProcessing":   "Đang xử lý...",
            "sLengthMenu":   "Số dòng _MENU_",
            "sZeroRecords":  "Không tìm thấy thông tin nào phù hợp",
            "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ nhân viên",
            "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 nhân viên",
            "sInfoFiltered": "(được lọc từ _MAX_ nhân viên)",
            "sInfoPostFix":  "",
            "sSearch":       "Nhập thông tin cần tìm:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "   Đầu",
                "sPrevious": "Trước",
                "sNext":     "Tiếp",
                "sLast":     "Cuối"
                }
            }
        } );
    }); 
  </script>  

<div class="container-table">
  <table id="tablenhanvien" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
                <th>STT</th>
                <th>Mã</th>
                <th>Tên</th>
                <th>Sđt</th>
                <th>Địa Chỉ</th>
                <th>Giới Tính</th>
                <th>Ngày Sinh</th>
                <th>Trạng Thái</th>
                <th>Chức Năng</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $stt=1;
                foreach ($danhsach as $ds) {
                    $color = rand(1, 7);
                    ?>
                        <tr class="onRow">
                            <td><?php echo $stt++; ?></td>
                            <td><?php echo $ds->ma_nhan_vien; ?></td>
                            <td><?php echo $ds->ten_nhan_vien; ?></td>
                            <td><?php echo $ds->so_dien_thoai; ?></td>
                            <td><?php echo $ds->dia_chi; ?></td>
                            <td><?php echo $ds->gioi_tinh;?></td>
                            <td><?php echo date("Y-m-d", strtotime($ds->ngay_sinh)); ?></td>
                            <td><?php echo $ds->trang_thai_lam_viec; ?></td>
                            <td>
                                <?php 
                                    if($nhavien->thongtinnhanvienbangmanhanvien($_SESSION['nhanvien'])->type == 'admin'){
                                        ?>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#suamatkhau">Đổi Mật Khẩu</button>
                                            <button class="btn btn-primary mt-1" data-toggle="modal" data-target="#suanhanvien">Sửa</button>
                                           
                                            <?php
                                                # chính hắn (admin)
                                                if($nhavien->thongtinnhanvienbangmanhanvien($_SESSION['nhanvien'])->ma_nhan_vien == $ds->ma_nhan_vien){

                                                }else{
                                                    ?>
                                                     <button class="btn btn-danger mt-1" data-toggle="modal" data-target="#xoanhanvien">Xóa</button>

                                                    <?php
                                                }
                                            ?>
                                           
                                        <?php
                                    }else if($_SESSION['nhanvien'] == $ds->ma_nhan_vien){
                                        ?>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#suamatkhau">Đổi Mật Khẩu</button>
                                            <button class="btn btn-primary mt-1" data-toggle="modal" data-target="#suanhanvien">Sửa</button>
                                            <!-- <button class="btn btn-danger mt-1" data-toggle="modal" data-target="#xoanhanvien">Xóa</button> -->
                                        <?php
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>    
    </table>
</div>

<!-- Modal sửa -->
<div class="modal fade" id="suanhanvien" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manhanviensuatieude"></h5>
                <button type="button" class="close dongform" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-suanhanvien">
                    <input type="text" required name="manhanvien" id="manhanviensua" class="d-none">
                    <div class="form-group">
                        <label for="">Tên nhân viên: </label>    
                        <input type="text" required name="tennhanvien" id="tennhanviensua"><div style="margin-top:-25px"><i class="fas fa-signature"></i></div>
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại: </label>    
                        <input type="number" required name="sodienthoai" id="sodienthoaisua"><div style="margin-top:-25px"><i class="fas fa-phone-volume"></i></div>
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ: </label>    
                        <input type="text" required name="diachi" id="diachisua"><div style="margin-top:-25px"><i class="fas fa-map-marker-alt"></i></div>
                    </div>
                    <div class="form-group">
                        <label for="">Ngày sinh: </label>    
                        <input type="date" required name="ngaysinh" id="ngaysinhsua"><div style="margin-top:-25px"><i class="fas fa-birthday-cake"></i></div>
                    </div>
                    <div class="form-group">
                        <label for="">Giới tính: </label> 
                        <select id="gioitinhsua" required name="gioitinh">
                        </select>   
                        <div style="margin-top:-25px"><i class="fas fa-genderless"></i></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Trạng thái: </label> 
                        <select id="trangthaisua" required name="trangthai">
                        </select>   
                        <div style="margin-top:-25px"><i class="fas fa-genderless"></i></div>
                    </div>

                    <div class="form-group float-right">
                        <input type="submit" class="btn btn-outline-primary save" value="Thay đổi">
                        <button type="button" class="btn btn-secondary dongform" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal sửa mật khẩu -->
<div class="modal fade" id="suamatkhau" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sửa mật khẩu</h5>
                <button type="button" class="close dongform" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-suamatkhau">
                    <input type="text" required name="manhanvien" id="manhanviensuamatkhau" class="d-none">
                    <div class="form-group">
                        <label for="">Mật khẩu cũ: </label>    
                        <input type="password" name="matkhaucu" id="matkhaucusua"><div style="margin-top:-25px"><i class="fas fa-unlock-alt"></i></div>
                    </div>
                    <div class="form-group">
                        <label for="">Mật khẩu mới: </label>    
                        <input type="password" required name="matkhaumoi" id="matkhaumoisua"><div style="margin-top:-25px"><i class="fas fa-unlock-alt"></i></div>
                    </div>
                    <div class="form-group">
                        <label for="">Nhập lại: </label>    
                        <input type="password" required name="matkhaumoinhaplai" id="matkhaumoinhaplaisua"><div style="margin-top:-25px"><i class="fas fa-unlock-alt"></i></div>
                    </div>

                    <div class="form-group float-right">
                        <input type="submit" class="btn btn-outline-primary save" value="Thay đổi">
                        <button type="button" class="btn btn-secondary dongform" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Model xóa -->
<div class="modal fade" id="xoanhanvien" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-trash-alt text-danger"></i> Xóa nhân viên</h5>
                <button type="button" class="close dongform" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_xoanhanvien" class="text-left">
                    <input type="text" name="manhanvien" id="manhanvienxoa" class="p-0 d-none">
                    <div class="form-group">
                        <label for=""><b>Bạn muốn xóa nhân viên này:</b></label>
                        <div type="text" name="tennhanvien" id="tennhanvienxoa" class="p-0 border-0"></div>
                    </div>
                    <div class="float-right">
                        <button type="sumit" class="btn btn-outline-danger save">Xóa</button>
                        <button type="button" class="btn btn-secondary dongform" data-dismiss="modal">Đóng</button>
                      
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    // reload để hiển thị
    function reloaddanhsach(){
        $("#danhsachnhanvien").load("views/quanli/nhanvien/danhsach.php");
    }
    
    $(document).ready(function(){
       
        $('#tablenhanvien tr').click(function (e) {
            // gán dữ liệu cho modal sửa
            document.getElementById("manhanviensuatieude").innerHTML = '<i class="fas fa-edit"></i> ' + $(this).closest('.onRow').find('td:nth-child(3)').text().trim();
            document.getElementById("manhanviensua").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("tennhanviensua").value = $(this).closest('.onRow').find('td:nth-child(3)').text().trim();
            document.getElementById("sodienthoaisua").value = $(this).closest('.onRow').find('td:nth-child(4)').text().trim();
            document.getElementById("diachisua").value = $(this).closest('.onRow').find('td:nth-child(5)').text().trim();
            document.getElementById("ngaysinhsua").value = $(this).closest('.onRow').find('td:nth-child(7').text().trim();
            

            if ($(this).closest('.onRow').find('td:nth-child(6)').text().trim() == 'Nữ') {
                document.getElementById("gioitinhsua").innerHTML = '<option value="Nam">Nam</option> <option value="Nữ" selected>Nữ</option>';
            }else{
                document.getElementById("gioitinhsua").innerHTML = '<option value="Nam" selected>Nam</option> <option value="Nữ">Nữ</option>';
            }

            if ($(this).closest('.onRow').find('td:nth-child(8)').text().trim() == 'Còn Làm') {
                document.getElementById("trangthaisua").innerHTML = '<option value="Còn Làm" selected>Còn Làm</option><option value="Nghĩ Làm">Nghĩ Làm</option>';
            }else{
                document.getElementById("trangthaisua").innerHTML = '<option value="Nghĩ Làm" selected>Nghĩ làm</option> <option value="Còn Làm">Còn Làm</option>';
            }

            // gán dữ liệu cho modal  xóa
            document.getElementById("manhanvienxoa").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("tennhanvienxoa").innerHTML = '<i class="fas fa-user-minus"></i> ' + $(this).closest('.onRow').find('td:nth-child(3)').text().trim();
            
            // gán dữ liệu cho sửa mật khẩu
            document.getElementById("manhanviensuamatkhau").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
        });

        // sửa
        $("#form-suanhanvien").on('submit', function(event){
            event.preventDefault();

            if($("#tennhanviensua").val() != '' && $("#tennhanviensua").val().trim() != 0
                && $("#tennhanviensua").val() != '' && $("#tennhanviensua").val().trim() != 0
                && $("#sodienthoaisua").val() != '' && $("#sodienthoaisua").val().trim() != 0
                && $("#diachisua").val() != '' && $("#diachisua").val().trim() != 0
                && $("#ngaysinhsua").val() != '' && $("#ngaysinhsua").val().trim() != 0
                && $("#gioitinhsua").val() != ''){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();

                // sửa 
                $.ajax({
                    url: "views/quanli/nhanvien/sua.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        

                        $('#suanhanvien').modal('hide')
                        reloaddanhsach()

                        Swal.fire({icon: 'success',title: 'Đã sửa', showConfirmButton: false,timer: 1500})
                    }
                });
            }else{
                // $('#form-suanhanvien')[0].reset();
                 Swal.fire({
                    title: 'Error!',
                    title: 'Vui lòng điền đầy đủ thông tin',
                    icon: 'error',
                    confirmButtonText: 'Đóng'
                });
            }
        });

        // sửa mật khẩu
        $("#form-suamatkhau").on('submit', function(event){
            event.preventDefault();
            if($("#manhanviensua").val() != ''){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();

                if($("#matkhaumoisua").val() != '' && $("#matkhaumoisua").val().trim() != 0
                    && $("#matkhaumoinhaplaisua").val() != '' && $("#matkhaumoinhaplaisua").val().trim() != 0){
                        if($("#matkhaumoisua").val() == $("#matkhaumoinhaplaisua").val()){
                            $.ajax({
                                url: "views/quanli/nhanvien/suamatkhau.php",
                                method: "POST",
                                dataType:"json",
                                data: form_data,
                                success: function(data){
                                    if (data.result == "Success") {
                                        $('#suamatkhau').modal('hide')
                                        Swal.fire({ icon: 'success',title: 'Đã sửa', showConfirmButton: false, timer: 1500});
                                    }else{
                                        Swal.fire({icon: 'error',  title: 'Không đúng mật khẩu cũ',    showConfirmButton: false, timer: 1500 })
                                    }
                                }
                            });
                        }else{
                            Swal.fire({ icon: 'error',title: 'Không trùng mật khẩu nhập lại', showConfirmButton: false, timer: 1500});
                        }
                }else{
                    Swal.fire({ icon: 'error',title: 'Vui lòng điền đầy đủ thông tin', showConfirmButton: false, timer: 1500});
                }
            }else{
                Swal.fire({  title: 'Error!',title: 'Không nhận đủ thông tin', icon: 'error', confirmButtonText: 'Đóng' });
            }
        });

        // xóa
        $("#form_xoanhanvien").on('submit', function(event){
            event.preventDefault();
            if($("#manhanviensua").val() != ''){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();
 
                $.ajax({
                    url: "views/quanli/nhanvien/xoa.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        $('#xoanhanvien').modal('hide')
                        reloaddanhsach()
                        Swal.fire({ icon: 'success',title: 'Đã Xóa', showConfirmButton: false, timer: 1500});
                    }
                });
            }else{
                Swal.fire({  title: 'Error!',title: 'Không nhận đủ thông tin', icon: 'error', confirmButtonText: 'Đóng' });
            }
        });

        $(".dongform").click(function(){
            reloaddanhsach();
        });

    });
</script>


<style>
     .modal-backdrop{
        display: none;
    }
</style>