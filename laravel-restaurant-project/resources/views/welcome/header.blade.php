<style>
    body{
        background: #fff;
    }
    .bgimg-1, .bgimg-2, .bgimg-3 {
        position: relative;
        opacity: 0.65;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .bgimg-2 {
        background-image: url("/storage/images/background/img_01.jpg");
        min-height: 400px;
    }
    
    .bgimg-3 {
        background-image: url("/storage/images/background/img_02.jpeg");
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
    
    .caption span.borderr {
        background-color: #111;
        color: #fff;
        padding: 18px;
        font-size: 25px;
        letter-spacing: 5px;

        background-color:transparent;
        font-size:25px;
        color: #f7f7f7; 
        font-weight: bold;
        border: 3px solid #f7f7f7;
    }
    
    h2 {
        letter-spacing: 5px;
        text-transform: uppercase;
        font: 20px "Lato", sans-serif;
        color: #111;
    }
    
    /* Turn off parallax scrolling for tablets and phones */
    @media only screen and (max-device-width: 1024px) {
      .bgimg-1, .bgimg-2, .bgimg-3 {
        background-attachment: scroll;
      }
    }
</style>

<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">


<div class="bg-white text-center" style="margin-top: 60px">
    <b style="font-family: 'Pacifico', cursive;color: #777; font-size:45px">Hải Sản Biển Xanh Phú Quốc</b>
</div>

@include('include.message')

<div class="container text-justify mt-4" style="color: #777;">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-5 col-xl-5 col-lg-5 text-center">
            <img src="/storage/images/welcome/welcome3.jpg" alt="" width="100%" height="250px" class="" style="border-radius: 5px; opacity: 1">
        </div>
        <div class="col-12 col-sm-12 col-md-7 col-xl-7 col-lg-7">
                <h1 style="font-family: 'Pacifico', cursive">Welcome !</h1>
            <p>
                Nhà hàng góp phần tăng thêm hương vị tuyệt vời cho những món ăn 
                bằng những loại thức uống hấp dẫn như bia mát lạnh và những loại rượu vang ngon nức tiếng từ Úc & Nam Mỹ.
            </p>
            <p>Đến nhà hàng <b>Hải Sản Biển Xanh Phú Quốc</b>, thực khách sẽ nhớ mãi hương vị khó quên của món sườn khổng lồ nướng mềm phết sốt BBQ kiểu Mỹ.
                 Món ăn này được mọi lứa tuổi đặc biệt yêu thích. 
                 Ngoài ra, nhà hàng còn mang đến thực đơn phong phú và hợp lý về giá cả, 
                 không những phù hợp cho khách nước ngoài mà còn được các bạn trẻ Việt Nam vô cùng hâm mộ và ủng hộ nhiệt tình.
            </p>
        </div>
    </div>
</div>

<div class="row mt-5 mr-0 pl-5 pr-5 text-white bg-secondary" style="font-family: 'Lobster', cursive; font-size: 16px;">
    <div class="col-md-4 text-center">
        <i class="fas fa-clock"></i> Từ 8h sáng - Đến 22h tối
    </div>
    <div class="col-md-4 text-center">
        <i class="fas fa-phone"></i> 0766-899-363
    </div>
    <div class="col-md-4 text-center">
        <i class="fas fa-map-marker-alt"></i> Trần Vĩnh Kiết - Ninh Kiều - Cần Thơ
    </div>
</div>

<div class="bgimg-2">
    <div class="caption">
        <span class="borderr" style="">THƠM NỨC MŨI</span>
    </div>
</div>

