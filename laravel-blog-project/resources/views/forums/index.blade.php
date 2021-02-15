@extends('layouts.app')

@section('content')
    <div class="content">
        @if (!Auth::guest())
            <a href="/forums/create" class="btn btn-success">Tạo bài viết mới</a>
        @endif
        @if (count($forums) > 0)
            @foreach ($forums as $forum)
                <div class="card mt-3 shadow-sm">
                    <a href="/forums/{{$forum->id}}" class="text-decoration-none text-dark">
                        <div class="row">
                            <div class="col-md-4 text-center">

                                @if ($forum->cover_image == NULL || $forum->cover_image == 'noImage.png')
                                    <img src="/storage/images/default/noImage.png" alt="" width="100%" style="height: 200px">
                                @else
                                    <img src="/storage/images/forum/{{$forum->user_id}}/cover_image/{{ $forum->cover_image }}" alt="" width="100%" style="height: 200px">
                                @endif
                                
                            </div>
                            <div class="col-md-8 p-3">
                                <h2><strong>{{ $forum->title }}</strong></h2> 
                                <span class="" style="bottom: 5px; left: 15px; position: absolute"><i class="far fa-comment-dots"></i>
                                    <span class="">{{count($forum->comments)}} </span>
                                </span>
                                <small class="" style="bottom: 5px; right: 30px; position: absolute">Ngày tạo: {{$forum->created_at}} <br> Người tạo: <span class="text-primary">{{$forum->user->name}}</span></small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

            <div class="mt-3">
                {{ $forums->links() }}
            </div>
            
        @else
            <div class="alert alert-warning mt-3" role="alert">
                Chưa có bài viết nào được đăng !
            </div>
        @endif
    </div>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-pill"> 
            <li class="breadcrumb-item"><i class="fas fa-home"></i><a href="/" class="text-decoration-none "> Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-comments"></i> Diễn đàn</li>
        </ol>
    </nav>
    <hr>
@endsection
