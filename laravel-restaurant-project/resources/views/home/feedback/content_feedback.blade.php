
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
				<h2 class="d-inline"><b>Phản hổi từ khách hàng</b></h2>
			</div>

			<div class="col-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
				@if (isset($search_key))
					<div class="alert alert-info mt-3" role="alert">
						{!!$search_key!!}
					</div>
				@endif

				@if (count($feedbacks) > 0)
					<div class="table-responsive">
						<table class="table table-bordered text-center mt-3">
							<thead class="bg-success text-light">
								<tr>
									<th scope="col">Số thứ tự</th>
									<th scope="col">Tên</th>
									<th scope="col">Số điện thoại</th>
									<th scope="col">Nội dung</th>
									<th scope="col">Ngày tạo</th>
								</tr>
							</thead>
							<tbody>
								<?php $stt = 1; ?>
									@foreach ($feedbacks as $feedback)
										<tr>
											<td scope="row" >{{$stt++}}</td>
											<td scope="row">
												{{$feedback->name}}
											</td>
											<td scope="row">
												{{$feedback->phone_number}}
											</td>
											<td scope="row">
												{{$feedback->content}}
											</td>
											<td scope="row">
												{{-- {{date("d-m-Y", strtotime(substr($feedback->created_at,0, 10)))}} --}}

											{!!Form::open(['action'=>'FeedbacksController@destroy', 'method'=>'GET', 'enctype' => 'multipart/form-data'])!!}
												{{Form::hidden('_method','DELETE')}}
												<input type="text" name="id" value="{{$feedback->id}}" class="d-none">
												<button type="submit" class="btn btn-outline-danger mt-1"><i class="far fa-trash-alt"></i> Xóa</button>
											{!! Form::close() !!} 
											</td>
										</tr>
									@endforeach
							</tbody>
						</table>
					</div>
			
					<div class="mt-3 d-flex justify-content-end">
						{{ $feedbacks->links() }}
					</div>
				@else
					<div class="alert alert-primary mt-3" role="alert">
						Chưa có phản hổi nào từ khách hàng !
					</div>
				@endif
			</div>
		</div>
	</div>
</div>