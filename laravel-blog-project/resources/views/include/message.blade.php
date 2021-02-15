{{-- lỗi hệ thống --}}
@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-warning mb-0 rounded-pill shadow-sm mb-3 ">
            @switch($error)
                @case('The title field is required.')
                    Không được bỏ trống tiêu đề ! 
                    @break
                @case('The body field is required.')
                    Không được bỏ trống nội dung !
                    @break
                @case('These credentials do not match our records.')
                    Sai tên tài khoản hoặc mật khẩu. Vui lòng kiểm tra lại !
                    @break
                @case('The images field is required.')
                    Hãy thêm ảnh cho bài viết. Tối thiểu 1 ảnh !
                    @break
                @case('The password must be at least 8 characters.')
                    Mật khẩu phải ít nhất 8 kí tự !
                    @break
                @case('The password confirmation does not match.')
                    Xác nhận mật khẩu không khớp nhau !
                    @break
                @case('The name field is required.')
                    Không được để trống tên của bạn !
                    @break
                @case('The password field is required.')
                    Mật khẩu cũ không được bỏ trống !
                    @break
                @case('The newpassword field is required.')
                    Mật khẩu mới không được bỏ trống !
                    @break
                @case('The passwordconfirm field is required.')
                    Xác nhận mật khẩu mới không được bỏ trống !
                    @break
                @case('The avatar field is required.')
                @case('The avatar must be an image.')
                    Hãy chọn 1 ảnh !
                    @break
                @case('The comment field is required.')
                    Hãy nhập nội dung trước khi gửi bình luận
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
    <div class="alert alert-success alert-dismissible fade show rounded-pill shadow-sm mb-3" role="alert">
    {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-pill shadow-sm mb-3" role="alert">
     {{session('error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif