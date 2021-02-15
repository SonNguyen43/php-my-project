<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>

<?php
    require "ns-tn-model/nha-thuoc-class.php";

    # tìm thấy tài khoản admin đăng nhập
    if(isset($_SESSION['admin'])){
        ?>
            <!-- TITLE -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                <div class="text-center">
                    <h4><strong><b>Quản Lí Nhà Thuốc</b></strong></h4>
                </div>
            </div>  <!-- END TITLE -->

            <div class="">
                <div class="row">
                    <!-- MENU -->
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-start mt-3">  
                        <a class="btn btn-outline-brown rounded-pill ml-3" href="index.php">Trở Về</a>
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-end mt-3">
                        <a href="index.php?page=taomoinhathuoc" class="btn btn-success rounded-pill mr-4">Tạo mới</a>
                        <div class="tooltips mr-4" style="margin-top:3px;">
                            <img src="ns-tn-public/ns-tn-images/default/pie-chart.png"  data-toggle="modal" data-target="#staticBackdrop" class="logo rotate"  width="32px" height="32px">
                            <span class="tooltiptexts shadow">
                                <div id="piechart" class="shadow"></div>
                            </span>
                        </div>
                        <button class=" btn btn-secondary text-light rounded-pill mr-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Tìm nhà thuốc
                        </button>
                    </div> 
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Biểu đồ thống kê</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <div id="piechart2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Đóng</button>
                    </div>
                    </div>
                </div>
            </div>


            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                <!-- TIM KIEM -->
                <div class="collapse card bg-custom" id="collapseExample">
                    <div class="card-header bg-browns text-light" style="border-radius: 30px 30px 0 0">
                        <h6><strong><b>Tìm kiếm</b></strong></h6>
                    </div>
                    <div class="card-body">
                        <form action="">
                            <!-- TÌM NHỮNG THÔNG TIN CƠ BẢN -->
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <label for=""><b>Nhập tên nhà thuốc: </b></label>
                                    <input type="text" id="tennhathuoc" onkeyup="TimNhaThuoc()" class="form-control rounded-pill">
                                </div>    
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <label for=""><b>Nhập số điện thoại: </b></label>
                                    <input type="number" id="sodienthoainhathuoc" onkeyup="TimNhaThuoc()" class="form-control rounded-pill">
                                </div>  
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="reset" class="btn btn-success mr-3 mt-3 rounded-pill">Làm trống</button>
                                    <button type="button" class="btn btn-primary mt-3 rounded-pill" onclick="TimNhaThuoc()">Tìm</button>
                                </div>
                            </div> 
                        </form>  
                    </div>
                </div>  <!-- END TIM KIEM -->
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                <!-- TABLE -->
                <div class="table-responsive-lg mb-3" id="bangloc">
                    <!-- TABLE -->
                    <table class="table table-hover table-bordered table-sm table-light text-center mb-3" id="tableNhaThuoc" data-page-length='30'>
                        <thead>
                            <tr>
                                <th scope="col" colspan="8">TẤT CẢ ĐƠN HÀNG</th>
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
                            $thongtin = $nhathuoc->TatCaNhaThuoc();
                        
                            foreach ($thongtin as $tt) {
                        ?>
                            <tr>
                                <th scope="row" class="font-weight-normal"><?php echo $stt++; ?></th>
                                <th scope="row" class="font-weight-normal"><b><?php echo $tt->tennhathuoc; ?><b></th>
                                <th scope="row" class="font-weight-normal text-danger"><?php echo $tt->diachi; ?></th>
                                <th scope="row" class="font-weight-normal"><?php echo $tt->sodienthoai; ?></th>
                                <th scope="row" class="font-weight-normal"><?php echo $tt->ngaybatdau; ?></th>
                                <th scope="row" class="font-weight-normal"> 
                                    <b data-toggle="tooltip" data-placement="top" 
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
                                    <a href="index.php?page=suanhathuoc&id=<?php echo $tt->manhathuoc?>" class="btn btn-warning rounded-pill">Sửa</a>
                                </th>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>    <!-- END TABLE -->
                </div>
            </div>
        <?php
    }else{
            # Không tìm thấy tài khoản admin đăng nhập
        ?>
            <div class="alert alert-danger" role="alert">
                Lỗi... Không tìm thấy thông tin tài khoản admin...!
            </div>
        <?php
    }
    

    require "ns-tn-view/ns-tn-quan-li/ns-tn-nha-thuoc/modal/modal-xoa-nha-thuoc.php";
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

    function XoaNhaThuoc(id, ten) {
        document.getElementById('manhathuoc').value = id;
        document.getElementById('tennhathuocxoa').innerHTML = ten;
    }
</script>

<style>
    .dataTables_wrapper{
        background: #fff;
    }
    .tooltips {
        position: relative;
        display: inline-block;
    }

    .tooltips .tooltiptexts {
        position:absolute;
       
        visibility: hidden;
        background-color: #fff;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        top: 50px;
        right: -200px;
        margin-left: -60px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .tooltips:hover .tooltiptexts {
        visibility: visible;
        opacity: 1;
    }
</style>

<?php
    $nhathuoc = new nhathuocclass();
    $conban = $nhathuoc->NhaThuocConBan();
    $nghiban = $nhathuoc->NhaThuocNghiBan();
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Còn bán', <?php echo $conban;?>],
  ['Ngừng bán', <?php echo $nghiban;?>],
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Trạng thái hoạt động của các nhà thuốc'};
  var options2 = {
    'title':'Trạng thái hoạt động của các nhà thuốc',
    'width': 750,
    'height':350, 
    'is3D': true,
};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);

  var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
  chart2.draw(data, options2);
}
</script>