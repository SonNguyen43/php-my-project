<style>
    .changeimage{
        display: none;
        width: 150px;
        height: 75px;
        line-height: 75px;
        font-size: 16px;
        background: #000;
        border-radius: 0 0 150px 150px;

        position: absolute;
        margin-top: -75px;
        z-index: 10;
    }
    .avatar:hover ~ .changeimage{
        display: block;
    }
    .changeimage:hover{
        display: block;
    }
</style>

<div class="sidebar" id="sidebar">
    <ul>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="rounded-circle position-relative" style="width: 150px">
                   
                    @if (Auth::user()->avatar == NULL || Auth::user()->avatar == 'noAvatar.png')
                        <img src="/storage/images/default/noAvatar.png" class="rounded-circle border shadow-sm avatar" style="width: 150px; height: 150px">
                    @else
                        <img src="/storage/images/admin/{{Auth::user()->avatar}}" class="rounded-circle border shadow-sm avatar" style="width: 150px; height: 150px">
                    @endif
                    
                    
                    <div class="text-center text-light border changeimage"  data-toggle="modal" data-target="#changeImage">
                        <i class="fas fa-camera" aria-hidden="false"></i>
                        Đổi ảnh
                    </div>
    
                    <div class="text-center text-light">
                        <b>{{Auth::user()->name}}</b> (admin)
                    </div>
                </div>
            </div>
        </div>
       
        <a href="/home/danh-muc" class="text-decoration-none text-light"><li><i class="fas fa-list-alt mr-2"></i>Danh mục</li></a>
        <a href="/home/mon-an" class="text-decoration-none text-light"><li><i class="fas fa-hamburger mr-2"></i>Món ăn</li></a>
        <a href="/home/phong" class="text-decoration-none text-light"><li><i class="fas fa-chair mr-2"></i>Phòng</li></a>
        <a href="/home/hinh-anh" class="text-decoration-none text-light"><li><i class="fas fa-images"></i>  Ảnh nổi bật</li></a>
        <a href="/home/danh-sach-phong-da-dat" class="text-decoration-none text-light"><li><i class="fas fa-address-card mr-2"></i>DS phòng đã đặt</li></a>
    </ul> 
</div>

<!-- Modal Change Avatar Image-->
<div class="modal fade" id="changeImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            {!!Form::open(['action'=>['HomeController@updateavatar'] , 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>   
                    Chọn ảnh
                    <br>
                    {{Form::text('id', Auth::user()->id, ['class'=> 'personal border-top-0 border-left-0 border-right-0 w-100 text-center d-none', 'style'=>'font-size:20px;'])}}
                    <div class="custom-file mt-3 mb-3">
                        {{Form::file('avatar', ['accept'=>'image/*','class'=>'custom-file-input', 'id'=>'chon_anh'])}}
                        <label class="custom-file-label" for="chon_anh">Chọn file ảnh...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                    Xem trước
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-center">
                                <img id="anh_goc" src="" alt="Chưa có ảnh được chọn" style="width: 200px; height: 200px; border-radius: 200px" class="shadow-sm border">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success">Thay đổi</button>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>

<script>
    /* Show ảnh khi đã chọn */
    let chon_anh = document.getElementById("chon_anh");
    let img_input = document.getElementById("anh_goc");

    chon_anh.addEventListener('change', (e) =>{
        img_input.src = URL.createObjectURL(e.target.files[0]); 
    });
</script>