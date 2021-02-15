<!-- TIN TỨC -->
<div class="p-3 container w-100">
    <div class="row">
        <div class="col-md-8 mt-2">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                    $dot = 0;
                    foreach ($all_news as $news) {
                        ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $dot; ?>" class="<?php if($dot==0) echo 'active'?>"></li>
                        <?php
                        $dot++;
                    }
                ?>
            </ol>
            <div class="carousel-inner">
                <?php
                    $stt = 1;
                    foreach ($all_news as $news) {
                        ?>
                        <div class="carousel-item <?php if($stt == 1) echo 'active'?>">
                            <a href="?su_kien=<?php echo $news->id;?>"><img src="./views/quanli/admin/news/images/<?php echo $news ->images; ?>" class="d-block w-100" alt="..."></a>
                        </div>
                        <?php
                        $stt++;
                    }
                ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12"><img src="./public/images/news/news_1.jpg" class="w-100 mt-2"></div>
                <div class="col-md-12"><img src="./public/images/news/news_2.jpg" class="w-100 mt-2"></div>
            </div>
        </div>
    </div>
</div>

<!-- DANH MỤC -->
<div>
    <?php
        require "./views/quanli/user/category/category.php";
    ?>
</div>