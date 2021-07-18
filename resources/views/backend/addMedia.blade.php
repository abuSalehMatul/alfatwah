@extends('backend.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row space-position">
            <div class="col-md-12 p-0">
                <div class="">
                    <div class="">
                        <h2>Add Media in the System</h2>
                    </div>
                    <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Title of the media </label>
                                <input type="text" name="title" required required class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Media File</label>
                                <input type="file" class="form-control" required name="media">
                            </div>
                            <div class="col-md-4">
                                <label>Languagle </label>
                                <select class="form-control" name="lang">
                                    <option value="en">English</option>
                                    <option value="ar">Arabic </option>
                                    <option value="bn">Bangla</option>
                                </select>
                            </div>
                            <div class="col-md-12 cols-sm-12">
                                <input type="submit" class="btn btn-success w-100" value="Save">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
