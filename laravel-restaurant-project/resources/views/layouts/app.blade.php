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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- JS -->
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

</head>
<body>
    <div id="">
        {{-- @if (!Auth::guest())
            @include('include.navbar')
        @endif --}}

        <main>
            @yield('menu')
            @yield('content')
            @yield('modal')
        </main>

        @include('include.gotop')
    </div>

    <script src="{{ asset('/ckfinder/ckfinder.js')}}"></script>
    <script src="{{ asset('/ckeditor/ckeditor.js')}}"></script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    
        CKEDITOR.replace( 'article-ckeditor', /*{
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.php') }}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.php?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.php?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        }*/);
    </script>
    
    
</body>
</html>
