@extends('layouts.app')

@section('content')
    {!!Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data' ])!!}
    <div class="row d-flex">

        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class=" rounded-pill shadow-sm pt-3 pb-3">
                <div class="rounded-pill text-center">
                    <h3><strong>SỬA BÀI VIẾT</strong></h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        {{Form::label('Tiêu đề: ')}} ( <span class="text-danger">*</span> )
                        {{Form::text('title', $post->title, ['class' => 'form-control rounded-pill'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('Nội dung: ')}} ( <span class="text-danger">*</span> )
                        {{Form::textarea('body', $post->body, ['id'=>'article-ckeditor', 'class'=>'form-control'])}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="d-flex justify-content-center">
                            {{Form::reset('Reset', ['class'=>'btn btn-danger m-3'])}}
                            <a href="../{{$post->id}}" class="btn btn-warning m-3">Trở về</a>
                        </div>
                    </div>  <!-- END COL -->
    
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="d-flex justify-content-center">
                            {{Form::hidden('_method','PUT')}}
                            {{Form::submit('Thay đổi',['class'=>'btn btn-success m-3'])}}
                        </div>
                    </div>  <!-- END COL -->
                </div>
            </div>
        </div>
    </div>  <!-- END ROW -->
    {!!Form::close()!!}
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-pill"> 
            <li class="breadcrumb-item"><i class="fas fa-home"></i><a href="/" class="text-decoration-none "> Trang chủ</a></li>
            <li class="breadcrumb-item"><i class="fas fa-paste"></i> <a href="/posts" class="text-decoration-none ">Bài đăng</a></li>
            <li class="breadcrumb-item"><i class="fas fa-edit"></i> 
            <a href="/posts/{{$post->id}}" class="text-decoration-none ">
                <?php
                    $str = substr($post->title,0 ,150);
                    if(strlen($post->title) < 150){
                        echo $str;
                    }else{
                        echo $str . "...";
                    }
                ?>
            </a>
        </li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-paragraph"></i>Sửa bài viết</li>
        </ol>
    </nav>
    <hr>
@endsection