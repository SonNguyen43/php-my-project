<?php 
    require "../../../models/sanphamchohoadon.php";
    require "../../../models/sach.php";

    if(isset($_REQUEST['mahoadon'])){
        $mahoadon = $_REQUEST['mahoadon'];

        $sanphamchohoadon = new sanphamchohoadon();

        $danhsach = $sanphamchohoadon->sanphamchohoadhon($mahoadon);
        $total = $sanphamchohoadon->tonggiachohoadon($mahoadon);

        $sach = new Sach();
            ?>
                <div class="table-responsive mt-3 table-sm">
                    <table class="table table-light" id="tablesanphamcuahoadon">
                        <thead>
                            <tr>
                                <th>Mã</th>
                                <th>Tên_Sản_Phẩm</th>
                                <th class="text-center">Số_Lượng</th>
                                <th class="text-center">Tổng_Tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                                foreach ($danhsach as $ds) {
                                    ?>
                                        <tr class="onRow">
                                            <td><?php echo $ds->ma_chi_tiet_hoa_don; ?></td>
                                            <td><?php echo $sach->thongtinsach($ds->ma_sach)->ten_sach; ?></td>
                                            <td class="text-center">
                                                <?php echo $ds->so_luong; ?>
                                            </td>
                                            <td class="text-center">
                                               <?php echo number_format($ds->tong_tien); ?>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <h4 class="text-right">Thành Tiền: <?php echo number_format($total->tonggia) . " VNĐ"; ?></h4>
                <hr class="float-none">

                <button class="btn btn-primary float-right" id="hoantat">Hoàn tất</button>
            <?php
    }
?>

<style>
    tr.onRow:hover{
        text-decoration: line-through;
    }
</style>

<script>
    $(document).ready(function(){    
        $('#tablesanphamcuahoadon tr').click(function (e) {
            var mahoadon = <?php echo $mahoadon; ?>;
            var masanphamchohoadon = $(this).closest('.onRow').find('td:nth-child(1)').text().trim();

            $.ajax({
                url: "views/quanli/hoadon/xoasanphamcuahoadon.php",
                method: "POST",
                data: {mahoadon: mahoadon, masanphamchohoadon: masanphamchohoadon},
                success: function(data){
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
            });
        });

        $("#hoantat").on("click", function(event){
            // alert thông báo
            Swal.fire({ icon: 'success', title: 'Đã Lưu dữ liệu',showConfirmButton: false, timer: 1500});

            // chờ thời gian alert xong
            setTimeout(function(){
                window.location.href = "../Sach/?hoadon";
            }, 1500);
        })
    });
</script>