<div class="col-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 m-0 mt-5">
    <div style="color:#777;" class="bg-white text-justify">
        <h2 style="font-family: 'Pacifico', cursive;">Ảnh Nổi Bật</h2>
        <hr>
        <div class="mt-4 mb-3">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    
                    <?php $i = 0; ?>
                    @if (count($images) > 0)
                        @foreach ($images as $image)
                            @if ($i > 0)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
                            @else
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="active"></li>
                            @endif
                            <?php $i++; ?>
                        @endforeach
                    @else
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    @endif
                </ol>
                <div class="carousel-inner">
                    <?php $i = 1; ?>
                    @if (count($images) > 0)
                        @foreach ($images as $image)

                            @if ($i > 1)
                                <div class="carousel-item">
                                    <a href="/storage/images/admin/images_hightlight/{{$image->images}}" target="_blank"><img src="/storage/images/admin/images_hightlight/{{$image->images}}" class="d-block w-100" height="300px" alt="..."></a>
                                </div>
                            @else
                                <div class="carousel-item active">
                                    <a href="/storage/images/admin/images_hightlight/{{$image->images}}" target="_blank"><img src="/storage/images/admin/images_hightlight/{{$image->images}}" class="d-block w-100" height="300px" alt="..."></a>
                                </div>
                            @endif

                            
                            <?php $i++; ?>
                        @endforeach
                    @else
                        <div class="carousel-item active">
                            <a href="https://dummyimage.com/hd1080" target="_blank"><img src="https://dummyimage.com/hd1080" class="d-block w-100" alt="..."></a>
                        </div>
                    @endif
                  
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>