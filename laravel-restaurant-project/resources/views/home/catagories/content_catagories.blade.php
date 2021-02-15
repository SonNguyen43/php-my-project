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
				<h2 class="d-inline"><b>Quản lí danh mục món ăn</b></h2>
			</div>

			<div class="col-12 col-sm-12 col-md-6 col-xl-6 col-lg-6">
				<form action="/home/danh-muc/tim-kiem" method="POST" class="form-inline my-2 my-lg-0 w-100">
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
					<i class="fas fa-plus-circle"></i> Tạo mới danh mục
				</button>

				@if (isset($search_key))
					
					<div class="alert alert-info mt-3" role="alert">
						{!!$search_key!!}
					</div>
				@endif

				@if (count($categories) > 0)
					<div class="table-responsive">
						<table class="table table-bordered text-center mt-3">
							<thead class="bg-success text-light">
								<tr>
									<th scope="col" >Số thứ tự</th>
									<th scope="col">Tên danh mục</th>
									<th scope="col" >Ảnh</th>
									<th scope="col" >Chức năng</th>
								</tr>
							</thead>	
							<tbody class="table-sm">
								<?php $stt = 1; ?>
									@foreach ($categories as $categorie)
										<tr>
											<td scope="row" style="padding-top: 20px">{{$stt++}}</td>
											<td scope="row" style="padding-top: 20px" data-toggle="tooltip" data-placement="left" title="Ấn để chỉnh sửa">
												{!!Form::open(['action'=>['CategoriesController@update', $categorie->id], 'method'=>'POST'])!!}
													{{Form::text('name',$categorie->name, ['class'=>'text-center name'])}}
													{{Form::hidden('_method','PUT')}}
												{!!Form::close()!!}
											</td>
											<td scope="row">
												<img src="/storage/images/admin/categorie/{{ $categorie->image }}" alt="" width="100px" height="50">
											</td>
											<td scope="row" style="padding-top: 10px">
												{{-- @if ($categorie->updated_at != NULL)
													{{date("d-m-Y", strtotime(substr($categorie->created_at,0, 10)))}}
												@endif --}}
												<a href="/home/danh-muc/{{ $categorie->id }}/edit/" class="btn btn-primary"><i class="far fa-edit"></i>Sửa</a>
											</td>
										</tr>
									@endforeach
							</tbody>
						</table>
					</div>
		
					<div class="mt-3 d-flex justify-content-end">
						{{ $categories->links() }}
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
				{!!Form::open(['action'=>'CategoriesController@store', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
					{{Form::label('Tên danh mục:','Tên danh mục:')}}(<span class="text-danger">*</span>)
					{{Form::text('name','', ['class'=>'form-control'])}}

					{{Form::label('Ảnh minh họa:','Ảnh minh họa:')}}(<span class="text-danger">*</span>)
					<div class="custom-file">
						{{Form::file('image', ['accept'=>'image/*','class'=>'custom-file-input', 'id'=>'validatedCustomFile', 'required'])}}
						<label class="custom-file-label" for="validatedCustomFile">Chọn file ảnh...</label>
						<div class="invalid-feedback">Example invalid custom file feedback</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
				<button type="submit" class="btn btn-success">Tạo</button>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
</div>