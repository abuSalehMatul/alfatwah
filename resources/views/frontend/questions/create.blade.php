@extends('frontend.layouts.master')
@section('content')

<div class="main-section mt-5">
  <div class="container">
    <h1>{{__('Send a New Question')}}</h1>
    <form action="{{route('questions.store')}}" method="post">
      @csrf
      @include('frontend.questions.form_fields')
      <div class="form-group row">
        <div class="col-md-12 text-right">
          <button class="btn btn-success">{{__('Ask')}}</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection