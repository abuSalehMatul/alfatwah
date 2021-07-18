@extends('backend.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <form method="POST" action="{{route('admin.question.edit')}}"> 
                    @csrf
                    <label>Title</label>
                    <input type="text" name="title" value="{{$question->title}}">
                    <input type="hidden" class="form-control" value="{{$question->id}}" name="question_id">
                    <hr>
                    <br>
                    <label>Description </label>
                    <textarea  class="form-control" name="description" id="" cols="30" rows="10">
                        {{$question->description}}
                    </textarea>
                    <hr>
                    <input type="submit" value="Save" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection