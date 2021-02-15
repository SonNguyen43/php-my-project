@extends('layouts.app_guest')

@section('content')
    <div class="container">
        <div class="text-center mt-5">
            <h2 style="font-family: 'Pacifico', cursive;">
               {{$food->name}}
            </h2>
        </div>
        <hr>
        <div>
            <div class="row">
                <div class="col-md-4"><img src="/storage/images/admin/food/{{$food->image}}" class="card-img-top shadow-sm" alt="..."></div>
                <div class="col-md-8" style="text-align: justify;">{!!$food->description!!}</div>
            </div>
        </div>
        <hr>
        <small class="d-flex justify-content-end" style="font-family: 'Pacifico', cursive;"><em> - Danh mục:  <a href="/danh-muc/{{$food->categories->id}}">{{$food->categories->name}}</a></em></small>
    </div>
@endsection