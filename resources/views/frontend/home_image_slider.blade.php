<image-slider 
:app_local="'{{ app()->getLocale() }}'"
:url = "'{{route('slider.image.get', app()->getLocale())}}'"> 
</image-slider>