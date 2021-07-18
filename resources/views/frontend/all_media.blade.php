@extends('frontend.layouts.master')
@section('content')
    <div class="main-section mt-5">
        <div class="container">
            @foreach ($medias as $media) 
            <div class="col-md-12">
                <video width="100%" height="340" controls>
                    <source src="{{$media->url}}" type="video/mp4">
                </video> 
                <h3>{{$media->title}}</h3>
            </div>
            <br>
            <hr>

            @endforeach
            {{ $medias->links() }}
        </div>
        
    </div>
@endsection
