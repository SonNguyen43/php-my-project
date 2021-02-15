<div class="row mt-5 mr-0 pl-5 pr-5 text-white bg-secondary" style="font-family: 'Lobster', cursive; font-size: 16px;">
    <marquee behavior="alternate"><marquee width="300" scrollamount="5" style=" letter-spacing: 5px;">Hải Sản Biển Xanh Hân Hạnh Phục Vụ Quý Khách - Chúc Quý Khách Một Ngày Tốt Lành</marquee></marquee>
</div>

<div class="bgimg-3">
    <div class="caption">
    <span class="borderr" style="background-color:transparent;font-size:25px;color: #f7f7f7;font-weight: bold">Ngon Quên Đường Về</span>
    </div>
</div>


<div style="position:relative;" class="bg-secondary">
    <div style="color:#777;" class="text-justify text-light">
        <div class="row mr-0">
            <div class="col-md-4 mt-5">
                <h2 style="font-family: 'Pacifico', cursive;" class="text-light text-center">Liên hệ</h2>
                <div class="text-center">
                    <i class="fas fa-map-marker-alt"></i> Trần Vĩnh Kiết - Ninh Kiều - Cần Thơ
                </div>
                <div class="text-center">
                    <i class="fas fa-clock"></i> Giờ mở cửa: 8h sáng - 22h tối
                </div>
                <div class="text-center">
                    <i class="fas fa-phone"></i> 0766-899-363
                </div>
                
            </div>
            <div class="col-md-4 mt-5 text-center">
                <h2 style="font-family: 'Pacifico', cursive;" class="text-light">Fanpage</h2>
                <span class="mr-3"><i class="fab fa-facebook"></i> Facebook</span>
                <span class="mr-3"><i class="fab fa-google-plus"></i> Email</span>
                <span class="mr-3"><i class="fab fa-instagram"></i> Instagram</span>
            </div>
            <div class="col-md-4 mt-5">
                <h2 style="font-family: 'Pacifico', cursive;" class="text-light text-center">Phản hồi đóng góp</h2>
                {!!Form::open(['action'=>'FeedbacksController@feedback', 'method'=>'GET', 'enctype' => 'multipart/form-data'])!!}
                    <div class="row">
                        <div class="col">{{Form::text('name','', ['class'=>'form-control w-100 ml-2', 'placeholder' => 'Tên của bạn' , 'required'])}}</div>
                        <div class="col">{{Form::number('phone_number','', ['class'=>'form-control w-100 ml-2', 'placeholder' => 'Số điện thoại', 'required'])}}</div>
                    </div>
                   
                    {{Form::textarea('content','', ['class'=>'form-control w-100 ml-2 mt-3', 'rows' => '2', 'required'])}}
                    {{Form::submit('Gửi đi', ['class'=>'btn btn-success mt-3 ml-2'])}}
                {!!Form::close()!!}
                
            </div>
        </div>
    </div>
    <hr class="bg-light">
     <div class="text-light text-right"><i class="far fa-copyright"></i> 2019 Nhà Hàng Hải Sản Biển Xanh Phú Quốc, All Rights Reserved</div>
</div>
