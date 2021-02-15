<?php
     require "ns-tn-model/cthh-don-hang-class.php";

     $thongke = new cthhdhclass();
     $soluong = $thongke->ThongkeDonHang();
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
    <div class="text-center">
        <h3><strong><b>Thống Kê Xuất Kho</b></strong></h3>
    </div>
</div>  <!-- END TITLE -->

<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-start mt-3">
    <a class="btn btn-outline-brown dangxuat rounded-pill ml-3" href="index.php?page=quanlixuatkho">Trở Về</a>
</div>

<div class="col-md-12 d-flex justify-content-center">
    <div id="chart_div" class="mt-3"></div>
</div>

      
<script>
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawMultSeries);

    function drawMultSeries() {
        var data = google.visualization.arrayToDataTable([
            ['Element', 'Số lượng', { role: 'style' }],
            <?php
                $stt = 1;
                
                foreach ($soluong as $sl) {
                    if ($stt == 1) $color = '#b87333';
                    else if ($stt == 2) $color = '#2d98da';
                    else if ($stt == 3) $color = '#3d3d3d';
                    else if ($stt == 4) $color = '#20bf6b';
                    else if ($stt == 5) $color = '#fa8231';
                    else if ($stt == 6) $color = '#a5b1c2';
                    else if ($stt == 7) $color = '#7158e2';
                    else if ($stt == 8) $color = '#273c75';
                    else if ($stt == 9) $color = '#dcdde1';
                    else if ($stt == 10) $color = '#44bd32';
                    else $color = '#c23616';
                    
                    ?>
                      ['<?php echo $sl->tenhanghoa;?>', <?php echo $sl->tongsoluong;?>, '<?php echo $color;?>'],
                    <?php
                    $stt++;
                }
            ?>
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

        var options = {
            title: "N'Store by Thanh Nhi",
            hAxis: {
                title: 'BIỂU ĐỒ THỐNG KÊ TỔNG CÁC SẢN PHẨM ĐÃ XUẤT KHO',
                format: 'h:mm a',
            },
            vAxis: {
                title: 'Số lượng'
            },

            width: 1390,
            height: 500,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
            isStacked: true,
        };

        var chart = new google.visualization.ColumnChart(
            document.getElementById('chart_div'));

        chart.draw(view, options);
        }
</script>