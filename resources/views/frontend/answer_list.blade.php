@extends('frontend.layouts.master')
@section('content')

<div class="main-section mt-5">
    <div class="container">
      @foreach ($answers as $answer)
      <a href="{{url('/')."/".$answer->language."/answer/".$answer->batch_id}} ">
        <div class="card">
          <div class="card-body">
            <div class="left-text">
              <span class="short-query two-line text-decoration-dotted">{!! $answer->title !!}</span>
            </div>
            <div class="left-text">
              <span class="short-query two-line">{!! $answer->description !!}</span>
            </div>
          </div>
        </div>
      </a>
      @endforeach
       {{$answers->links()}}
    </div>
</div>
@endsection