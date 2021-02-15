<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/home">
            {{ config('app.name', 'Hải Sản Biển Xanh Phú Quốc') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item border-right">
                    <a class="nav-link" href="/">Trang chủ</a>
                </li>
                <li class="nav-item border-right">
                    <a class="nav-link" href="/home/danh-sach-dat-phong">Danh sách đặt phòng</a>
                </li>
                <li class="nav-item border-right">
                    <a class="nav-link" href="/home/phan-hoi-tu-khach-hang">Phản hồi từ khách hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="closemenu" href="#">Đóng/Mở menu</a>
                    <a class="nav-link" id="openmenu" style="display: none;" href="#">Đóng/Mở menu</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li> 
                        <a class="btn btn-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Đăng xuất') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<script>
    document.getElementById("closemenu").addEventListener('click', ()=>{
        document.getElementById("sidebar").style.display = "none";
        // document.getElementById("sidebar").style.transition = "1s";
        document.getElementById("main_content").style.marginLeft = "0";
        // document.getElementById("main_content").style.transition = "1s";

        document.getElementById('openmenu').style.display = "block";
        document.getElementById('closemenu').style.display = "none";
    });

    document.getElementById("openmenu").addEventListener('click', ()=>{
        document.getElementById("sidebar").style.display = "block";
        // document.getElementById("sidebar").style.transition = "1s";
        document.getElementById("main_content").style.marginLeft = "200px";
        // document.getElementById("main_content").style.transition = "1s";

        document.getElementById('openmenu').style.display = "none";
        document.getElementById('closemenu').style.display = "block";
    });
</script>