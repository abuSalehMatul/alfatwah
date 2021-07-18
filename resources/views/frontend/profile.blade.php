@extends('frontend.layouts.master')
@section('content')
    <div class="main-section mt-5">
        <div class="container">
            <h3> {{__('Salam')}} {{auth()->user()->name}} </h3>
            <h5> {{__('All_Activities')}}</h5>
            <hr>
            <br>
            @foreach($questions as $question)
            <div class="card">
              
                <div class="card-body">
                    <div class="left-text">
                        <i class="far fa-bookmark"></i>
                        <span>
                            <b>{{ $question->title }}</b>
                        </span>
                        <span> 
                            <i class="badge badge-secondary"> @if($question->is_answered==1) {{__('Answered')}} @else {{__('Not_Ans')}} @endif</i>
                        </span>
                    </div>
                    <div class="left-text">
                        <span>
                            {{ $question->description }}
                        </span>
                    </div>
                    @if($question->is_answered)
                        <a href="{{route('go.to.ans', $question->id)}}">{{(__('Go_To_Ans'))}} </a>
                    @endif
                </div>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
@endsection
