@extends('layouts.app')

@section('content')
<div class="login">
    <div class="content rounded-0 border-0">
        <div class="row">
            <div class="col-md-6 left">
                <div class="img">
                    <img src="{{asset('storage/images/logo/joker.png')}}" alt="" width="350px" class="">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 right">
                <div style="padding: 15px;border-radius: 15px" class="shadow form-login">
                    <!-- FORM-->
                    <form method="POST" action="{{ route('login') }}" class="w-100">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <h3 class="text-center"><strong>Đăng Nhập</strong></h3>
                                <label for="">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="">Mật khẩu</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row" style="position: relative;z-index: 1">
                            <div class="col-md-12">
                                <div class="" title="form-check">
                                    <div class="custom-control custom-checkbox mr-sm-2 miss-me">
                                        <input type="checkbox" class="custom-control-input form-check-input" id="customControlAutosizing"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customControlAutosizing">Nhớ tôi</label>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="form-group row mb-0" style="position: relative;z-index: 1">
                            <div class="col-md-12">
                                <button class="btn btn-danger my-2 my-sm-0" type="submit" style="color: white; background: #f26522; font-weight: 500">Đăng nhập</button>
                                Bạn chưa có tài khoản ? <a class="text-decoration-none" href="{{ route('register') }}">{{ __('Đăng kí') }}</a>
                            </div>
                        </div>
                    </form> <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    VanillaTilt.init(document.querySelectorAll(".img"), {
        max: 25,
        speed: 400
    });
</script>

<style>
    body{
        background: #fff;
    }
    .login{
        width: 100%;
        height: 100vh;
        overflow: hidden;

        display: flex;
        justify-content: center;
        align-items: center;
    }
    .content{
        height: 80vh;
        width: 100%;
        /* background: linear-gradient(to bottom, #1e90ff,#03a9f4); */
        background: linear-gradient(to bottom, #dfe6e9,#b2bec3)
        /* background: url('storage/images/background/background.jpg'); */
    }
    .right, .left{
        height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
   
    .form-login{
        display: flex;
        justify-content: center;
        background: #fff;
        width: 65vh;
    }

    /* Ẩn hình ảnh */
    @media screen and (max-width: 768px) {
        .left {
            display: none;
        }
    }
</style>
@endsection
