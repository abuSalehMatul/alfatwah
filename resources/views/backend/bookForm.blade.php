@extends('backend.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="">
        <div class="col-md-12 space-position">
            <br>
            <div class="white-box">
                <form method="POST" action="{{route('admin.book.create.save')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-6 col-sm-12">
                        <h5>Title </h5>
                        <input type="text" name="title" placeholder="Add a title" class="form-control">
                        <h5>Writer </h5>
                        <input type="text" name="writer" placeholder="Writer Name" class="form-control">
                    </div>
                    
                    <div class="col-md-6 col-sm-6 white-box form-group" >
                        <h5>Language</h5>
                        @php
                            $langs = config('app_langs');
                        @endphp
                        <select class="form-control col-md-6" name="lang"> 
                            @foreach($langs as $key => $lang)
                            <option value="{{$key}}">{{$lang}}</option>
                            @endforeach
                        </select>
                        <h5>Upload the book</h5>
                        <input type="file" name="file">
                    </div>
                   
                   
                    <div class="form-group ">
                        <input type="submit" class="btn badge-info" style="width: 50%;color:white" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection