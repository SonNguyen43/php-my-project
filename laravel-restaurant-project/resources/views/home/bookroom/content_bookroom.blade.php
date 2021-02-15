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
				<h2 class="d-inline"><b>Danh Sách Khách Đặt Phòng</b></h2>
			</div>

			<div class="col-12 col-sm-12 col-md-6 col-xl-6 col-lg-6">
				<form action="/home/danh-sach-dat-phong/tim-kiem" method="POST" class="form-inline my-2 my-lg-0 w-100">
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
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create_bookroom">
					<i class="fas fa-plus-circle"></i> Tạo mới 
				</button>

				@if (isset($search_key))
					<div class="alert alert-info mt-3" role="alert">
						{!!$search_key!!}
					</div>
				@endif

                @if (count($bookrooms) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered text-center mt-3">
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
                                    @foreach ($bookrooms as $bookroom)
                                        @if ($bookroom->status == "not approved")
                                            <tr>
                                                <td scope="row" style="line-height: 70px">{{$stt++}}</td>
                                                <td scope="row" style="line-height: 70px" data-toggle="tooltip" data-placement="left" title="Ấn để chỉnh sửa">
                                                    {!!Form::open(['action'=>['BookRoomsController@update', $bookroom->id], 'method'=>'POST'])!!}
                                                        {{Form::text('name',$bookroom->name, ['class'=>'text-center name', 'required'])}}
                                                        {{Form::hidden('_method','PUT')}}
                                                    {!!Form::close()!!}
                                                </td>
                                                
                                                <td scope="row" style="line-height: 70px">
                                                    {!!Form::open(['action'=>['BookRoomsController@update', $bookroom->id], 'method'=>'POST'])!!}
                                                        {{Form::text('phone_number',$bookroom->phone_number, ['class'=>'text-center name', 'required'])}}
                                                        {{Form::hidden('_method','PUT')}}
                                                    {!!Form::close()!!}
                                                </td>
                                                <td scope="row" style="line-height: 70px">
                                                    {!!Form::open(['action'=>['BookRoomsController@update', $bookroom->id], 'method'=>'POST'])!!}
                                                        {{Form::text('time',$bookroom->time, ['class'=>'text-center name', 'required'])}}
                                                        {{Form::hidden('_method','PUT')}}
                                                    {!!Form::close()!!}
                                                </td>
                                                <td scope="row" style="line-height: 70px">
                                                    {!!Form::open(['action'=>['BookRoomsController@update', $bookroom->id], 'method'=>'POST'])!!}
                                                        {{Form::text('people_number',$bookroom->people_number, ['class'=>'text-center name', 'required'])}}
                                                        {{Form::hidden('_method','PUT')}}
                                                    {!!Form::close()!!}
                                                </td>
                                                <td scope="row" style="line-height: 70px">
                                                    {!!Form::open(['action'=>['BookRoomsController@update', $bookroom->id], 'method'=>'POST'])!!}
                                                        {{Form::text('kind_of_room',$bookroom->kind_of_room	, ['class'=>'text-center name', 'required'])}}
                                                        {{Form::hidden('_method','PUT')}}
                                                    {!!Form::close()!!}
                                                </td>
                                                <td scope="row">
                                                    <a href="/haisan/public/home/danh-sach-dat-phong/{{ $bookroom->id }}/edit/" class="btn btn-primary"><i class="far fa-calendar-check"></i> Duyệt</a>

                                                    {!! Form::open(['action' => ['BookRoomsController@destroy', $bookroom->id], 'method' => 'POST']) !!}
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
						{{ $bookrooms->links() }}
					</div>
				@endif
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="create_bookroom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tạo mới</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                {!!Form::open(['action'=>'BookRoomsController@store', 'method'=>'POST'])!!}
                    {{Form::label('Tên của bạn:','Tên của bạn:')}} (<span class="text-danger">*</span>)
                    {{Form::text('name','', ['class'=>'form-control', 'required'])}}

                    <div class="row">
                        <div class="col">
                            {{Form::label('Số điện thoại:','Số điện thoại:')}} (<span class="text-danger">*</span>)
                            {{Form::number('phone_number','', ['class'=>'form-control', 'required'])}}
                        </div>
                        <div class="col">
                            {{Form::label('Loại phòng:','Loại phòng:')}}(<span class="text-danger">*</span>)
                            <select class="custom-select" name="kind_of_room" required>
                                
                                @foreach ($rooms as $room)
                                    <option value="{{$room->kind_of_room}}">{{$room->kind_of_room}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{Form::label('Ngày đặt:','Ngày đặt:')}} (<span class="text-danger">*</span>)
                    <?php
                        $date = getdate();
                    ?>
                    <div class="row">
                        <div class="col">
                            <select class="custom-select" name="day" required>
                                @for ($i = 1; $i < 32; $i++)
                                    <option value="{{$i}}" @if ($date['mday'] == $i) selected @endif>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col">
                            <select class="custom-select" name="month" required>
                                @for ($i = 1; $i < 13; $i++)
                                    <option value="{{$i}}" @if ($date['mon'] == $i) selected @endif>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col">
                            <select class="custom-select" name="year" required>
                                @for ($i = $date['year']; $i < $date['year'] + 3; $i++)
                                    <option value="{{$i}}" @if ($date['year'] == $i) selected @endif>{{$i}}</option>
                                @endfor
                            
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            {{Form::label('Giờ:','Giờ:')}}(<span class="text-danger">*</span>)
                            <select class="custom-select" name="hour" required>
                                <option value="8h">8h</option>
                                <option value="8:30h">8:30h</option>
                                <option value="9h">9h</option>
                                <option value="9:30h">9:30h</option>
                                <option value="10h">10h</option>
                                <option value="10:30h">10:30h</option>
                                <option value="11h">11h</option>
                                <option value="2020">11:30h</option>
                                <option value="12h">12h</option>
                                <option value="12:30h">12:30h</option>
                                <option value="13h">13h</option>
                                <option value="13:30h">13:30h</option>
                                <option value="14h">14h</option>
                                <option value="14:30h">14:30h</option>
                                <option value="15h">15h</option>
                                <option value="15:30h">15:30h</option>
                                <option value="16h">16h</option>
                                <option value="16:30h">16:30h</option>
                                <option value="17h">17h</option>
                                <option value="17:30h">17:30h</option>
                                <option value="18h">18h</option>
                                <option value="18:30h">18:30h</option>
                                <option value="19h">19h</option>
                                <option value="19:30h">19:30h</option>
                                <option value="20h">20h</option>
                                <option value="20:30h">20:30h</option>
                                <option value="21h">21h</option>
                                <option value="21:30h">21:30h</option>
                                <option value="22h">22h</option>
                                <option value="22:30h">22:30h</option>
                            </select>
                        </div>
                        <div class="col">
                            {{Form::label('Số người:','Số người:')}} (<span class="text-danger">*</span>)
                            {{Form::number('people_number','', ['class'=>'form-control', 'required'])}}
                        </div>
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