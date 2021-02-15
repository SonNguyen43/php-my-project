@extends('layouts.app_guest')

@section('content')
    <div class="container">
        <div class="text-center mt-5">
            <h2 style="font-family: 'Pacifico', cursive;">
                Tất Cả Món Ăn
            </h2>
            <hr>
        </div>
        <div>
            <div class="row">
                @if (count($foods) > 0)
                    @foreach ($foods as $food)
                        <div class="col-md-4 d-flex justify-content-center mt-3">
                            <div class="card shadow-sm mb-3" style="font-family: 'Pacifico', cursive;">
                                <img src="/storage/images/admin/food/{{$food->image}}" class="card-img-top" alt="..." height="200px">
                                <div class="card-body">
                                    <h4 class="card-title">{{$food->name}}</h4>
                                    <div>
                                        <small class="d-inline"><em>Danh mục: <a class="text-decoration-none" href="/danh-muc/{{$food->categories->id}}">{{$food->categories->name}}</a></em></small>
                                    </div>
                                    <div>
                                        <a href="danh-muc/mon-an/{{$food->id}}" class="btn btn-primary mt-3">Chi Tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <hr>
      
    </div>
@endsection