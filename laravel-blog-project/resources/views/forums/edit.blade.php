@extends('layouts.app')

@section('content')
    {!!Form::open(['action' => ['ForumsController@update',$forum->id], 'method' => 'POST', 'enctype' => 'multipart/form-data' ])!!}
        <div class="row d-flex">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class=" rounded-pill shadow-sm pt-3 pb-3">
                    <div class="rounded-pill text-center">
                        <h3><strong>SỬA BÀI VIẾT</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            {{Form::label('Tiêu Đề: ')}} ( <span class="text-danger">*</span> )
                            {{Form::text('title', $forum->title, ['class' => 'form-control rounded-pill'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('Ảnh Bìa: ')}}
                            <div class="custom-file">
                                {{Form::file('cover_image', ['accept'=>'image/*','class'=>'custom-file-input', 'id'=>'validatedCustomFile'])}}
                                <label class="custom-file-label rounded-pill-top-l-bottom-l" for="validatedCustomFile">Chọn file ảnh...</label>
                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('Ảnh Mô Tả (tối đa 3 ảnh): ')}}
                            <div class="custom-file">
                                {{Form::file('images[]', ['multiple', 'accept'=>'image/*','class'=>'custom-file-input', 'id'=>'validatedCustomFile'])}}
                                <label class="custom-file-label rounded-pill-top-l-bottom-l" for="validatedCustomFile">Chọn file ảnh...</label>
                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('Nội dung: ')}} ( <span class="text-danger">*</span> )
                            {{Form::textarea('body', $forum->body, ['id'=>'article-ckeditor','class'=>'form-control', 'rows'=>'15'])}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="d-flex justify-content-center pb-3">
                                    {{Form::reset('Reset', ['class'=>'btn btn-danger mr-3'])}}
                                    <a href="../{{$forum->id}}" class="btn btn-warning">Trở về</a>
                                </div>
                            </div>  <!-- END COL -->
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="d-flex justify-content-center pb-3">
                                {{Form::hidden('_method','PUT')}}
                                {{Form::submit('Thay đổi',['class'=>'btn btn-success'])}}
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
                <li class="breadcrumb-item"><i class="fas fa-comments"></i> <a href="/forums" class="text-decoration-none ">Diễn đàn</a></li>
            <li class="breadcrumb-item"><i class="fas fa-edit"></i> 
            <a href="/forums/{{$forum->id}}" class="text-decoration-none ">
                <?php
                    $str = substr($forum->title,0 ,150);
                    if(strlen($forum->title) < 150){
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