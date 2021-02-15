<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script> -->
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
<?php
    require "../../../ns-tn-model/nha-thuoc-class.php";

    # dữ liệu nhận được từ nha-phan-phoi.js
    if(isset($_REQUEST['tennhathuoc']) || isset($_REQUEST['sodienthoai'])){
        $tennhathuoc = trim($_REQUEST['tennhathuoc']);
        $sodienthoai = trim($_REQUEST['sodienthoai']);
        ?>
            <!-- TABLE -->
            <table class="table table-hover table-bordered table-sm table-light text-center" id="tableNhaThuoc" data-page-length='30'>
                <thead>
                    <tr>
                        <th scope="col" colspan="8">BẢNG TÌM KIẾM</th>
                    </tr>
                    <tr class="bg-browns text-light">
                        <th scope="col">#</th>
                        <th scope="col">Tên nhà thuốc</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Ngày bắt đầu</th>
                        <th scope="col">
                            <span class="d-inline">Khu vực</span>
                            <span class="form-check d-inline ml-2">
                                <input 
                                    id="thaydoikhuvuc"
                                    class="form-check-input checkedngungban" type="checkbox"
                                    onclick="thayDoiKhuVuc()"
                                >
                            </span>
                        </th>
                        <th scope="col">Ngưng bán</th>
                        <th scope="col">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $stt = 1;

                    $nhathuoc = new nhathuocclass();
                    
                    $thongtin = $nhathuoc->TimNhaThuoc($tennhathuoc, $sodienthoai);
                
                    foreach ($thongtin as $tt) {
                ?>
                    <tr>
                        <th scope="row" class="font-weight-normal"><?php echo $stt++; ?></th>
                        <th scope="row" class="font-weight-normal"><b><?php echo $tt->tennhathuoc; ?><b></th>
                        <th scope="row" class="font-weight-normal text-danger"><?php echo $tt->diachi; ?></th>
                        <th scope="row" class="font-weight-normal"><?php echo $tt->sodienthoai; ?></th>
                        <th scope="row" class="font-weight-normal"><?php echo $tt->ngaybatdau; ?></th>
                        <th scope="row" class="font-weight-normal">
                            <b 
                            data-toggle="tooltip" data-placement="top" 
                            title="
                            <?php 
                                if($tt->khuvuc == "Khu vực 1") { echo 'Vị Thanh - Vị Thuỷ - Châu Thành A'; }
                                if($tt->khuvuc == "Khu vực 2") { echo 'Huyện Long Mỹ - Thị xã Long Mỹ'; }
                                if($tt->khuvuc == "Khu vực 3") { echo 'Phụng Hiệp - Ngã 7 - Châu Thành'; }
                            ?>" 
                            class="
                                <?php 
                                    if($tt->khuvuc == "Khu vực 1") { echo 'text-danger'; }
                                    if($tt->khuvuc == "Khu vực 2") { echo 'text-success'; }
                                    if($tt->khuvuc == "Khu vực 3") { echo 'text-dark'; }
                                ?>"
                            >
                                <?php  
                                    echo $tt->khuvuc; 
                                    if($tt->khuvuc == "Khu vực 1") { echo ' <small> (Vị Thanh - Vị Thuỷ - Châu Thành A)</small>'; }
                                    if($tt->khuvuc == "Khu vực 2") { echo ' <small> (Huyện Long Mỹ - Thị xã Long Mỹ)</small>'; }
                                    if($tt->khuvuc == "Khu vực 3") { echo ' <small> (Phụng Hiệp - Ngã 7 - Châu Thành)</small>'; }
                                ?>
                            </b>
                        </th>
                        <th scope="row" class="font-weight-normal">
                            <div class="form-check">
                                <input 
                                    class="form-check-input checkedngungban" type="checkbox" 
                                    value="<?php echo $tt->ngungban?>"
                                    <?php if($tt->ngungban === 'ngungban') echo 'checked'?>
                                    onclick="thayDoiTrangThai(<?php echo $tt->manhathuoc;?>, event)"
                                >
                            </div>
                            <br>
                            <div>
                                <small><?php if($tt->ngungban === 'ngungban') echo "Ngày: " . $tt->ngayngungban; ?></small>
                            </div>
                        </th>
                        <th scope="row" class="font-weight-normal">
                            <button class="btn btn-danger rounded-pill" 
                                onclick="XoaNhaThuoc(<?php echo $tt->manhathuoc;?>, '<?php echo $tt->tennhathuoc;?>')" 
                                data-toggle="modal" data-target="#xoanhathuoc"
                            >Xóa</button>
                            <a href="index.php?page=suanhathuoc&id=<?php echo $tt->manhathuoc;?>" class="btn btn-warning rounded-pill">Sửa</a>
                        </th>
                    </tr>
                    <?php }?>
                </tbody>
            </table>    <!-- END TABLE -->
        <?php
    }else if($_REQUEST['checked']){
        $stt = 1;

        $nhathuoc = new nhathuocclass();
        $checked = $_REQUEST['checked'];
        
        if ($checked == 'true') {
            $thongtin = $nhathuoc->LocKhuVuc();
        }else{
            $thongtin = $nhathuoc->TatCaNhaThuoc();
        }
        ?>
            <!-- TABLE -->
            <table class="table table-hover table-bordered table-sm table-light text-center" id="tableNhaThuoc" data-page-length='30'>
                <thead>
                    <tr>
                        <th scope="col" colspan="8">BẢNG TÌM KIẾM</th>
                    </tr>
                    <tr class="bg-browns text-light">
                        <th scope="col">#</th>
                        <th scope="col">Tên nhà thuốc</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Ngày bắt đầu</th>
                        <th scope="col">
                            <span class="d-inline">Khu vực</span>
                            <span class="form-check d-inline ml-2">
                                <input 
                                    id="thaydoikhuvuc"
                                    class="form-check-input checkedngungban" type="checkbox" 
                                    onclick="thayDoiKhuVuc()"
                                    <?php if($checked == 'true') echo 'checked'; ?>
                                >
                            </span>
                        </th>
                        <th scope="col">Ngưng bán</th>
                        <th scope="col">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($thongtin as $tt) {
                ?>
                    <tr>
                        <th scope="row" class="font-weight-normal"><?php echo $stt++; ?></th>
                        <th scope="row" class="font-weight-normal"><b><?php echo $tt->tennhathuoc; ?><b></th>
                        <th scope="row" class="font-weight-normal text-danger"><?php echo $tt->diachi; ?></th>
                        <th scope="row" class="font-weight-normal"><?php echo $tt->sodienthoai; ?></th>
                        <th scope="row" class="font-weight-normal"><?php echo $tt->ngaybatdau; ?></th>
                        <th scope="row" class="font-weight-normal"> 
                        <b 
                        data-toggle="tooltip" data-placement="top" 
                        title="
                        <?php 
                            if($tt->khuvuc == "Khu vực 1") { echo 'Vị Thanh - Vị Thuỷ - Châu Thành A'; }
                            if($tt->khuvuc == "Khu vực 2") { echo 'Huyện Long Mỹ - Thị xã Long Mỹ'; }
                            if($tt->khuvuc == "Khu vực 3") { echo 'Phụng Hiệp - Ngã 7 - Châu Thành'; }
                        ?>" 
                        class="
                            <?php 
                                if($tt->khuvuc == "Khu vực 1") { echo 'text-danger'; }
                                if($tt->khuvuc == "Khu vực 2") { echo 'text-success'; }
                                if($tt->khuvuc == "Khu vực 3") { echo 'text-dark'; }
                            ?>"
                        >
                            <?php  
                                echo $tt->khuvuc; 
                                if($tt->khuvuc == "Khu vực 1") { echo ' <small> (Vị Thanh - Vị Thuỷ - Châu Thành A)</small>'; }
                                if($tt->khuvuc == "Khu vực 2") { echo ' <small> (Huyện Long Mỹ - Thị xã Long Mỹ)</small>'; }
                                if($tt->khuvuc == "Khu vực 3") { echo ' <small> (Phụng Hiệp - Ngã 7 - Châu Thành)</small>'; }
                            ?>
                        </b>
                        </th>
                        <th scope="row" class="font-weight-normal">
                            <div class="form-check">
                                <input 
                                    class="form-check-input checkedngungban" type="checkbox" 
                                    value="<?php echo $tt->ngungban?>"
                                    <?php if($tt->ngungban === 'ngungban') echo 'checked'?>
                                    onclick="thayDoiTrangThai(<?php echo $tt->manhathuoc;?>, event)"
                                >
                            </div>
                            <br>
                            <div>
                                <small><?php if($tt->ngungban === 'ngungban') echo "Ngày: " . $tt->ngayngungban; ?></small>
                            </div>
                        </th>
                        <th scope="row" class="font-weight-normal">
                            <button class="btn btn-danger rounded-pill" 
                                onclick="XoaNhaThuoc(<?php echo $tt->manhathuoc;?>, '<?php echo $tt->tennhathuoc;?>')" 
                                data-toggle="modal" data-target="#xoanhathuoc"
                            >Xóa</button>
                            <a href="index.php?page=suanhathuoc&id=<?php echo $tt->manhathuoc;?>" class="btn btn-warning rounded-pill">Sửa</a>
                        </th>
                    </tr>
                    <?php }?>
                </tbody>
            </table>    <!-- END TABLE -->
        <?php
    }
    else{  
        ?>
            <div class="alert alert-danger" role="alert">
                Lỗi... Không nhận được dữ liệu tìm kiếm...!
            </div>
        <?php
    }
?>

<script>
$(document).ready( function () {
    $('#tableNhaThuoc').DataTable({
        searching: false,
        ordering:  false,
        lengthChange: false
    });
    
});
  function thayDoiTrangThai(manhathuoc, e){
    var trangthaihientai = e.target.defaultValue
    if(manhathuoc != ''){
        $.ajax({
            url: "ns-tn-controller/nha-thuoc-controller.php?yeucau=suangungban&manhathuoc="+manhathuoc+"&trangthai="+trangthaihientai,
            method: "POST",
            data: manhathuoc,
            success: function(data){
                location.reload();
            }
        });
    }  
  }

  function thayDoiKhuVuc(){
       // Get the checkbox
        var checkBox = document.getElementById("thaydoikhuvuc");

        if (checkBox.checked == true){
            $("#bangloc").load("ns-tn-view/ns-tn-quan-li/ns-tn-nha-thuoc/boloc.php" , {checked: 'true'}); 
        } else {
            $("#bangloc").load("ns-tn-view/ns-tn-quan-li/ns-tn-nha-thuoc/boloc.php" , {checked: 'false'}); 
        }
  }
</script>

<style>
    .dataTables_wrapper{
        background: #fff;
    }
</style>