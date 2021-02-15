@extends('layouts.app')

@section('content')
<div class="register">
    <div class="card rounded-0 border-0">
        <div class="row">
            <div class="col-md-6 left">
                <div class="img">
                    <img src="{{asset('storage/images/logo/joker.png')}}" alt="" width="350px" class="">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 right">
                <div style="padding: 15px;border-radius: 15px" class="shadow form-register">
                    <form method="POST" action="{{ route('register') }}" class="w-100">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <h3 class="text-center"><strong>Đăng Kí</strong></h3>
                                <label for="">Họ tên: </label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="">Email: </label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="">Mật khẩu: </label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="">Nhập lại: </label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row" style="position: relative;z-index: 1">
                            <div class="col-md-12">
                                <button class="btn btn-danger my-2 my-sm-0" type="submit" style="color: white; background: #f26522; font-weight: 500">Đăng kí</button>
                                Đã có tài khoản, <a class="text-decoration-none" href="{{ route('login') }}">{{ __('Về Đăng nhập !') }}</a>
                            </div>
                        </div>
                    </form>
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
    .register{
        width: 100%;
        height: 100vh;
        overflow: hidden;

        display: flex;
        justify-content: center;
        align-items: center;
    }
    .card{
        height: 80vh;
        width: 100%;
        background: linear-gradient(to bottom, #dfe6e9,#b2bec3)

    }
    .right, .left{
        height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .shop{
        line-height: 350px;
        font-size: 85px;
        color: white;
        font-family: 'Dancing Script', cursive;
        text-shadow: 3px 4px 5px rgba(0,0,0,.7);
        margin-left: 60px;
    }

    .form-register{
        display: flex;
        justify-content: center;
        background: #fff;
        width: 65vh;
    }

    @media screen and (max-width: 768px) {
        .left {
            display: none;
        }
    }
</style>
@endsection

