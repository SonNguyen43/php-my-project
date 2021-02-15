@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if (!Auth::guest())
                <div class="row">
                    <div class="col-md-4">
                        <a href="../home/" class="text-decoration-none">
                            <div class="alert alert-primary shadow-sm" role="alert">
                                Thông tin cá nhân
                            </div>
                        </a>
                        <a href="../home/forum" class="text-decoration-none">
                            <div class="alert alert-warning shadow-sm font-weight-bolder" role="alert">
                                Diễn đàn
                            </div>
                        </a>
                        @if (Auth::user()->type == 'admin')
                            <a href="../home/posts" class="text-decoration-none">
                                <div class="alert alert-success shadow-sm" role="alert">
                                    Bài đăng
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="col-md-8">
                        @if (Auth::user()->type == 'admin')
                            @if (count($forums) > 0)
                                @foreach ($forums as $forum)
                                    <div class="card mt-3 shadow-sm">
                                        <a href="../forums/{{$forum->id}}" class="text-decoration-none text-dark">
                                            <div class="row">
                                                <div class="col-md-4 text-center">
                                                    @if ($forum->cover_image == NULL || $forum->cover_image == 'noImage.png')
                                                        <img src="../storage/images/default/noImage.png" alt="" width="100%" class="img-thumbnail" style="height: 200px">
                                                    @else
                                                        <img src="../storage/images/forum/{{$forum->user_id}}/cover_image/{{ $forum->cover_image }}" alt="" width="100%" class="img-thumbnail" style="height: 200px">
                                                    @endif
                                                    
                                                </div>
                                                <div class="col-md-8">
                                                    <h2>{{ $forum->title }}</h2>
                                                    <small class="">Ngày tạo: {{$forum->created_at}} <br> Người tạo: {{$forum->user->name}}</small>
                                                    {!!Form::open(['action' => ['ForumsController@update', $forum->id], 'method' => 'forum', 'enctype' => 'multipart/form-data', 'style'=>'bottom: 0px; right: 10px; position: absolute' ])!!}
                                                        {{Form::hidden('_method','PUT')}}
                                                        {{Form::submit('Duyệt',['class'=>'btn btn-success m-3'])}}
                                                    {!!Form::close()!!}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                        
                                <div class="mt-3">
                                    {{ $forums->links() }}
                                </div>
                                
                            @else
                                <div class="alert alert-success mt-3" role="alert">
                                    Chưa có yêu cầu đăng bài !
                                </div>
                            @endif
                        @else
                                <h3><strong>Bài viết của bạn</strong></h3>
                            @if (count($forums) > 0)
                                <table class="table table-hover mt-3">
                                    <thead class="table">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tiêu đề</th>
                                            <th scope="col">Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $stt = 1;    
                                    ?>
                                    @foreach ($forums as $forum)
                                        <?php
                                            $str = substr($forum->title,0 ,100);
                                            if(strlen($forum->title) < 100){
                                                $title = $str;
                                            }else{
                                                $title = $str . "...";
                                            }
                                        ?>
                                        <tr>
                                            <td>{{$stt++}}</td>
                                            <td><a href="../forums/{{$forum->id}}" class="text-dark text-decoration-none">{{$title}}</a></td>
                                            <td>
                                                <a href="../forums/{{$forum->id}}/edit" class="btn btn-primary">Sửa</a>
                                                {!!Form::open(['action' => ['ForumsController@destroy', $forum->id], 'method'=>'forum', 'class' => 'd-inline'])!!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    {{Form::submit('Xóa', ['class'=>'btn btn-danger'])}}
                                                {!!Form::close()!!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-success rounded-pill shadow-sm">
                                    Bạn chưa có bài viết được đăng !
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-pill"> 
            <li class="breadcrumb-item"><i class="fas fa-home"></i><a href="/Blog/public" class="text-decoration-none "> Trang chủ</a></li>

            @if (Auth::user()->type == 'admin')
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-comments"></i> Diễn đàn</li>
            @else
                <li class="breadcrumb-item active" aria-current="page"> Diễn đàn</li>
            @endif
        </ol>
    </nav>
    <hr>
@endsection