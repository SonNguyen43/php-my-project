<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>
<?php
    require "../../../models/danhmuc.php";

    $stt= 1;
    $danhmuc = new danhmuc();
    $danhsach = $danhmuc->tatcadanhmuc();
?>

<script>
    $(document).ready(function(){

        $('#tabledanhmuc').dataTable( {
            "language": {
            "sProcessing":   "Đang xử lý...",
            "sLengthMenu":   "Số dòng _MENU_",
            "sZeroRecords":  "Không tìm thấy thông tin nào phù hợp",
            "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ thể loại",
            "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 thể loại",
            "sInfoFiltered": "(được lọc từ _MAX_ thể loại)",
            "sInfoPostFix":  "",
            "sSearch":       "Nhập thông tin cần tìm:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Đầu",
                "sPrevious": "Trước",
                "sNext":     "Tiếp",
                "sLast":     "Cuối"
                }
            }
        } );
    }); 
  </script>   

<div class="container-table">
  <table id="tabledanhmuc" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
                <th>STT</th>
                <th>Mã</th>
                <th>Tên_Danh_Mục</th>
                <th>Chức_Năng</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i =1;
                foreach ($danhsach as $ds) {
                    ?>
                        <tr class="onRow">
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $ds->ma_loai_sach; ?></td>
                            <td>
                               <?php echo $ds->ten_loai_sach; ?>
                            </td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#suadanhmuc">Sửa</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#xoadanhmuc">Xóa</button>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>    
    </table>
</div>



<!-- Modal sửa -->
<div class="modal fade" id="suadanhmuc" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-edit text-warning"></i> Sửa danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_suadanhmuc" class="text-left">
                    <input type="text" name="maloaisach" id="maloaisachsua" class="p-0 d-none">
                    <div class="form-group">
                        <label for=""><b>Tên danh mục:</b></label>
                        <input type="text" name="tenloaisach" id="tenloaisachsua" class="p-0 border-0">
                    </div>
                    <div class="float-right">
                        <button type="sumit" class="btn btn-outline-primary save">Lưu thay đổi</button>
                        <button type="button" class="btn btn-secondary dongform" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Model xóa -->
<div class="modal fade" id="xoadanhmuc" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-trash-alt text-danger"></i> Xóa danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_xoadanhmuc" class="text-left">
                    <input type="text" name="maloaisach" id="maloaisachxoa" class="p-0 d-none">
                    <div class="form-group">
                        <label for=""><b>Bạn muốn xóa danh mục này:</b></label>
                        <div type="text" name="tenloaisach" id="tenloaisachxoa" class="p-0 border-0"></div>
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
            url: "views/quanli/danhmuc/danhsach.php",
            success: function(result){
                $("#danhsachdanhmuc").html(result);
            }
        });
    }

    $(document).ready(function(){
        $('#tabledanhmuc tr').click(function (e) {
            document.getElementById("maloaisachsua").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("tenloaisachsua").value = $(this).closest('.onRow').find('td:nth-child(3)').text().trim();

            document.getElementById("maloaisachxoa").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("tenloaisachxoa").innerHTML = $(this).closest('.onRow').find('td:nth-child(3)').text().trim();
        });

        // sửa
        $("#form_suadanhmuc").on('submit', function(event){
            event.preventDefault();

            if($("#tenloaisachsua").val() != '' && $("#tenloaisachsua").val().trim() != 0 && $("#maloaisachsua").val() != 0){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();

                // sửa 
                $.ajax({
                    url: "views/quanli/danhmuc/sua.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        $(".save").addClass("d-none");
                        $('#suadanhmuc').modal('hide')
                        reloaddanhsach()
                        Swal.fire({ icon: 'success',  title: 'Đã sửa', showConfirmButton: false, timer: 1500 })
                        
                    }
                });
            }else{
                $('#form_suadanhmuc')[0].reset();
                Swal.fire({  title: 'Error!',title: 'Vui lòng điền đầy đủ thông tin',icon: 'error',confirmButtonText: 'Đóng'});
            }
        });

        // xóa
        $("#form_xoadanhmuc").on('submit', function(event){
            event.preventDefault();

            if($("#maloaisachsua").val() != 0){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();

                // xóa 
                $.ajax({
                    url: "views/quanli/danhmuc/xoa.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        $(".save").addClass("d-none");
                        Swal.fire({ icon: 'success',   title: 'Đã xóa',showConfirmButton: false,timer: 1500})
                        $('#xoadanhmuc').modal('hide')
                        reloaddanhsach()
                    }
                });
            }else{
                $('#form_suadanhmuc')[0].reset();
                Swal.fire({ title: 'Error!', title: 'Không nhận đủ thông tin', icon: 'error', confirmButtonText: 'Đóng' });
            }
        });

        $(".dongform").click(function(){
            reloaddanhsach();
        });

    });
</script>

<style>
    input[type="text"].content_tendanhmuc{
        border:0;
    }
    input[type="text"].content_tendanhmuc:hover{
        border-bottom:0;
    }
    input[type="text"].content_tendanhmuc:focus{
        border-bottom:1px solid #000;
    }
    .modal-backdrop{
        display: none;
    }
</style>


