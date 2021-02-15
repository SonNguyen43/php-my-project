<div class="col-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 m-0 mt-5">
    <div style="color:#777;" class="bg-white text-justify">
        <h2 style="font-family: 'Pacifico', cursive;text-center">Đặt Phòng Ngay</h2>
        <hr>
        <div class="mt-3">
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
                   
                   
                <div class="d-flex justify-content-end mt-3">
                    {{-- {{Form::hidden('_method','PUT')}} --}}
                    <button type="submit" class="btn btn-success mb-3">Đặt phòng</button>
                </div>
			{!!Form::close()!!}
        </div>
    </div>
</div>