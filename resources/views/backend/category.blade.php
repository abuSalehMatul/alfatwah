@extends('backend.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row space-position">
        <div class="col-md-12">
            <div class="white-box">
                <a class=" btn btn-success" href="{{route('admin.add.category')}}"> Add Category </a>
                @php
                    $categories = App\Category::get();
                @endphp
                @foreach($categories as $category)
                    @if($category->parent_id == null)
                    <h2>
                        {{$category->name_bn}}/{{$category->name_en}}/{{$category->name_ar}}
                        <i onclick="confirmation({{$category->id}})" class="fa fa-times badge-danger badge" style="cursor: pointer"> delete </i>
                    </h2>
                   
                    <div class="well"> 
                        @php
                        $childs = App\Category::where('parent_id', $category->id)->get();
                        @endphp
                        @foreach($childs as $child)
                            <li> 
                                {{$child->name_bn}}/{{$child->name_en}}/{{$child->name_ar}}
                                <i onclick="confirmation({{$child->id}})" class="fa fa-times badge-danger badge" style="cursor: pointer"> delete </i>
                            </li>
                            <br>
                        @endforeach
                    </div>
                   
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
   <script> 
   function confirmation(id){
       if(confirm('Are you sure?')){
           location.href = window.location.origin + "/admin/api/delete-category/"+id;
           
       }
   }
   </script> 
@endsection