{{-- lỗi hệ thống --}}
@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-warning mb-0 shadow-sm mt-3 mb-3">
            @switch($error)
                @case('These credentials do not match our records.')
                    <b>Sai</b> tên tài khoản hoặc mật khẩu. Vui lòng kiểm tra lại !
                    @break
                @case('The password field is required.')
                    <b>Mật khẩu</b> không được bỏ trống !
                    @break
                @case('The passwordconfirm field is required.')
                    Xác nhận <b>mật khẩu mới</b> không được bỏ trống !
                    @break
                @case('The name field is required.')
                @case('The kind of room field is required.')
                    Tên không được bỏ trống !
                    @break
                @case('The description field is required.')
                    Mô tả không được bỏ trống !
                    @break
                @case('The image field is required.')
                    Hãy chọn một bức ảnh !
                    @break
                @default
                    {{$error}}
                    @break
            @endswitch
        </div>
    @endforeach
@endif

{{-- lỗi trả về từ controller --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm mt-3" role="alert">
    {!!session('success')!!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm mt-3" role="alert">
     {!!session('error')!!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif