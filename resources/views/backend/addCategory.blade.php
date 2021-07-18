@extends('backend.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="">
        <div class="col-md-12 space-position">
            <br>
            <div class="white-box">
                <form method="POST" action="{{route('admin.category.save')}}">
                    @csrf
                    <div class="form-group col-md-6 col-sm-12">
                        <h5>Category Name Bangle </h5>
                        <input type="text" name="name_bn" placeholder="Name Bangle" class="form-control">
                        <h5>Category Name English </h5>
                        <input type="text" name="name_en" placeholder="Name English" class="form-control">
                        <h5>Category Name Arbi </h5>
                        <input type="text" name="name_ar" placeholder="Name Arabic" class="form-control">
                    </div>
                    
                    <div class="col-md-6 col-sm-6 white-box form-group" >
                        <h5>Parent</h5>
                        @php
                             $categories = App\Category::get();
                        @endphp
                        <select class="form-control col-md-6" name="parent"> 
                            <option value="none"> </option>
                            @foreach($categories as $categorie)
                            <option value="{{$categorie->id}}">{{$categorie->name_bn}}/{{$categorie->name_en}}/{{$categorie->name_ar}}</option>
                            @endforeach
                        </select>
                    
                    </div>
                   
                   
                    <div class="form-group ">
                        <input type="submit" class="btn badge-info" style="width: 95%;margin:10px;color:white" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection