<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>
<?php
    require "../../../models/khachhang.php";
    $khachhang = new khachhang();
    $danhsach = $khachhang->tatcakhachhang();
?>
<script>
    $(document).ready(function(){

        $('#tablekhachhang').dataTable( {
            "language": {
            "sProcessing":   "Đang xử lý...",
            "sLengthMenu":   "Số dòng _MENU_",
            "sZeroRecords":  "Không tìm thấy thông tin nào phù hợp",
            "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ khách hàng",
            "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 khách hàng",
            "sInfoFiltered": "(được lọc từ _MAX_ thể loại)",
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
  <table id="tablekhachhang" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
                <th>STT</th>
                <th>Mã</th>
                <th>Tên_Khách_Hàng</th>
                <th>Địa_chỉ</th>
                <th>Số_Điện_Thoại</th>
                <th>Email</th>
                <th>Giới_Tính</th>
                <th>Ngày_Sinh</th>
                <th>Chức_Năng</th>
            </tr>
        </thead>
        <tbody>
        <?php
                $stt = 1;
                foreach ($danhsach as $ds) {
                    $color = rand(1, 7);
                    ?>
                        <tr class="onRow">
                            <td><?php echo $stt++; ?></td>
                            <td><?php echo $ds->ma_khach_hang; ?></td>
                            <td><?php  echo $ds->ten_khach_hang;  ?> </td>
                            <td><?php echo $ds->dia_chi; ?></td>
                            <td><?php echo $ds->so_dien_thoai; ?></td>
                            <td><?php echo $ds->email; ?></td>
                            <td><?php echo $ds->gioi_tinh; ?></td>
                            <td><?php echo date("Y-m-d", strtotime($ds->ngay_sinh));  ?> </td>
                            
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#suakhachhang">Sửa</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#xoakhachhang">Xóa</button>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>    
    </table>
</div>

<!-- <div class="table-responsive mb-3 table-sm shadow-bm">
    <table class="table table-light table-striped table-hover text-center " id="danhsachkhachhang">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã</th>
                <th>Tên_Khách_Hàng</th>
                <th>Địa_chỉ</th>
                <th>Số_Điện_Thoại</th>
                <th>Email</th>
                <th>Giới_Tính</th>
                <th>Ngày_Sinh</th>
                <th>Chức_Năng</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $stt = 1;
                foreach ($danhsach as $ds) {
                    $color = rand(1, 7);
                    ?>
                        <tr class="onRow">
                            <td><?php echo $stt++; ?></td>
                            <td><?php echo $ds->ma_khach_hang; ?></td>
                            <td><?php  echo $ds->ten_khach_hang;  ?> </td>
                            <td><?php echo $ds->dia_chi; ?></td>
                            <td><?php echo $ds->so_dien_thoai; ?></td>
                            <td><?php echo $ds->email; ?></td>
                            <td><?php echo $ds->gioi_tinh; ?></td>
                            <td><?php echo date("Y-m-d", strtotime($ds->ngay_sinh));  ?> </td>
                            
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#suakhachhang">Sửa</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#xoakhachhang">Xóa</button>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div> -->

<!-- Modal sửa -->
<div class="modal fade" id="suakhachhang" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tenkhachhangtieude"></h5>
                <button type="button" class="close dongform" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-suakhachhang">
                    <input type="text" required name="makhachhang" id="makhachhangsua" class="d-none">
                    <div class="form-group">
                        <label for="">Tên khách hàng: </label>    
                        <input type="text" required name="tenkhachhang" id="tenkhachhangsua"><div style="margin-top:-25px"><i class="fas fa-signature"></i></div>
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
                        <label for="">Email: </label>    
                        <input type="email" required name="email" id="emailsua"><div style="margin-top:-25px"><i class="fas fa-birthday-cake"></i></div>
                    </div>
                    <div class="form-group">
                        <label for="">Giới tính: </label> 
                        <select id="gioitinhsua" required name="gioitinh">
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

<!-- Model xóa -->
<div class="modal fade" id="xoakhachhang" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-trash-alt text-danger"></i> Xóa khách hàng</h5>
                <button type="button" class="close dongform" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_xoakhachhang" class="text-left">
                    <input type="text" name="makhachhang" id="makhachhangxoa" class="p-0 d-none">
                    <div class="form-group">
                        <label for=""><b>Bạn muốn xóa khách hàng này:</b></label>
                        <div type="text" name="tenkhachhang" id="tenkhachhangxoa" class="p-0 border-0"></div>
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

    function reloaddanhsach(){
        // reload để hiển thị
        $.ajax({
            url: "views/quanli/khachhang/danhsach.php",
            success: function(result){
                $("#danhsachkhachhang").html(result);
            }
        });
    }


    $(document).ready(function(){
       
        $('#danhsachkhachhang tr').click(function (e) {
            document.getElementById("makhachhangxoa").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("tenkhachhangxoa").innerHTML = '<i class="fas fa-user-minus"></i> ' + $(this).closest('.onRow').find('td:nth-child(3)').text().trim();
        
            document.getElementById("tenkhachhangtieude").innerHTML = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("makhachhangsua").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("tenkhachhangsua").value = $(this).closest('.onRow').find('td:nth-child(3)').text().trim();
            document.getElementById("sodienthoaisua").value = $(this).closest('.onRow').find('td:nth-child(5)').text().trim();
            document.getElementById("diachisua").value = $(this).closest('.onRow').find('td:nth-child(4)').text().trim();
            document.getElementById("ngaysinhsua").value = $(this).closest('.onRow').find('td:nth-child(8)').text().trim();
            document.getElementById("emailsua").value = $(this).closest('.onRow').find('td:nth-child(6)').text().trim();

            if ($(this).closest('.onRow').find('td:nth-child(7)').text().trim() == 'Nữ') {
                document.getElementById("gioitinhsua").innerHTML = '<option value="Nam">Nam</option> <option value="Nữ" selected>Nữ</option>';
            }else{
                document.getElementById("gioitinhsua").innerHTML = '<option value="Nam" selected>Nam</option> <option value="Nữ">Nữ</option>';
            }
        });

        // sửa
        $("#form-suakhachhang").on('submit', function(event){
            event.preventDefault();

            if($("#tenkhachhangsua").val() != '' && $("#tenkhachhangsua").val().trim() != 0
                && $("#sodienthoaisua").val() != '' && $("#sodienthoaisua").val().trim() != 0
                && $("#diachisua").val() != '' && $("#diachisua").val().trim() != 0
                && $("#ngaysinhsua").val() != '' && $("#ngaysinhsua").val().trim() != 0
                && $("#emailsua").val() != '' && $("#emailsua").val().trim() != 0
                && $("#gioitinhsua").val() != '' && $("#gioitinhsua").val().trim() != 0){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();

                // sửa 
                $.ajax({
                    url: "views/quanli/khachhang/sua.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                       

                        $('#suakhachhang').modal('hide')
                        reloaddanhsach()

                        Swal.fire({icon: 'success', title: 'Đã sửa',showConfirmButton: false,timer: 1500});
                        $("#thongtin").load("views/quanli/khachhang/thongtin.php");
                    }
                });
            }else{
                // $('#form-suanhanvien')[0].reset();
                 Swal.fire({ title: 'Error!',   title: 'Vui lòng điền đầy đủ thông tin', icon: 'error',confirmButtonText: 'Đóng'});
            }
        });

        // xóa
        $("#form_xoakhachhang").on('submit', function(event){
            event.preventDefault();

            if($("#makhachhangxoa").val() != ''){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();
 
                $.ajax({
                    url: "views/quanli/khachhang/xoa.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){

                        $('#xoakhachhang').modal('hide')
                        reloaddanhsach()

                        Swal.fire({icon: 'success', title: 'Đã Xóa', showConfirmButton: false,timer: 1500});
                    }
                });
            }else{
                Swal.fire({  title: 'Error!',  title: 'Không nhận đủ thông tin', icon: 'error',confirmButtonText: 'Đóng' });
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