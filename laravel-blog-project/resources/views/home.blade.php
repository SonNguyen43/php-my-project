@extends('layouts.app')

@section('content')
    <style>
        .personal{
            border:0px;
            text-align: center;
        }

        .personal:focus{
            width: 50%;
            font-size: 20px;
            color: #000;
            border: none;
            border-bottom: 1px solid #000;
            outline: none;
            background: transparent;
        }
        .inputBox{
            position: relative;
            display: flex;
            justify-content: center;
        }
        .inputBox input{
            width: 100%;
            padding: 10px 0;
            font-size: 20px;
            border-top: none;
            border-left: none;
            border-right: none;
            outline: none;
            background: transparent;
            margin-bottom: 15px

        }
        .inputBox label{
            position: absolute;
            top: -10px;
            left: 0px;
            padding: 20px 10px;
            font-size: 16px;
            color: rgb(0, 0, 0);
            pointer-events: none;
            transition: .5s;
            opacity: 0.5;
        }

        .inputBox input:focus ~label{
            top: -30px;
            left: 0;
            font-size: 14px;
            opacity: 1;
        }
        /* .inputBox input:valid ~label{
            top: -30px;
            left: 0;
            font-size: 14px;
            opacity: 1;
        } */

        .changeimage{
            display: none;
            width: 200px;
            height: 100px;
            line-height: 100px;
            font-size: 20px;
            background: #000;
            border-radius: 0 0 200px 200px;

            position: absolute;
            margin-top: -100px;
            z-index: 10;
        }
        .avatar:hover ~ .changeimage{
           display: block;
        }
        .changeimage:hover{
           display: block;
        }

        @media only screen and (max-width: 768px){
            .personal{
                border:0px;
                text-align: end;
            }
        }
    </style>

    <script>
         $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>

    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if (!Auth::guest())
                <div class="row">
                    <div class="col-md-4">
                        <a href="/home" class="text-decoration-none">
                            <div class="alert alert-primary shadow-sm font-weight-bolder" role="alert">
                                Thông tin cá nhân
                            </div>
                        </a>
                        <a href="/home/forum" class="text-decoration-none">
                            <div class="alert alert-warning shadow-sm" role="alert">
                                Diễn đàn
                            </div>
                        </a>
                        @if (Auth::user()->type == 'admin')
                            <a href="/home/posts" class="text-decoration-none">
                                <div class="alert alert-success shadow-sm" role="alert">
                                    Bài đăng
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="col-md-8">
                        @if (Auth::user()->type == 'admin' || Auth::user()->type = 'user')
                            <div class="card shadow-sm p-3">
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <div class="rounded-circle position-relative" style="width: 200px">
                                            @if ($user->avatar == NULL || $user->avatar == 'noAvatar.png')
                                                <img src="/storage/images/default/noAvatar.png" class="rounded-circle border shadow-sm avatar" style="width: 200px; height: 200px">
                                            @else
                                                <img src="/storage/images/{{$user->type}}/{{$user->id}}/{{$user->avatar}}" alt="JKAGDIAGS" class="rounded-circle border shadow-sm avatar" style="width: 200px; height: 200px">
                                            @endif
                                            <div class="text-center text-light border changeimage"  data-toggle="modal" data-target="#changeImage">
                                                 <i class="fas fa-camera" aria-hidden="false"></i>
                                                Đổi ảnh
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-md-12">
                                        {!!Form::open(['action'=>['HomeController@updateinfo'] , 'method'=>'POST'])!!}
                                            <div class="row">
                                                <div class="col-12 col-sm-6 col-md-6 d-flex justify-content-center">
                                                    {{Form::text('id', $user->id, ['class'=> 'personal border-top-0 border-left-0 border-right-0 w-100 text-center d-none', 'style'=>'font-size:20px;'])}}
                                                    {{Form::text('name', $user->name, ['class'=> 'personal border-top-0 border-left-0 border-right-0 w-100 text-center', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Ấn để thay đổi', 'style'=>'font-size:20px;'])}}
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 d-flex justify-content-center">
                                                    {{Form::text('email', $user->email, ['class'=> 'personal border-top-0 border-left-0 border-right-0 w-100 text-center', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Không thể thay đổi tên tài khoản của bạn', 'style'=>'font-size:20px;', 'readonly'])}}
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-12 d-flex justify-content-start mt-3">
                                                    <div class="custom-control custom-checkbox" id="change-password">
                                                        <input type="checkbox" name="check" class="custom-control-input" id="check">
                                                        <label class="custom-control-label" for="check">Thay đổi mật khẩu</label>
                                                        <div class="invalid-feedback">Example invalid feedback text</div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div id="password-check" class="mt-3">
                                                <div class="row d-flex justify-content-center">
                                                    <div class="form-group col-md-12">
                                                        <div class="inputBox">
                                                            <input type="password" name="password" id="" class="w-100 personal border-bottom border-top-0 border-left-0 border-right-0" style="font-size:15px;">
                                                            <label for="">Mật khẩu cũ:</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <div class="inputBox ">
                                                            {{Form::text('newpassword', '', ['class'=> 'w-100 personal border-bottom border-top-0 border-left-0 border-right-0', 'style'=>'font-size:15px;'])}}
                                                            <label for="">Mật khẩu mới:</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <div class="inputBox">
                                                            <input type="password" name="passwordconfirm" id="" class="w-100 personal border-bottom border-top-0 border-left-0 border-right-0" style="font-size:15px;">
                                                            <label for="">Xác nhận:</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <div class="d-flex justify-content-center">
                                                    {{Form::submit('Thay đổi',['class'=>'btn btn-success m-3'])}}
                                                </div>
                                            </div>  <!-- END COL -->
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.getElementById('change-password').addEventListener('change', ()=>{
            var check = document.getElementById('check');
            if(check.checked){
                document.getElementById('password-check').style.display = 'block';
            }else{
                document.getElementById('password-check').style.display = 'none';
            }
        });
      
    </script>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-pill"> 
            <li class="breadcrumb-item"><i class="fas fa-home"></i><a href="/Blog/public" class="text-decoration-none "> Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user"></i> Trang cá nhân</li>
        </ol>
    </nav>
    <hr>
@endsection

@section('modal')
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
                        {{Form::text('id', $user->id, ['class'=> 'personal border-top-0 border-left-0 border-right-0 w-100 text-center d-none', 'style'=>'font-size:20px;'])}}
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
                        {{Form::submit('Thay đổi',['class'=>'btn btn-success'])}}
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
@endsection