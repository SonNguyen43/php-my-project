@extends('layouts.app')

@section('content')
    <?php
        if($forum->images != NULL){
            $images = $forum->images;
            # chuyen JSON thanh mang
            $arrayImages = (json_decode($images, true));
        }
    ?>
    <style>
        @media only screen and (max-width: 1920px){
            .card-body{
                padding-left: 100px;
                padding-right: 100px;
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
            .card-body{
                padding-left: 10px;
                padding-right: 10px;
           }
        }
    </style>
    <div class="row d-flex">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class=" rounded-pill shadow-sm p-3">
                <div class="rounded-pill text-center">
                    <h2><strong>{{$forum->title}}</strong></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <small>Ngày tạo: {{$forum->created_at}}</small>
                            <br>
                            <small>Người tạo: {{$forum->user->name}}</small>
                        </div>
                        <div class="col-md-6">
                            {{$forum->user->user_id}}
                            @if (!Auth::guest())
                                @if (Auth::user()->id == $forum->user->id || Auth::user()->type == 'admin')
                                    <div class="d-flex justify-content-end">
                                        <a href="../forums/{{$forum->id}}/edit" class="btn btn-primary d-inline">Sửa</a>
                                
                                        {!!Form::open(['action' => ['ForumsController@destroy', $forum->id], 'method'=>'POST', 'class' => 'd-inline ml-3'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Xóa', ['class'=>'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </div>
                                @endif
                            @endif
                        </div>
                   

                        <div class="col-md-12">
                            <div class="mt-3 text-center">
                                @if ($forum->cover_image == NULL || $forum->cover_image == 'noImage.png')
                                    <img src="../storage/images/default/noImage.png" alt="" class="img-thumbnail shadow-sm" style="max-width: 100%">
                                @else
                                    <img src="../storage/images/forum/{{$forum->user_id}}/cover_image/{{ $forum->cover_image }}" alt="" class="shadow-sm" style="max-width: 100%">
                                @endif
                                
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="jumbotron mt-3">
                                {!!$forum->body!!}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mt-3">
                                <h4><strong>Ảnh mô tả:</strong></h4>
                                <div class="text-center">
                                    @if ($arrayImages != NULL)
                                        @foreach ($arrayImages as $image)
                                            <a href="../storage/images/forum/{{$forum->user_id}}/images/{{ $image }}", data-toggle='tooltip', data-placement='top', title='click', target="_blank">
                                                <img src="../storage/images/forum/{{$forum->user_id}}/images/{{ $image }}" alt="" class="mt-3" style="max-width: 250px">
                                            </a>
                                        @endforeach
                                    @else
                                        (Không có ảnh mô tả cho bài viết này)
                                    @endif
                                
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mt-3">
                                <h4><strong>Bình luận:</strong></h4>
                                {!!Form::open(['action'=>'CommentsController@store', 'method'=>'POST'])!!}
                                    {{Form::text('forum_id',$forum->id,['class'=>'form-control d-none' , 'readonly'])}}
                                    {{Form::textarea('comment','',['class'=>'form-control'])}}
                                    {{Form::submit('Bình luận',['class'=>'btn btn-success mt-3'])}}
                                {!!Form::close()!!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mt-3">
                                @if (count($comments) > 0)
                                    <div class="mt-3">    
                                        @include('comments.show')

                                        <div class="d-flex justify-content-end mt-3">
                                            {{$comments->links()}}
                                        </div>
                                    </div>  
                                @else
                                    <div class="alert alert-primary mt-3" role="alert">
                                    Chưa có bình luận cho bài viết này
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  <!-- END ROW -->
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-pill"> 
            <li class="breadcrumb-item"><i class="fas fa-home"></i><a href="/Blog/public" class="text-decoration-none "> Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-comments"></i> <a href="/Blog/public/forums" class="text-decoration-none ">Diễn đàn</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> 
                <?php
                    $str = substr($forum->title,0 ,150);
                    if(strlen($forum->title) < 150){
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
