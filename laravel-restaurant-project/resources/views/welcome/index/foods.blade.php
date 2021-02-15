
<style>
    .food{
        margin-top: 50px;
    }
    @media only screen and (max-width: 768px){
        .food{
            margin-top: 100px;
        }
    }
</style>
<div style="position:relative;" class="food">
    <div class="col-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mr-0">
        <div style="color:#777;" class="bg-white text-justify text-center">
            <h2 style="font-family: 'Pacifico', cursive;">Những Món Ăn Đặc Sắc Nhất</h2>
            <hr>
        </div>
        @if (count($foods) > 0)
            <div class="row">
                {{-- @foreach ($foods as $food)
                    <div class="col-12 col-sm-12 col-md-4 d-flex justify-content-center mt-3" style="font-family: 'Pacifico', cursive;">
                        <div class="card shadow-sm" style="width: 18rem;">
                            <img src="/storage/images/admin/food/{{$food->image}}" class="card-img-top" alt="..." height="200px">
                            <div class="card-body">
                                <h5 class="card-title">{{$food->name}}</h5>
                                <div>
                                    <small class="d-inline"><em>Danh mục: <a class="text-decoration-none" href="/danh-muc/{{$food->categories->id}}">{{$food->categories->name}}</a></em></small>
                                </div>
                                <div>
                                    <a href="danh-muc/mon-an/{{$food->id}}" class="btn btn-primary mt-3">Chi Tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
                @foreach ($foods as $food)
                <div class="col-md-4">
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
            </div>
        @else
            <div class="alert alert-warning">Chưa Có Món Ăn Nổi Bật Nào</div>
        @endif
        
    </div>
</div>