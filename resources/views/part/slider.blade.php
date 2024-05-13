<style>
    .intro-sections {
        width: 100%;
        overflow: hidden; /* Ensure the image doesn't overflow its container */
        margin-top: 100px;
    }

    .intro-sections img {
        width: 100%;
        height: auto; /* Allow the image to adjust its height while maintaining aspect ratio */
        object-fit: cover;
    }

    @media (max-width: 767px) {
        .intro-sections {
            margin-top: 120px; /* Adjust margin for smaller screens */
        }
    }
</style>
<div id="carouselExample" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach ($Sliders as $index => $Slider)
            <div class="carousel-item {{$index == 0 ? 'active' : ''}}">
                <img class="intro-sections d-block w-100" src="{{$Slider->images}}" alt="Slide {{$index + 1}}">
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>