<?php
    require './models/news_info.php';

    $news_info = new NewsInfo();
    
    if (isset($_GET['su_kien'])) {
         $id = $_GET['su_kien'];

         $count = $news_info->CheckCountNewsInfo($id);
         $details = $news_info->News_Info($id);
         # kiểm tra sự kiện có tồn tại không
         if($count > 0){
            ?>
                <div class="container" style="margin-top: 120px">
                    <div class="card shadow-bulma">
                        <div class="card-body">
                            <h3 class="d-inline"><i class="fas fa-calendar-alt"></i> Sự kiện hay</h3>
                            <span class="float-right d-inline"><i class="fas fa-clock"></i> <?php $date = getdate(); echo $date['mday']."-".$date['mon']."-".$date['year'];?></span>
                        </div>
                    </div>
                    <div class="card text-center shadow-bulma mt-3 mb-3">
                        <div class="card-body mb-3">
                            <?php echo $details->content; ?>
                        </div>
                    </div>
                </div>
            <?php
         }else{
            ?>
                <div class="alert alert-danger container" style="margin-top: 120px">Không tìm thấy nội dung</div>
            <?php
         }
    }else{
        ?>
            <div class="alert alert-danger container" style="margin-top: 120px">Không tìm thấy nội dung</div>
        <?php
    }
?>

<style>
    div.card-body img{
        width: 100%;
    }
</style>
