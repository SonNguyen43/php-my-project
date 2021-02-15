<style>
    #navbar {
        position: fixed;
        top: 0;
        width: 100%;
        /*display: block; */
        transition: top 0.3s;
        z-index: 100;
    }
</style>

<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">


<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm" id="navbar" style="font-family: 'Pacifico', cursive;">
    <a class="navbar-brand" href="#">Hải Sản Biển Xanh</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item border-right">
                <a class="nav-link" href="/"><i class="fas fa-home"></i> Trang chủ</a>
            </li>
            <li class="nav-item dropdown border-right">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-list-alt"></i> Danh mục
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach ($categories_all as $categorie)
                        <a class="dropdown-item" href="/danh-muc/{{$categorie->id}}"><img class="rounded-pill" src="/storage/images/admin/categorie/{{$categorie->image}}" height="20px" width="20px">  {{$categorie->name}}</a>
                        <div class="dropdown-divider"></div>
                    @endforeach
                </div>
            </li>

            <li class="nav-item dropdown border-right">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-hamburger"></i> Món nổi bật
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach ($foods_hightlight_all as $food)
                        <a class="dropdown-item" href="/danh-muc/mon-an/{{$food->id}}"><img src="/storage/images/admin/food/{{$food->image}}" class="rounded-pill" alt="..." height="20px" width="20px">  {{$food->name}}</a>
                        <div class="dropdown-divider"></div>
                    @endforeach

                    <a class="dropdown-item text-center" href="/mon-an">Tất cả món ăn</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link"  data-toggle="modal" data-target="#create_bookroom" href="#"><i class="far fa-calendar-plus"></i> Đặt phòng ngay</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="create_bookroom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="far fa-calendar-plus"></i>  Đặt phòng</h5>
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

<script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbar").style.top = "0";
        } else {
            document.getElementById("navbar").style.top = "-55px";
        }
        prevScrollpos = currentScrollPos;
    }
</script>