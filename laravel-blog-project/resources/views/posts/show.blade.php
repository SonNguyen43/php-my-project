@extends('layouts.app')

@section('content')

    <style> 
        @media only screen and (max-width: 1920px){
           .content{
                padding-right: 150px; 
                padding-left:150px
           }
           p img{
               padding: 0;
           }
        }
        @media only screen and (max-width: 1200px){
           .content{
                padding-right: 50px; 
                padding-left:50px
           }
           p img{
                padding: 0;
           }
        }
        @media only screen and (max-width: 768px){
            p img{
               max-height: 450px;
           }
        }
        @media only screen and (max-width: 576px){
            .content{
                padding-right: 0; 
                padding-left:0
           }
           p img{
               max-height: 250px;
           }
        }
    </style>

    <?php
        if($post->images != NULL){
            $images = $post->images;
            # chuyen JSON thanh mang
            $arrayImages = (json_decode($images, true));
        }
    ?>
    <div class="row content" style="">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 text-center">
                    <h2 class=""><strong> {{$post->title}}</strong></h2>
                </div>
           
                <div class="col-12 col-sm-12 col-md-12 text-center mb-3">
                    <small class="">Đã tạo: {{$post->created_at}}</small>
                </div>
                <div class="col-12 col-sm-12 col-md-12 text-center">
                    @if (!Auth::guest())
                        @if (Auth::user()->id == $post->user_id || Auth::user()->type == "admin")
                            <a href="../posts/{{$post->id}}/edit" class="btn btn-primary">Sửa</a>
                            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method'=>'POST', 'class' => 'd-inline'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Xóa', ['class'=>'btn btn-danger'])}}
                            {!!Form::close()!!}
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-12 images-body">
            {!! $post->body !!}
        </div>

        <div class="col-12 col-sm-12 col-md-12 d-flex justify-content-end mt-3">
            <p class="text-muted">
                <em>- Tác giả: </em><b>{{ $post->user->name }}</b>
            </p>
        </div>
    </div>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-pill"> 
            <li class="breadcrumb-item"><i class="fas fa-home"></i><a href="/" class="text-decoration-none "> Trang chủ</a></li>
            <li class="breadcrumb-item"><i class="fas fa-paste"></i> <a href="/posts" class="text-decoration-none ">Bài đăng</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> 
                <?php
                    $str = substr($post->title,0 ,150);
                    if(strlen($post->title) < 150){
                        echo $str;
                    }else{
                        echo $str . "...";
                    }
                ?>
            </li>
        </ol>
    </nav>
    <hr>
@endsection

