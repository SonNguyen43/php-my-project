<style>
	input.name{
		border: none;
		outline: none;
		width: 100%;
	}

	input.name:focus{
		border-bottom: 1px solid #38c172;
	}

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
				<h2 class="d-inline"><b>Danh Sách Đã Đặt Phòng</b></h2>
			</div>

			<div class="col-12 col-sm-12 col-md-6 col-xl-6 col-lg-6">
				<form action="/home/danh-sach-phong-da-dat/tim-kiem" method="POST" class="form-inline my-2 my-lg-0 w-100">
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
				@if (isset($search_key))
					<div class="alert alert-info mt-3" role="alert">
						{!!$search_key!!}
					</div>
				@endif

				@if (count($bookeds) > 0)
					<div class="table-responsive">
						<table class="table table-bordered text-center mt-5">
							<thead class="bg-success text-light">
								<tr>
									<th scope="col" >Số thứ tự</th>
									<th scope="col">Tên</th>
									<th scope="col" >Số điện thoại</th>
									<th scope="col" >Thời gian</th>
									<th scope="col" >Số người</th>
									<th scope="col" >Loại phòng</th>
									<th scope="col" >Chức năng</th>
								</tr>
							</thead>	
							<tbody class="table-sm">
								<?php $stt = 1; ?>
									@foreach ($bookeds as $booked)
										@if ($booked->status == "approved")
											<tr>
												<td scope="row" style="line-height: 70px">{{$stt++}}</td>
												<td scope="row" style="line-height: 70px" data-toggle="tooltip" data-placement="left" title="Ấn để chỉnh sửa">
													{!!Form::open(['action'=>['BookRoomsController@update', $booked->id], 'method'=>'POST'])!!}
														{{Form::text('name',$booked->name, ['class'=>'text-center name', 'required'])}}
														{{Form::hidden('_method','PUT')}}
													{!!Form::close()!!}
												</td>
												
												<td scope="row" style="line-height: 70px">
													{!!Form::open(['action'=>['BookRoomsController@update', $booked->id], 'method'=>'POST'])!!}
														{{Form::text('phone_number',$booked->phone_number, ['class'=>'text-center name', 'required'])}}
														{{Form::hidden('_method','PUT')}}
													{!!Form::close()!!}
												</td>
												<td scope="row" style="line-height: 70px">
													{!!Form::open(['action'=>['BookRoomsController@update', $booked->id], 'method'=>'POST'])!!}
														{{Form::text('time',$booked->time, ['class'=>'text-center name', 'required'])}}
														{{Form::hidden('_method','PUT')}}
													{!!Form::close()!!}
												</td>
												<td scope="row" style="line-height: 70px">
													{!!Form::open(['action'=>['BookRoomsController@update', $booked->id], 'method'=>'POST'])!!}
														{{Form::text('people_number',$booked->people_number, ['class'=>'text-center name', 'required'])}}
														{{Form::hidden('_method','PUT')}}
													{!!Form::close()!!}
												</td>
												<td scope="row" style="line-height: 70px">
													{!!Form::open(['action'=>['BookRoomsController@update', $booked->id], 'method'=>'POST'])!!}
														{{Form::text('kind_of_room',$booked->kind_of_room	, ['class'=>'text-center name', 'required'])}}
														{{Form::hidden('_method','PUT')}}
													{!!Form::close()!!}
												</td>
												<td scope="row" style="line-height: 70px">
													{!! Form::open(['action' => ['BookRoomsController@destroy', $booked->id], 'method' => 'POST']) !!}
														{{Form::hidden('_method','DELETE')}}
														<button type="submit" class="btn btn-outline-danger mt-1"><i class="far fa-trash-alt"></i> Xóa</button>
													{!! Form::close() !!} 
												</td>
											</tr>
										@endif
									@endforeach
							</tbody>
						</table>
					</div>
		
					<div class="mt-3 d-flex justify-content-end">
						{{ $bookeds->links() }}
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
