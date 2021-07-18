@extends('frontend.layouts.master')
@section('content')
    <div class="main-section mt-5">
        <div class="container">
            @foreach ($articles as $article) 
            <a href="{{route('article',[ $article->id])}}">
                <div class="card">
                    <div class="card-body">
                        <div class="left-text">
                            <span class="short-query two-line">
                                {!! $article->title !!}
                            </span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
            {{ $articles->links() }}
        </div>
        
    </div>
@endsection
