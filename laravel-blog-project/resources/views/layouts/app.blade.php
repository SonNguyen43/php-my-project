<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6299a8d4b4.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>
<body>
    <div>
        @include('include.navbar')
        @include('include.gotop')

        <main class="container bg-light pb-3 pt-3 shadow-sm">
            <div class="mt-5">
                @yield('breadcrumb')
                @include('include.message')
        
                @yield('content')
                @yield('modal')
            </div>
        </main>
    </div>
    
    
    <script src="https://kit.fontawesome.com/6299a8d4b4.js" crossorigin="anonymous"></script>
    <script>
        var prevScrollpos = window.pageYOffset;
            
        window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos) {
                document.getElementById("navbar").style.top = "0";
            } else {
                document.getElementById("navbar").style.top = "-60px";
            }
            prevScrollpos = currentScrollPos;
        }
    </script>
    
    @if(!Auth::guest())
        <script src="{{ asset('/ckfinder/ckfinder.js')}}"></script>
        <script src="{{ asset('/ckeditor/ckeditor.js')}}"></script>
        
        @if (Auth::user()->type == 'admin')
            <script>
                    CKEDITOR.replace( 'article-ckeditor', {
                        filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.php') }}',
                        filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.php?type=Images') }}',
                        filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.php?type=Flash') }}',
                        filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                        filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                        filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
                    });
            </script>
        @else
            <script src="/Blog/public/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('article-ckeditor');
            </script>
        @endif
    @endif
</body>
</html>
