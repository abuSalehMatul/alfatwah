@extends('frontend.layouts.master')
@section('content')
    <div class="main-section mt-5">
        <div class="container">
           <div class="col-md-12">
               @php
                   print_r($aboutUs);
               @endphp 
           </div>
        </div>
        
    </div>
@endsection
