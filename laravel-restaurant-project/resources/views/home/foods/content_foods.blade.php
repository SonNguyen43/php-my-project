<style>
    .search-box {
		position: absolute;
		top: 90%;
		left: 90%;
		transform: translate(-90%, -90%);
		background: #2f3640;
		height: 50px;
		border-radius: 40px;
		padding-top: 5px;
		margin-top: 15px;
	}

	.search-box:hover > .search-txt {
		width: 300px;
		padding: 0 6px;
	}

	.search-box:hover > .search-btn {
		background: white;
		color: black;
		margin-top: -15px;
	}

	.search-btn {
		color: #e84118;
		float: right;
		width: 50px;
		height: 50px;
		border-radius: 50%;
		background: #2f3640;
		display: flex;
		justify-content: center;
		align-items: center;
		transition: 0.8s;
		color: white;
		cursor: pointer;
		margin-top: -5px;
	}

	.search-btn > i {
		font-size: 30px;
	}

	.search-txt {
		border: none;
		background: none;
		outline: none;
		float: left;
		padding: 0;
		color: white;
		font-size: 16px;
		transition: 0.4s;
		line-height: 40px;
		width: 0px;
		font-weight: bold;
	}
</style>

<div class="card shadow-sm mt-3 mb-3">
    <div class="info">
        
        <div class="row m-0">
            <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-lg-6">	
                <h2 class="d-inline"><b>Quản lí món ăn</b></h2>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-lg-6">
                <form action="/home/mon-an/tim-kiem" method="POST" class="form-inline my-2 my-lg-0 w-100">
                    {{ csrf_field() }}
                    <div class="search-box">
						<input type="text" name="q" class="search-txt" placeholder="Nhập từ khóa cần tìm..."/>
						<a class="search-btn" href="#">
						<i class="fas fa-search"></i>
						</a>
					</div>
                </form>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
                <a href="../home/mon-an/create" class="btn btn-success">
                    <i class="fas fa-plus-circle"></i> Tạo mới món ăn
                </a>

                @if (isset($search_key))
					
					<div class="alert alert-info mt-3" role="alert">
						{!!$search_key!!}
					</div>
				@endif

                @if (count($foods) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered text-center mt-3">
                            <thead class="bg-success text-light">
                                <tr>
                                    <th scope="col" >Số thứ tự</th>
                                    <th scope="col">Tên món ăn</th>
                                    <th scope="col" >Mô tả</th>
                                    <th scope="col" >Nổi bật</th>
                                    <th scope="col" >Ảnh</th>
                                    <th scope="col" >Chức năng</th>
                                </tr>
                            </thead>
                            <tbody class="table-sm">
                                <?php $stt = 1; ?>
                                    @foreach ($foods as $food)
                                        <tr>
                                            <td scope="row" style="padding-top: 35px">{{$stt++}}</td>
                                            <td scope="row" style="padding-top: 35px">
                                                {{$food->name}}
                                            </td>
                                            <td scope="row" style="padding-top: 35px">
                                                <?php
                                                    $str = substr($food->description,0 ,100);
                                                    if(strlen($food->description) < 100){
                                                        echo $str;
                                                    }else{
                                                        echo $str . '...';
                                                    }
                                                ?>
                                            </td>
                                            <td class="position-relative">
                                                @if ($food->highlights == "true")
                                                    <div class="spinner-grow text-success position-absolute mt-4" style="margin-left: -15px" role="status">
                                                        <span class="sr-only">Phải...</span>
                                                    </div>
                                                @else    
                                                @endif
                                            </td>
                                            <td scope="row" >
                                                <img src="/storage/images/admin/food/{{ $food->image }}" alt="" width="100px" height="70">
                                            </td>
                                            <td>
                                                <a href="/home/mon-an/{{ $food->id }}/edit/" class="btn btn-primary"><i class="far fa-edit"></i>Sửa</a>

                                                {!! Form::open(['action' => ['FoodsController@destroy', $food->id], 'method' => 'POST']) !!}
                                                    {{Form::hidden('_method','DELETE')}}
                                                    <button type="submit" class="btn btn-outline-danger mt-1"><i class="far fa-trash-alt"></i>Xóa</button>
                                                {!! Form::close() !!} 
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
        
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $foods->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
