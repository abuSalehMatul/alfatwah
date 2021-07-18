@extends('backend.layouts.master')
@section('content')
<div class="container-fluid" id="app">
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                @role('admin')
                <answer-form role="admin"  :question_id="{{$id}}"></answer-form>
                @endrole
                @role('sub_admin')
                <answer-form role="sub_admin" :question_id="{{$id}}"></answer-form>
                @endrole
            </div>
        </div>
    </div>
</div>
@endsection