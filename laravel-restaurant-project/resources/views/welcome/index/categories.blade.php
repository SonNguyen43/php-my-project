
<style>
    #carousel {
        position: relative;
        height: 400px;
        top: 50%;
        transform: translateY(-50%);
        overflow: hidden;
        margin-top: 230px;
        margin-bottom: -150px;
    }
    #carousel div {
        position: absolute;
        transition: transform 1s, left 1s, opacity 1s, z-index 0s;
        opacity: 1;
    }
    #carousel div img {
        width: 500px;
        transition: width 1s;
    }
    #carousel div.hideLeft {
        left: 0%;
        opacity: 0;
        transform: translateY(50%) translateX(-50%);
    }
    #carousel div.hideLeft img {
        width: 200px;
    }
    #carousel div.hideRight {
        left: 100%;
        opacity: 0;
        transform: translateY(50%) translateX(-50%);
    }
    #carousel div.hideRight img {
        width: 200px;
    }
    #carousel div.prev {
        z-index: 5;
        left: 30%;
        transform: translateY(50px) translateX(-50%);
    }
    #carousel div.prev img {
        width: 500px;
    }
    #carousel div.prevLeftSecond {
        z-index: 4;
        left: 15%;
        transform: translateY(50%) translateX(-50%);
        opacity: 0.7;
    }
    #carousel div.prevLeftSecond img {
        width: 200px;
    }
    #carousel div.selected {
        z-index: 10;
        left: 50%;
        transform: translateY(0px) translateX(-50%);
    }
    #carousel div.next {
        z-index: 5;
        left: 70%;
        transform: translateY(50px) translateX(-50%);
    }
    #carousel div.next img {
        width: 500px;
    }
    #carousel div.nextRightSecond {
        z-index: 4;
        left: 85%;
        transform: translateY(50%) translateX(-50%);
        opacity: 0.7;
    }
    #carousel div.nextRightSecond img {
        width: 200px;
    }

    .buttons {
        position: fixed;
        left: 50%;
        transform: translateX(-50%);
        bottom: 10px;
    }

    #prev{
        float: left; font-size: 50px; line-height: 400px; opacity: 1
    }
    #next{
        float: right; font-size: 50px; line-height: 400px; opacity: 1
    }

    @media only screen and (max-width: 768px){
        #carousel {
            position: relative;
            height: 200px;
            top: 50%;
            transform: translateY(-50%);
            overflow: hidden;
            margin-top: 100px;
        }
        #carousel div img {
            width: 250px;
            transition: width 1s;
        }

        #prev{
            position: static;
            margin-top: -170px;
            font-size: 40px;
        }
        #next{
            position: static;
            margin-top: -170px;
            font-size: 40px;
        }
    }
}
</style>

<div style="position:relative;">
    <div class="text-center mt-5">
        <h2 style="font-family: 'Pacifico', cursive;">Thực Đơn Đa Dạng - Phong Phú</h2>
        <hr>
    </div>
    <div style="color:#777;" class="bg-white text-justify text-center">
        @if (count($categories) > 0)    
        <div id="carousel">
            <span>
                <i id="prev" class="fas fa-arrow-circle-left" aria-hidden="false"></i>
            </span>
            
            <?php
                $i =  count($categories);

                if(($i % 2 == 0)){
                    $selected = $i / 2;
                }else{
                    $selected = $i / 2  - 0.5; 
                }
                $prev = $selected - 1;       
                $prevLeftSecond = $prev - 1;

                $next = $selected + 1;      
                $nextRightSecond = $next + 1; 
            ?>
            @foreach ($categories as $categorie)
                @if ($i == $prevLeftSecond)
                    <div class="prevLeftSecond">
                        <div class="position-relative">
                            <h3 style="font-family: 'Pacifico', cursive;"><b>{{$categorie->name}}</b></h3>
                        </div>
                        <a href="danh-muc/{{$categorie->id}}"><img src="/storage/images/admin/categorie/{{$categorie->image}}" height="500px"></a>
                    </div>
                @elseif($i == $prev)
                    <div class="prev">
                        <div class="position-relative">
                            <h3 style="font-family: 'Pacifico', cursive;"><b>{{$categorie->name}}</b></h3>
                        </div>
                        <a href="danh-muc/{{$categorie->id}}"><img src="/storage/images/admin/categorie/{{$categorie->image}}" height="500px"></a>
                    </div>
                @elseif($i == $selected)
                    <div class="selected">
                        <div class="position-static">
                            <h3 style="font-family: 'Pacifico', cursive;"><b>{{$categorie->name}}</b></h3>
                        </div>

                        <a href="danh-muc/{{$categorie->id}}"><img src="/storage/images/admin/categorie/{{$categorie->image}}" height="500px"></a>
                    </div>
                @elseif($i == $next)
                    <div class="next">
                        <div class="position-relative">
                            <h3 style="font-family: 'Pacifico', cursive;"><b>{{$categorie->name}}</b></h3>
                        </div>
                        <a href="danh-muc/{{$categorie->id}}"><img src="/storage/images/admin/categorie/{{$categorie->image}}" height="500px"></a>
                    </div>
                @elseif($i == $nextRightSecond)
                    <div class="nextRightSecond">
                        <div class="position-relative">
                            <h3 style="font-family: 'Pacifico', cursive;"><b>{{$categorie->name}}</b></h3>
                        </div>
                        <a href="danh-muc/{{$categorie->id}}"><img src="/storage/images/admin/categorie/{{$categorie->image}}" height="500px"></a>
                       
                    </div>
                @elseif($i > $next + 2)
                    <div class="hideRight">
                        <div class="position-relative">
                            <h3 style="font-family: 'Pacifico', cursive;"><b>{{$categorie->name}}</b></h3>
                        </div>
                        <a href="/danh-muc/{{$categorie->id}}"><img src="/storage/images/admin/categorie/{{$categorie->image}}" height="500px"></a>
                        
                    </div> 
                @elseif($i > $prev - 2)
                    <div class="hideLeft">
                        <div class="position-relative">
                            <h3 style="font-family: 'Pacifico', cursive;"><b>{{$categorie->name}}</b></h3>
                        </div>
                        <a href="danh-muc/{{$categorie->id}}"><img src="/storage/images/admin/categorie/{{$categorie->image}}" height="500px"></a>
                       
                    </div>
                @endif

                <?php $i--; ?>
            @endforeach
               
          
         
            {{-- <div class="hideLeft">
                <img src="https://st.quantrimang.com/photos/image/2019/07/29/hinh-nen-dien-thoai-6.png" >
            </div>
        
            <div class="prevLeftSecond">
                <img src="https://st.quantrimang.com/photos/image/2019/07/29/hinh-nen-dien-thoai-60.jpg" >
            </div>
        
            <div class="prev">
                <img src="https://st.quantrimang.com/photos/image/2019/07/29/hinh-nen-dien-thoai-47.jpg" >
            </div>
        
            <div class="selected">
                <img src="https://st.quantrimang.com/photos/image/2019/07/29/hinh-nen-dien-thoai-11.jpg" >
            </div>
        
            <div class="next">
                <img src="https://st.quantrimang.com/photos/image/2019/07/29/hinh-nen-dien-thoai-45.jpg" >
            </div>
        
            <div class="nextRightSecond">
                <img src="https://st.quantrimang.com/photos/image/2019/07/29/hinh-nen-dien-thoai-42.jpg" >
            </div>
        
            <div class="hideRight">
                <img src="https://st.quantrimang.com/photos/image/2019/07/29/hinh-nen-dien-thoai-49.jpg" >
            </div> --}}

            <span>
                <i id="next" class="fas fa-arrow-circle-right" aria-hidden="false"></i>
            </span>
         </div>
        @else
            <div class="alert alert-warning">Chưa Có Danh Mục Có Sẵn</div>
        @endif
    </div>

 
</div>

<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>

<script>
    function moveToSelected(element) {

    if (element == "next") {
    var selected = $(".selected").next();
    } else if (element == "prev") {
    var selected = $(".selected").prev();
    } else {
    var selected = element;
    }

    var next = $(selected).next();
    var prev = $(selected).prev();
    var prevSecond = $(prev).prev();
    var nextSecond = $(next).next();

    $(selected).removeClass().addClass("selected");

    $(prev).removeClass().addClass("prev");
    $(next).removeClass().addClass("next");

    $(nextSecond).removeClass().addClass("nextRightSecond");
    $(prevSecond).removeClass().addClass("prevLeftSecond");

    $(nextSecond).nextAll().removeClass().addClass('hideRight');
    $(prevSecond).prevAll().removeClass().addClass('hideLeft');

    }

    // Eventos teclado
    $(document).keydown(function(e) {
    switch(e.which) {
        case 37: // left
        moveToSelected('prev');
        break;

        case 39: // right
        moveToSelected('next');
        break;

        default: return;
    }
    e.preventDefault();
    });

    $('#carousel div').click(function() {
    moveToSelected($(this));
    });

    $('#prev').click(function() {
    moveToSelected('prev');
    });

    $('#next').click(function() {
    moveToSelected('next');
    });
</script>