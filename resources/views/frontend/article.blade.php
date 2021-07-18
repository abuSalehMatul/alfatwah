@extends('frontend.layouts.master')
@section('content')
    <div class="main-section mt-5">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="left-text">
                        <i class="far fa-bookmark"></i>
                        <span>
                            <b>{!! $article->title !!}</b>
                        </span>
                    </div>
                    <div class="left-text">
                        <span>
                            {!! $article->body  !!}
                        </span>
                    </div>
                </div>
            </div>
            <hr>
            
        </div>
    </div>
@endsection
