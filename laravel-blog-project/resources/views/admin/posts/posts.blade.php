@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (!Auth::guest())
                @if (Auth::user()->type == 'admin')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="">
                                <a href="../home/" class="text-decoration-none">
                                    <div class="alert alert-primary shadow-sm" role="alert">
                                        Thông tin cá nhân
                                    </div>
                                </a>
                                <a href="../home/forum" class="text-decoration-none">
                                    <div class="alert alert-warning shadow-sm" role="alert">
                                        Diễn đàn
                                    </div>
                                </a>
                                 <a href="../home/posts" class="text-decoration-none">
                                    <div class="alert alert-success shadow-sm font-weight-bolder" role="alert">
                                        Bài đăng
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <a href="/posts/create" class="btn btn-success">Tạo bài viết mới</a>

                            @if (count($posts) > 0)
                                <table class="table table-hover mt-3">
                                    <thead class="table">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tên bài viết</th>
                                            <th scope="col">Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $stt = 1;    
                                    ?>
                                    @foreach ($posts as $post)
                                        <?php
                                            $str = substr($post->title,0 ,100);
                                            if(strlen($post->title) < 100){
                                                $title = $str;
                                            }else{
                                                $title = $str . "...";
                                            }
                                        ?>
                                        <tr>
                                            <td>{{$stt++}}</td>
                                            <td><a href="../posts/{{$post->id}}" class="text-dark text-decoration-none">{{$title}}</a></td>
                                            <td>
                                                <a href="../posts/{{$post->id}}/edit" class="btn btn-primary">Sửa</a>
                                                {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method'=>'POST', 'class' => 'd-inline'])!!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    {{Form::submit('Xóa', ['class'=>'btn btn-danger'])}}
                                                {!!Form::close()!!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-warning rounded-pill shadow-sm mt-3">
                                    Hiện không có bài viết nào !
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning rounded-pill shadow-sm">
                        Lỗi thao tác... bạn không thể truy cập vào đường dẫn này !
                    </div>
                @endif
            @else
                <div class="alert alert-warning rounded-pill shadow-sm">
                    Lỗi thao tác... bạn không thể truy cập vào đường dẫn này !
                </div>
            @endif
            <div class="mt-3 d-flex justify-content-end">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-pill"> 
            <li class="breadcrumb-item"><i class="fas fa-home"></i><a href="/Blog/public" class="text-decoration-none "> Trang chủ</a></li>
            
            @if (Auth::user()->type == 'admin')
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-paste"></i> Bài đăng</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">Không thể truy cập</li>
            @endif
        </ol>
    </nav>
    <hr>
@endsection

