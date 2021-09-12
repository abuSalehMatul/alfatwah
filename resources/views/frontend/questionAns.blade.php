@extends('frontend.layouts.master')
@section('content')
    @php
    $answer = "answer_".app()->getLocale();
    @endphp
    <div class="main-section mt-5">
        <div class="container">
            <div class="row"> 
                <h3 class="col-md-8">{{__('Fatwa No')}} : {{$questionAnswer->$answer->id}}</h3>
                <h5 class="col-md-4" style="padding-left: 10px">{{__('Date')}} : {{$questionAnswer->$answer->created_at}}</h5>
            </div>
            
            <h3><b>{{__('Question')}}</b></h3>
            <div class="card">
               
                <div class="card-body">
                    <div class="left-text">
                        <span>
                            <b>{!! $questionAnswer->$answer->question_title !!}</b>
                        </span>
                    </div>
                    <div class="left-text">
                        <span>
                            {!! $questionAnswer->$answer->question !!}
                        </span>
                    </div>
                </div>
            </div>
            <hr>
            <br>
            <h3><b> {{ __('Answer') }}</b></h3>
            <div class="card">
                <div class="card-body answer-background">
                    <div class="left-text">
                        <span>
                            @php
                                $answer = "answer_".app()->getLocale();
                            @endphp
                            @if($questionAnswer->$answer->title)
                              {!! $questionAnswer->$answer->title !!}
                            @endif
                        </span>

                       <br>
                        <span>
                            @php
                                $answer = "answer_".app()->getLocale();
                            @endphp
                            @if($questionAnswer->$answer->description)
                             {!! $questionAnswer->$answer->description !!}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
