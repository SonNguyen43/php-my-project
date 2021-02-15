<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>

<?php
    session_start();
    require "../../../models/sach.php";
    require "../../../models/nxb.php";
    require "../../../models/tacgia.php";

    $sach = new Sach();
    $nxb = new nxb();
    $tacgia = new tacgia();

    $danhsach = $sach->tatcasach();
?>

<script>
    $(document).ready(function(){

        $('#tablesach').dataTable( {
            "language": {
            "sProcessing":   "Đang xử lý...",
            "sLengthMenu":   "Số dòng _MENU_",
            "sZeroRecords":  "Không tìm thấy thông tin nào phù hợp",
            "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ sách",
            "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 sách",
            "sInfoFiltered": "(được lọc từ _MAX_ sách)",
            "sInfoPostFix":  "",
            "sSearch":       "Nhập thông tin cần tìm:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "  Đầu",
                "sPrevious": "Trước",
                "sNext":     "Tiếp",
                "sLast":     "Cuối"
                }
            }
        } );
    }); 
  </script>  
  
  <div class="container-table">
  <table id="tablesach" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
                <th>STT</th>
                <th>Mã</th>
                <th>Tên</th>
                <th>Số Lượng</th>
                <th>Đơn Giá</th>
                <th>Mô Tả</th>
                <th>Năm Xuất Bản</th>
                <th>Tác Giả</th>
                <th>Nhà Sản Xuất</th>
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
                            <td><?php echo $ds->ma_sach; ?></td>
                            <td><?php echo $ds->ten_sach; ?></td>
                            <td><?php echo $ds->so_luong; ?></td>
                            <td><?php echo $ds->don_gia; ?></td>
                            <td><?php echo $ds->mo_ta;?></td>
                            <td><?php echo $ds->nam_xuat_ban; ?></td>
                            <td><?php echo $tacgia->thongtintacgia($ds->ma_tac_gia)->ten_tac_gia; ?></td>
                            <td><?php echo $nxb->thongtinnhaxuatban($ds->ma_nha_xuat_ban)->tennxb; ?></td>
                            <td>      
                                <button class="btn btn-primary mt-1" data-toggle="modal" data-target="#suasach">Sửa</button>
                                <button class="btn btn-danger mt-1" data-toggle="modal" data-target="#xoasach">Xóa</button>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>    
    </table>
</div>


<!-- <div class="table-responsive mb-3 table-sm shadow-bm">
    <table class="table table-light table-striped table-hover text-center " id="tablesach">
        <thead>
            <tr>
                <th>Mã</th>
                <th>Tên</th>
                <th>Số Lượng</th>
                <th>Đơn Giá</th>
                <th>Mô Tả</th>
                <th>Năm Xuất Bản</th>
                <th>Tác Giả</th>
                <th>Nhà Sản Xuất</th>
                <th>Chức Năng</th>
            </tr>
        </thead>
        <tbody>
            <?php
                
                foreach ($danhsach as $ds) {
                    $color = rand(1, 7);
                    ?>
                        <tr class="onRow">
                            <td><?php echo $ds->ma_sach; ?></td>
                            <td><?php echo $ds->ten_sach; ?></td>
                            <td><?php echo $ds->so_luong; ?></td>
                            <td><?php echo $ds->don_gia; ?></td>
                            <td><?php echo $ds->mo_ta;?></td>
                            <td><?php echo $ds->nam_xuat_ban; ?></td>
                            <td><?php echo $tacgia->thongtintacgia($ds->ma_tac_gia)->ten_tac_gia; ?></td>
                            <td><?php echo $nxb->thongtinnhaxuatban($ds->ma_nha_xuat_ban)->tennxb; ?></td>
                            <td>      
                                <button class="btn btn-primary mt-1" data-toggle="modal" data-target="#suasach">Sửa</button>
                                <button class="btn btn-danger mt-1" data-toggle="modal" data-target="#xoasach">Xóa</button>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div> -->

<!-- Modal sửa -->
<div class="modal fade" id="suasach" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="masachsuatieude"></h5>
                <button type="button" class="close dongform" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="from_suasach">
                    <input type="text" required name="masach" id="masachsua" class="d-none">
                    <div class="form-group">
                        <label for="">Tên sách: </label>    
                        <input type="text" required name="tensach" id="tensachsua" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng: </label>    
                        <input type="number" required name="soluong" id="soluongsua" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Đơn giá: </label>    
                        <input type="text" required name="dongia" id="dongiasua" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả: </label>    
                        <input type="text" required name="mota" id="motasua" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Năm xuất bản: </label>    
                        <input type="date" required name="namsuatban" id="namsuatbansua" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tác giả</label>
                        <select name="tacgia" id="tacgiasua" class="form-control">
                            <?php
                                foreach ($tacgia->tatcatacgia() as $tg) {
                                    ?>
                                        <option value="<?php echo $tg->ma_tac_gia; ?>"><?php echo $tg->ten_tac_gia; ?></option>
                                    <?php
                                }
                            ?>
                           
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nhà xuất bản</label>
                        <select name="nxb" id="nxbsua" class="form-control">
                            <?php
                                foreach ($nxb->tatcanxb() as $nxb) {
                                    ?>
                                        <option value="<?php echo $nxb->manxb; ?>"><?php echo $nxb->tennxb; ?></option>
                                    <?php
                                }
                            ?>
                           
                        </select>
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
<div class="modal fade" id="xoasach" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-trash-alt text-danger"></i> Xóa sách</h5>
                <button type="button" class="close dongform" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_xoasach" class="text-left">
                    <input type="text" name="masach" id="masachxoa" class="p-0 d-none">
                    <div class="form-group">
                        <label for=""><b>Bạn muốn xóa sách này:</b></label>
                        <div type="text" name="tensach" id="tensachxoa" class="p-0 border-0"></div>
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
        $("#danhsachsach").load("views/quanli/sach/danhsach.php");
    }
    
    $(document).ready(function(){
       
        $('#tablesach tr').click(function (e) {
            // gán dữ liệu cho modal sửa
            document.getElementById("masachsuatieude").innerHTML = '<i class="fas fa-edit"></i> ' + $(this).closest('.onRow').find('td:nth-child(3)').text().trim();
            document.getElementById("masachsua").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("tensachsua").value = $(this).closest('.onRow').find('td:nth-child(3)').text().trim();
            document.getElementById("soluongsua").value = $(this).closest('.onRow').find('td:nth-child(4)').text().trim();
            document.getElementById("dongiasua").value = $(this).closest('.onRow').find('td:nth-child(5)').text().trim();
            document.getElementById("motasua").value = $(this).closest('.onRow').find('td:nth-child(6)').text().trim();
            document.getElementById("namsuatbansua").value = $(this).closest('.onRow').find('td:nth-child(7)').text().trim();

            // gán dữ liệu cho modal  xóa
            document.getElementById("masachxoa").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("tensachxoa").innerHTML = '<i class="fas fa-user-minus"></i> ' + $(this).closest('.onRow').find('td:nth-child(3)').text().trim();

        });

        // sửa
        $("#from_suasach").on('submit', function(event){
            event.preventDefault();

            if($("#masachsua").val() != ''
                && $("#tensachsua").val() != '' && $("#tensachsua").val().trim() != 0
                && $("#soluongsua").val() != '' && $("#soluongsua").val().trim() != 0
                && $("#dongiasua").val() != '' && $("#dongiasua").val().trim() != 0
                && $("#motasua").val() != '' && $("#motasua").val().trim() != 0
                && $("#namsuatbansua").val() != ''){
                // lấy dữ liệu trong các ô input

                var form_data = $(this).serialize();

                // sửa 
                $.ajax({
                    url: "views/quanli/sach/sua.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        $('#suasach').modal('hide')
                        reloaddanhsach()
                        Swal.fire({icon: 'success',   showConfirmButton: false,  timer: 1500 })
                    }
                });
            }else{
                 Swal.fire({ title: 'Error!',     title: 'Vui lòng điền đầy đủ thông tin', icon: 'error', confirmButtonText: 'Đóng'});
            }
        });

        // xóa
        $("#form_xoasach").on('submit', function(event){
            event.preventDefault();
            if($("#masachxoa").val() != ''){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();
 
                $.ajax({
                    url: "views/quanli/sach/xoa.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        $('#xoasach').modal('hide')
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