
<style>
	input.kind_of_room{
		border: none;
		outline: none;
		width: 100%;
	}

	input.kind_of_room:focus{
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
				<h2 class="d-inline"><b>Quản lí danh mục loại phòng</b></h2>
			</div>

			<div class="col-12 col-sm-12 col-md-6 col-xl-6 col-lg-6">
				<form action="/haisan/public/home/phong/tim-kiem" method="POST" class="">
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
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create_category">
					<i class="fas fa-plus-circle"></i> Tạo mới loại phòng
				</button>

				@if (isset($search_key))
					<div class="alert alert-info mt-3" role="alert">
						{!!$search_key!!}
					</div>
				@endif

				@if (count($rooms) > 0)
					<table class="table table-bordered text-center mt-3">
						<thead class="bg-success text-light">
							<tr>
								<th scope="col" >Số thứ tự</th>
								<th scope="col">Tên loại phòng</th>
								<th scope="col" >Ngày tạo</th>
								<th scope="col" >Chức năng</th>
							</tr>
						</thead>
						<tbody>
							<?php $stt = 1; ?>
								@foreach ($rooms as $room)
									<tr>
										<td scope="row" >{{$stt++}}</td>
										<td scope="row" data-toggle="tooltip" data-placement="left" title="Ấn để chỉnh sửa">
											{!!Form::open(['action'=>['RoomsController@update', $room->id], 'method'=>'POST'])!!}
												{{Form::text('kind_of_room',$room->kind_of_room, ['class'=>'text-center kind_of_room'])}}
												{{Form::hidden('_method','PUT')}}
											{!!Form::close()!!}
										</td>
										<td scope="row" >{{date("d-m-Y", strtotime(substr($room->created_at,0, 10)))}}</td>
										<td scope="row" >
											{{-- @if ($room->updated_at != NULL)
												 {{date("d-m-Y", strtotime(substr($room->updated_at,0, 10)))}}
											@endif --}}

											{!! Form::open(['action' => ['RoomsController@destroy', $room->id], 'method' => 'POST']) !!}
												{{Form::hidden('_method','DELETE')}}
												<button type="submit" class="btn btn-outline-danger mt-1"><i class="far fa-trash-alt"></i> Xóa</button>
											{!! Form::close() !!} 
										</td>
									</tr>
								@endforeach
						</tbody>
					</table>
		
					<div class="mt-3 d-flex justify-content-end">
						{{ $rooms->links() }}
					</div>
				@endif
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="create_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tạo mới</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{!!Form::open(['action'=>'RoomsController@store', 'method'=>'POST'])!!}
					{{Form::label('Tên loại phòng:','Tên loại phòng:')}}
					{{Form::text('kind_of_room','', ['class'=>'form-control'])}}
				
			</div>
			<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success">Tạo</button>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
</div>