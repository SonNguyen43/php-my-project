<style>
    .gallery {
    width: 100%;
    }

    .gallery-container {
    align-items: center;
    display: flex;
    height: 400px;
    margin: 0 auto;
    max-width: 1000px;
    position: relative;
    }

    .gallery-item {
    height: 150px;
    opacity: .4;
    position: absolute;
    transition: all 0.3s ease-in-out;
    width: 150px;
    z-index: 0;
    }

    .gallery-item.gallery-item-selected {
        box-shadow: 0 0 30px rgba(255, 255, 255, 0.6), 0 0 60px rgba(255, 255, 255, 0.45), 0 0 110px rgba(255, 255, 255, 0.25), 0 0 100px rgba(255, 255, 255, 0.1);
        height: 300px;
        opacity: 1;
        left: 50%;
        transform: translateX(-50%);
        width: 500px;
        z-index: 2;
    }

    .gallery-item.gallery-item-Trước,
    .gallery-item.gallery-item-Kế {
        height: 200px;
        opacity: 1;
        width: 300px;
        z-index: 1;
    }

    .gallery-item.gallery-item-Trước {
    left: 30%;
    transform: translateX(-50%);
    }

    .gallery-item.gallery-item-Kế {
        left: 70%;
        transform: translateX(-50%);
    }

    .gallery-item.gallery-item-first {
    left: 15%;
    transform: translateX(-50%);
    }

    .gallery-item.gallery-item-last {
    left: 85%;
    transform: translateX(-50%);
    }

    .gallery-controls {
    display: flex;
    justify-content: center;
    margin: 30px 0;
    }

    .gallery-controls button {
        border: 0;
        cursor: pointer;
        width: 100px;
        font-size: 16px;
        margin: 0 20px;
        padding: 10px;
        text-transform: capitalize;
        background: gray;
        color: white;
    }

    .gallery-controls button:focus {
        outline: none;
    }

    .gallery-controls-Trước {
        position: relative;
    }

   

    .gallery-controls-Trước:hover::before {
    left: -18px;
    }

    .gallery-controls-Kế {
        position: relative;
    }

  

    .gallery-controls-Kế:hover::before {
    right: -18px;
    }

    .gallery-nav {
        bottom: -15px;
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        position: absolute;
        width: 100%;
    }

    .gallery-nav li {
    background: #ccc;
    border-radius: 50%;
    height: 10px;
    margin: 0 16px;
    width: 10px;
    }

    .gallery-nav li.gallery-item-selected {
    background: #555;
    }
</style>

<div class="card shadow-sm mt-3 mb-3">
	<div class="info">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">	
				<h2 class="d-inline"><b>Quản lí ảnh nổi bật</b></h2>
            </div>
            
			<div class="col-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
                {!!Form::open(['action'=>'ImagesController@store', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
                    <div class="custom-file">
                        <input type="file" name="image" accept="image/*" class="custom-file-input" id="validatedCustomFile" required>
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                        <?php
                            $count = 5;
                            $image = count($images);
                        ?>

                        @if ($count - $image > 0)
                            <button type="submit" class="btn btn-success">Tải lên</button>
                            <b>Còn trống: <span class="text-success">{{$count - $image}}</span></b>
                        @else
                            <button type="submit" class="btn btn-success" disabled="disabled">Tải lên</button>
                            <b>Còn trống: <span class="text-danger">{{$count - $image}}</span></b>
                        @endif
                        
                {!!Form::close()!!}
			</div>
        </div>
        <div class="gallery" style="margin-top: -50px;">
            <div class="gallery-container">
                @if ($images != NULL)
                    @foreach ($images as $image)
                        @if ($image->images != NULL)
                            <img class="gallery-item" src="/storage/images/admin/images_hightlight/{{$image->images}}" data-toggle="modal" data-placement="top" title="Ấn để xóa ảnh" onclick="BindingID({{$image->id}})" data-target="#deleteImages">
                        @else
                            <img class="gallery-item" src="/storage/images/admin/default/noImage.png">
                        @endif
                    @endforeach
                @endif
            </div>

            @if (count($images) > 0)
                <div class="gallery-controls"></div>
            @endif
            
          </div>
	</div>
</div>

  
  <!-- Modal -->
<div class="modal fade" id="deleteImages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Bạn muốn xóa ảnh này ?

            @if (count($images) > 0)
                
            
            {!! Form::open(['action' => ['ImagesController@destroy', $image->id], 'method' => 'POST']) !!}
                {{Form::hidden('_method','DELETE')}}
                <input type="text" name="idimg" id="idimg" class="d-none">
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Đồng ý</button>
                {!! Form::close() !!} 
            
            @endif
        </div>
        </div>
    </div>
</div>

<script>

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    function BindingID(id){
        document.getElementById("idimg").value = id;
    }    


    const galleryContainer = document.querySelector('.gallery-container');
    const galleryControlsContainer = document.querySelector('.gallery-controls');
    const galleryControls = ['Trước', 'Kế'];
    const galleryItems = document.querySelectorAll('.gallery-item');

    class Carousel {
    constructor(container, items, controls) {
        this.carouselContainer = container;
        this.carouselControls = controls;
        this.carouselArray = [...items];
    }

    // Assign initial css classes for gallery and nav items
    setInitialState() {
        this.carouselArray[0].classList.add('gallery-item-first');
        this.carouselArray[1].classList.add('gallery-item-Trước');
        this.carouselArray[2].classList.add('gallery-item-selected');
        this.carouselArray[3].classList.add('gallery-item-Kế');
        this.carouselArray[4].classList.add('gallery-item-last');

        document.querySelector('.gallery-nav').childNodes[0].className = 'gallery-nav-item gallery-item-first';
        document.querySelector('.gallery-nav').childNodes[1].className = 'gallery-nav-item gallery-item-Trước';
        document.querySelector('.gallery-nav').childNodes[2].className = 'gallery-nav-item gallery-item-selected';
        document.querySelector('.gallery-nav').childNodes[3].className = 'gallery-nav-item gallery-item-Kế';
        document.querySelector('.gallery-nav').childNodes[4].className = 'gallery-nav-item gallery-item-last';
    }

    // Update the order state of the carousel with css classes
    setCurrentState(target, selected, Trước, Kế, first, last) {

        selected.forEach(el => {
        el.classList.remove('gallery-item-selected');

        if (target.className == 'gallery-controls-Trước') {
            el.classList.add('gallery-item-Kế');
        } else {
            el.classList.add('gallery-item-Trước');
        }
        });

        Trước.forEach(el => {
        el.classList.remove('gallery-item-Trước');

        if (target.className == 'gallery-controls-Trước') {
            el.classList.add('gallery-item-selected');
        } else {
            el.classList.add('gallery-item-first');
        }
        });

        Kế.forEach(el => {
        el.classList.remove('gallery-item-Kế');

        if (target.className == 'gallery-controls-Trước') {
            el.classList.add('gallery-item-last');
        } else {
            el.classList.add('gallery-item-selected');
        }
        });

        first.forEach(el => {
        el.classList.remove('gallery-item-first');

        if (target.className == 'gallery-controls-Trước') {
            el.classList.add('gallery-item-Trước');
        } else {
            el.classList.add('gallery-item-last');
        }
        });

        last.forEach(el => {
        el.classList.remove('gallery-item-last');

        if (target.className == 'gallery-controls-Trước') {
            el.classList.add('gallery-item-first');
        } else {
            el.classList.add('gallery-item-Kế');
        }
        });
    }

    // Construct the carousel navigation
    setNav() {
        galleryContainer.appendChild(document.createElement('ul')).className = 'gallery-nav';

        this.carouselArray.forEach(item => {
        const nav = galleryContainer.lastElementChild;
        nav.appendChild(document.createElement('li'));
        }); 
    }

    // Construct the carousel controls
    setControls() {
        this.carouselControls.forEach(control => {
        galleryControlsContainer.appendChild(document.createElement('button')).className = `gallery-controls-${control}`;
        }); 

        !!galleryControlsContainer.childNodes[0] ? galleryControlsContainer.childNodes[0].innerHTML = this.carouselControls[0] : null;
        !!galleryControlsContainer.childNodes[1] ? galleryControlsContainer.childNodes[1].innerHTML = this.carouselControls[1] : null;
    }
    
    // Add a click event listener to trigger setCurrentState method to rearrange carousel
    useControls() {
        const triggers = [...galleryControlsContainer.childNodes];

        triggers.forEach(control => {
        control.addEventListener('click', () => {
            const target = control;
            const selectedItem = document.querySelectorAll('.gallery-item-selected');
            const TrướcSelectedItem = document.querySelectorAll('.gallery-item-Trước');
            const KếSelectedItem = document.querySelectorAll('.gallery-item-Kế');
            const firstCarouselItem = document.querySelectorAll('.gallery-item-first');
            const lastCarouselItem = document.querySelectorAll('.gallery-item-last');

            this.setCurrentState(target, selectedItem, TrướcSelectedItem, KếSelectedItem, firstCarouselItem, lastCarouselItem);
        });
        });
    }
    }

    const exampleCarousel = new Carousel(galleryContainer, galleryItems, galleryControls);

    exampleCarousel.setControls();
    exampleCarousel.setNav();
    exampleCarousel.setInitialState();
    exampleCarousel.useControls();

    
</script>