<?php
    require "./models/news.php";

    $news = new News();
    $all_news = $news->AllNews();
?>

<style>
    body, html {
        height: 100%;
        margin: 0;
        color: #777;
    }

    .bgimg-1, .bgimg-2, .bgimg-3 {
        position: relative;
        opacity: 0.65;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .bgimg-1 {
        background-image: url("./public/images/parallax/img1.jpg");
        min-height: 430px;
    }

    .bgimg-2 {
        background-image: url("./public/images/parallax/img2.jpg");
        min-height: 430px;
    }

    .bgimg-3 {
        background-image: url("./public/images/parallax/img3.jpg");
        min-height: 400px;
    }

    .caption {
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        text-align: center;
        color: #000;
    }

    .caption span.border {
        padding: 18px;
        font-size: 25px;
        letter-spacing: 10px;
        font-weight: 700;
    }

    .card-custom{
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0.25rem;
    }

    /* Turn off parallax scrolling for tablets and phones */
    /* @media only screen and (max-device-width: 1024px) {
        .bgimg-1, .bgimg-2, .bgimg-3 {
            background-attachment: scroll;
        }
    } */
</style>

<div style="<?php if(isset($_GET['tu_khoa'])) echo 'margin-top: 20px'; else echo 'margin-top: 100px';?>">
    <?php
        if(isset($_GET['tu_khoa'])){
            require "views/quanli/user/index/footer.php";
        }else{
            require "views/quanli/user/index/header.php";
            require "views/quanli/user/index/body.php";
            require "views/quanli/user/index/footer.php";

        }
    ?>
  
</div>


<script src="https://unpkg.com/scrollreveal"></script>
<script src="./public/js/scrollanimation.js"></script>