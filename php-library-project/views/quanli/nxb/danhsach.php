<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>

<?php
    require "../../../models/nxb.php";
    $nxb = new nxb();
    $danhsach = $nxb->tatcanxb();
?>


 
<script>
    $(document).ready(function(){

        $('#tablenxb').dataTable( {
            "language": {
            "sProcessing":   "Đang xử lý...",
            "sLengthMenu":   "Số dòng _MENU_",
            "sZeroRecords":  "Không tìm thấy thông tin nào phù hợp",
            "sInfo":         "Đang xem _START_ đến _END_ trong số _TOTAL_ nhà xuất bản",
            "sInfoEmpty":    "Đang xem 0 đến 0 trong 0 nhà xuất bản",
            "sInfoFiltered": "(được lọc từ _MAX_ nhà xuất bản)",
            "sInfoPostFix":  "",
            "sSearch":       "Nhập thông tin cần tìm:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Đầu ",
                "sPrevious": "Trước ",
                "sNext":     " Tiếp",
                "sLast":     " Cuối"
                }
            }
        } );
    }); 
  </script>   

<?php
        
?>


<div class="container-table">
  <table id="tablenxb" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            <th>STT</th>
                <th>Mã</th>
                <th>Tên_NXB</th>
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
                            <td><?php echo $ds->manxb; ?></td>
                            <td><?php  echo $ds->tennxb;  ?> </td>
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
    <table class="table table-light table-striped table-hover text-center " id="danhsachnxb">
        <thead>
            <tr>
                <th>#</th>
                <th>Mã</th>
                <th>Tên_NXB</th>
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
                            <td><?php echo $ds->manxb; ?></td>
                            <td><?php  echo $ds->tennxb;  ?> </td>
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
                <h5 class="modal-title" id="tennxbtieude"></h5>
                <button type="button" class="close dongform" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_suanxb">
                    <input type="text" required name="manxb" id="manxbsua" class="d-none">
                    <div class="form-group">
                        <label for="">Tên nhà xuất bản: </label>    
                        <div class="position-absolute"><i class="fas fa-signature"></i></div>
                        <input type="text" required name="tennxb" id="tennxbsua">
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
                <form method="post" id="form_xoanxb" class="text-left">
                    <input type="text" name="manxb" id="manxbxoa" class="p-0 d-none">
                    <div class="form-group">
                        <label for=""><b>Bạn muốn xóa tác giả này:</b></label>
                        <div type="text" name="tentacgia" id="tennxbxoa" class="p-0 border-0"></div>
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
            url: "views/quanli/nxb/danhsach.php",
            success: function(result){
                $("#danhsachnxb").html(result);
            }
        });
    }


    $(document).ready(function(){
       
        $('#danhsachnxb tr').click(function (e) {
            // xóa
            document.getElementById("manxbxoa").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("tennxbxoa").innerHTML = '<i class="fas fa-user-minus"></i> ' + $(this).closest('.onRow').find('td:nth-child(3)').text().trim();
        
            // sửa
            document.getElementById("tennxbtieude").innerHTML = $(this).closest('.onRow').find('td:nth-child(3)').text().trim();
            document.getElementById("tennxbsua").value = $(this).closest('.onRow').find('td:nth-child(3)').text().trim();
            document.getElementById("manxbsua").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
        });

        // sửa
        $("#form_suanxb").on('submit', function(event){
            event.preventDefault();

            if($("#manxbsua").val() != '' && $("#manxbsua").val().trim() != 0
                && $("#tennxbsua").val() != '' && $("#tennxbsua").val().trim() != 0){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();

                // sửa 
                $.ajax({
                    url: "views/quanli/nxb/sua.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        $('#suakhachhang').modal('hide')
                        reloaddanhsach()

                        Swal.fire({icon: 'success', title: 'Đã sửa',showConfirmButton: false,timer: 1500});
                    }
                });
            }else{
                // $('#form-suanhanvien')[0].reset();
                 Swal.fire({ title: 'Error!',   title: 'Vui lòng điền đầy đủ thông tin', icon: 'error',confirmButtonText: 'Đóng'});
            }
        });

        // xóa
        $("#form_xoanxb").on('submit', function(event){
            event.preventDefault();

            if($("#manxbxoa").val() != ''){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();
 
                $.ajax({
                    url: "views/quanli/nxb/xoa.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        $('#xoakhachhang').modal('hide')
                        reloaddanhsach()

                        Swal.fire({icon: 'success', title: 'Đã Xóa', showConfirmButton: false,timer: 1500});
                        $("#thongtin").load("views/quanli/khachhang/thongtin.php");
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