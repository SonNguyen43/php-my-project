@extends('layouts.app')

@section('content')
    <style>
        @media only screen and (max-width: 1920px){
            .content{
               padding-left: 150px;
               padding-right: 150px;
           }
           p img{
               max-height: 500px;
           }
        }
        @media only screen and (max-width: 992px){
            .content{
               padding-left: 50px;
               padding-right: 50px;
           }
        }
        @media only screen and (max-width: 768px){
            p img{
               max-height: 450px;
           }
        }
        @media only screen and (max-width: 576px){
            p img{
                max-height: 300px;
            }
            .content{
                padding: 10px;
            }
        }
    </style>

    @if (!Auth::guest())
        @if (Auth::user()->type == 'admin')
            <a href="/posts/create" class="btn btn-success">Tạo bài viết mới</a>
        @endif
    @endif
        @if (count($posts) > 0)
            <div class="row pt-3">
                <div class="col-md-12">
                    @foreach ($posts as $post)
                        <div class="d-flex justify-content-center">
                            <div class="card-body mb-3 shadow-sm w-100 pt-3 pb-3">
                                <a href="/posts/{{$post->id}}" class="text-decoration-none text-dark text-center"><h2><strong>{{$post->title}}</strong></h2></a>
                                <p class="mt-5">
                                    <?php
                                        $id = $post->id;
                                        $str = substr($post->body,0 ,700);
                                        if(strlen($post->body) < 700){
                                            echo $str;
                                        }else{
                                            echo $str . '...' . '<em><a href="/posts/'.$id.'" class="text-decoration-none"><strong>Đọc tiếp</strong></a></em>';
                                        }
                                    ?>
                                </p>
                                <div>
                                    <small class="d-flex justify-content-end">Ngày tạo: {{$post->created_at}} <br> Tác giả: {{$post->user->name}}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-3">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        @else
             <div class="alert alert-warning rounded-pill mt-3 shadow-sm" role="alert">
                Chưa có bài viết nào được đăng !
            </div>
        @endif
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-pill"> 
            <li class="breadcrumb-item"><i class="fas fa-home"></i><a href="/" class="text-decoration-none "> Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-paste"></i> Bài đăng</li>
        </ol>
    </nav>
    <hr>
@endsection

