<?php
    require "./models/about.php";

    $about = new About();
    $info = $about->AboutInfo(1);
?>
<div class="bg-dark w-100 font-weight-bold"><marquee behavior="alternate" class="mt-2"><marquee width="300px" class="text-white"><i>Chúc quý khách một ngày tốt lành và có những phút giây thư giản nhất !</i></marquee></marquee></div>
<div class="bgimg-3">
    <div class="caption">
        <span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;">CHẤT LƯỢNG TỐT NHẤT</span>
    </div>
</div>
<div class="card-custom bg-dark p-3">
    <div class="row">
        <div class="col-md-4 text-center text-white">
           
            <div><span class="text"><i class="fas fa-phone"></i> Số điện thoại:</span> <i><?php echo $info->phone_number;?></i></div>
            <div><span class="text"><i class="fas fa-envelope-open-text"></i> Email: </span><i><?php echo $info->email;?></i></div>
            <div><span class="text"><i class="fas fa-code"></i> Mã doanh nghiệp:</span> <i><?php echo $info->business_code;?></i></div>
            <div><span class="text"><i class="fas fa-map-marker-alt"></i> Địa chỉ:</span> <i><?php echo $info->address;?></i></div>
            <div><span class="text"><i class="fas fa-keyboard"></i> Giấy phép kinh doanh:</span> <i><?php echo $info->business_license;?></i></div>
            
        </div>
        <div class="col-md-4 text-center text-white">
            <h4>Liên hệ với chúng tôi</h4>
            <a target="_blank" href="https://www.facebook.com/sonnguyen43/" class="text-white text-decoration-none"><span class="m-2"><i class="fab fa-facebook-square"></i> Facebook</span></a>
            <a target="_blank" href="https://www.instagram.com/nguoithichdua_/?hl=en" class="text-white text-decoration-none"><span class="m-2"><i class="fab fa-instagram"></i> Instagram</span></a>
            <a target="_blank" href="http://chat.zalo.me/" class="text-white text-decoration-none"><span class="m-2"><i class="fab fa-facebook-messenger"></i> Zalo</span></a>
        </div>
        <div class="col-md-4">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.218773761746!2d105.75755431488564!3d9.998779392852002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a089ce56d0e487%3A0xb826201e4a8e943e!2zxJDhuqFpIGjhu41jIFTDonkgxJDDtA!5e0!3m2!1sen!2s!4v1589965725655!5m2!1sen!2s" width="100%" height="165px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>
</div>

<style>
    span.text{
        font-weight: bold;
    }
</style>