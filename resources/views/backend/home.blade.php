@extends('backend.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-3">
            <div class="white-box">
                <h6 class="box-title">Total Active Answers</h6>
                <h6> {{$data['total_answered']}} </h6>
            </div>
        </div>
        <div class="col-md-2 col-sm-2 col-3">
            <div class="white-box">
                <h6 class="box-title">Total Active Questions</h6>
                <h6> {{$data['total_question']}} </h6>
            </div>
        </div>
        <div class="col-md-2 col-sm-2 col-3">
            <div class="white-box">
                <h6 class="box-title">Categories</h6>
                <h6> {{$data['total_category']}} </h6>
            </div>
        </div>

        <div class="col-md-2 col-sm-2 col-3">
            <div class="white-box">
                <h6 class="box-title">Total Users</h6>
                <h6> {{$data['total_user']}} </h6>
            </div>
        </div>
        <div class="col-md-2 col-sm-2 col-3">
            <div class="white-box">
                <h6 class="box-title">Total Books</h6>
                <h6> {{$data['total_book']}} </h6>
            </div>
        </div>
        <div class="col-md-2 col-sm-2 col-3">
            <div class="white-box">
                <h6 class="box-title">Published Articles</h6>
                <h6> {{$data['publish_article']}} </h6>
            </div>
        </div>
    </div>
    <div>
        <admin-report></admin-report>
    </div>
</div>
@endsection