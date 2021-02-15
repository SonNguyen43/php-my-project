<style>
    .personal{
        outline: none;
        border: 0;
        background: transparent;
    }
    .personal:focus{
        border-bottom: 1px solid #000;
    }
</style>
@foreach ($comments as $comment)
     <div class="media mt-3 shadow-sm">
        @if ($comment->user->avatar == NULL || $comment->user->avatar == 'noAvatar.png')
            <img src="../storage/images/default/noAvatar.png" class="rounded-circle border shadow-sm" class="mr-3 rounded-lg" width="64px" height="64px">    
        @elseif ($comment->user->type == 'admin')
            <img src="../storage/images/admin/{{$comment->user->id}}/{{$comment->user->avatar}}" class="rounded-circle border shadow-sm mr-3 rounded-lg " alt="..." width="64px" height="64px">
        @else
            <img src="../storage/images/user/{{$comment->user->id}}/{{$comment->user->avatar}}" class="rounded-circle border shadow-sm mr-3 rounded-lg" alt="..." width="64px" height="64px">
        @endif

        <div class="media-body">
            <h5 class="mt-0"><b>{{$comment->user->name}}</b></h5>
            {!!Form::open(['action'=>['CommentsController@update', $comment->id] , 'method'=>'POST'])!!}
                @if (!Auth::guest())
                    @if (Auth::user()->id == $comment->user_id)
                        {{Form::text('comment', $comment->content, ['class'=> 'personal w-100'])}}
                    @else
                        {{Form::text('comment', $comment->content, ['class'=> 'personal w-100 border-0', 'readonly'])}}
                    @endif
                @else
                    {{Form::text('comment', $comment->content, ['class'=> 'personal w-100 border-0', 'readonly'])}}
                @endif
                {{Form::hidden('_method','PUT')}}
            {!!Form::close()!!}
        </div>
        <div>
            @if (!Auth::guest())
                @if (Auth::user()->id == $comment->user->id)
                    {!! Form::open(['action' => ['CommentsController@destroy', $comment->id], 'method' => 'POST','class' => 'pull-right']) !!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Xóa', ['class'=>'small btn text-danger'])}}
                    {!! Form::close() !!} 
                @endif
            @endif
        </div>
    </div> 
@endforeach  