@extends('backend.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row space-position">
        <div class="col-md-12">
            <div class="white-box">
                <form method="POST" action="{{route('admin.send.email')}}" enctype="multipart/form-data"> 
                    @csrf
                    <div class="form-group"> 
                        <label>Recipient</label>
                        <input type="email" name="recipent" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Subject </label>
                        <input  type="text" required name="subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Body</label>
                        <textarea class="form-control" rows="20" name="body" required> 
                        </textarea> 
                    </div>
                    {{-- <div class="form-group">
                        <label>Attach any file</label>
                        <input type="file" name="file">
                    </div> --}}
                    <div class="form-group">
                        <input type="submit" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
