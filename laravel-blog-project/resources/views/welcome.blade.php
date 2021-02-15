@extends('layouts.app')

@section('content')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
    <div class="row">
        <div class="col-md-6">
            @if (count($posts)> 0)
                <?php $i = 0; ?>
                @foreach ($posts as $post)
                    @if ($i == 1)
                        @break;
                    @endif
                    <div class="shadow-sm p-3">
                        <div class="card-header" style="height: 350px; overflow: hidden">
                            <?php
                                $id = $post->id;
                                $str = substr($post->body,0 ,350);
                                if(strlen($post->body) < 350){
                                    echo $str;
                                }else{
                                    echo $str . '...' . '<em><a href="/posts/'.$id.'" class="text-decoration-none"><strong>Đọc tiếp</strong></a></em>';
                                }
                            ?>
                        </div>
                        <div class="card-body">
                            <a href="/posts/{{$post->id}}" class="text-decoration-none text-dark" data-toggle='tooltip' data-placement='top' title='{{$post->title}}'>
                                <h2><strong>
                                    <?php
                                        $str = substr( $post->title,0 ,35);
                                        if(strlen( $post->title) < 35){
                                            echo $str;
                                        }else{
                                            echo $str . '...';
                                        }
                                    ?>
                                </strong></h2>
                            </a>
                            <small class="">Ngày tạo: {{$post->created_at}} <br> Người tạo: {{$post->user->name}}</small>
                        </div>
                    </div>
                    <?php $i++; ?>
                @endforeach
            @endif
        </div>
        <div class="col-md-6">
            @if (count($forums)> 0)
                <?php $i = 0; ?>
                @foreach ($forums as $forum)
                    @if ($i == 1)
                        @break;
                    @endif
                    <div class="shadow-sm p-3">
                        <div class="">
                            <div class="card-header p-0">
                                @if ($forum->cover_image == NULL || $forum->cover_image == 'noImage.png')
                                    <img src="/storage/images/default/noImage.png" alt="" width="100%" style="height: 350px">
                                @else
                                    <img src="/storage/images/forum/{{$forum->user_id}}/cover_image/{{ $forum->cover_image }}" alt="" style="height: 350px" width="100%">
                                @endif
                            </div>
                            <div class="card-body">
                                <a href="/forums/{{$forum->id}}" class="text-decoration-none text-dark mt-0" data-toggle="tooltip" data-placement="top" title="{{$forum->title}}">
                                    <h2><strong>
                                        <?php
                                            $str = substr( $forum->title,0 ,35);
                                            if(strlen( $forum->title) < 35){
                                                echo $str;
                                            }else{
                                                echo $str . '...';
                                            }
                                        ?>
                                   </strong></h2>
                                </a>
                                <small class="">Ngày tạo: {{$forum->created_at}} <br> Người tạo: {{$forum->user->name}}</small>
                            </div>
                        </div>
                    </div>
                    <?php $i++; ?>
                @endforeach
            @endif
        </div>

        <div class="col-md-12 mt-3">
            <div class="p-3">
                <div class="row">
                    <div class="col"><h3 class=""><strong>Bài đăng</strong></h3></div>
                    <div class="col d-flex justify-content-end"><a href="/posts">Xem thêm</a></div>
                </div>
                <?php $j = 0; ?>
                <div class="row">
                    @foreach ($posts as $post)
                    @if ($j == 3)
                        @break;
                    @endif
                        <div class="col-md-4 mt-3">
                            <div class="shadow-sm">
                                <div class="card-header p-0" style="height: 250px; overflow: hidden">
                                    <?php
                                        $id = $post->id;
                                        $str = substr($post->body,0 ,350);
                                        if(strlen($post->body) < 350){
                                            echo $str;
                                        }else{
                                            echo $str . '...' . '<em><a href="/posts/'.$id.'" class="text-decoration-none"><strong>Đọc tiếp</strong></a></em>';
                                        }
                                    ?>
                                </div>
                                
                                 <div class="mt-3">
                                    <div class="card-body">
                                        <a href="/posts/{{$post->id}}" class="text-decoration-none text-dark" data-toggle="tooltip" data-placement="top" title="{{$post->title}}">
                                            <h5 class="pb-3"><strong>
                                            <?php
                                                $str = substr( $post->title,0 ,40);
                                                if(strlen( $post->title) < 40){
                                                    echo $str;
                                                }else{
                                                    echo $str . '...';
                                                }
                                            ?>
                                        </strong></h5></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php $j++; ?>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <div class="p-3">
                <div class="row">
                    <div class="col"> <h3 class=""><strong>Diễn đàn</strong></h3></div>
                    <div class="col d-flex justify-content-end"><a href="/forums">Xem thêm</a></div>
                </div>
                <?php $j = 0; ?>
                <div class="row">
                    @foreach ($forums as $forum)
                        @if ($j == 3)
                            @break;
                        @endif
                        <div class="col-md-4 mt-3">
                            <div class="shadow-sm">
                                <div class="">
                                    <div class="card-header p-0">
                                        @if ($forum->cover_image == NULL || $forum->cover_image == 'noImage.png')
                                            <img src="/storage/images/default/noImage.png" alt="" width="100%" class="img-thumbnail" style="height: 250px">
                                        @else
                                            <img src="/storage/images/forum/{{$forum->user_id}}/cover_image/{{ $forum->cover_image }}" alt="" style="height: 250px" width="100%">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <a href="/forums/{{$forum->id}}" class="text-decoration-none text-dark" data-toggle="tooltip" data-placement="top" title="{{$forum->title}}">
                                            <h5><strong>
                                                <?php
                                                    $str = substr( $forum->title,0 ,55);
                                                    if(strlen( $forum->title) < 55){
                                                        echo $str;
                                                    }else{
                                                        echo $str . '...';
                                                    }
                                                ?>
                                            </strong></h5>
                                        </a>
                                        <small class="">Ngày tạo: {{$forum->created_at}} <br> Người tạo: {{$forum->user->name}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection