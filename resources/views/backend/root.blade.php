@extends('backend.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row space-position">
        <div class="col-md-12">
            <div class="white-box col-md-12 p-l-0">
                <h3>Admins </h3>
                  
                @foreach($admins as $admin)
                    <form method="POST" class="col-md-12" action="{{route('admin.edit')}}"> 
                        @csrf
                        <div class="col-md-1 form-group"> 
                            <input type="text" value="{{$admin->name}}" name="name" class="form-control">
                        </div>
                        <input type="hidden" value="{{$admin->id}}" name="admin_id">
                        <div class="col-md-3 form-group"> 
                            <input type="password" class="form-control" name="password" placeholder="password, Min:6"> 
                        </div>
                        <div class="col-md-3 form-group"> 
                            <input type="email" class="form-control" value="{{$admin->email}}" name="email" placeholder="Email"> 
                        </div>
                        <div class="col-md-2"> 
                            <label>Send Email
                            <input type="checkbox" name="email_permission" value="1" @if($admin->email_permission == 1) checked @endif> </label>
                        </div>
                        <div class="col-md-2 form-group"> 
                            <input type="submit" class="form-control btn-success" value="Save"> 
                        </div>
                       
                        <div class="col-md-1 form-group"> 
                            <a class="btn btn-danger" href="{{route('admin.delete', $admin->id)}}"> Delete</a>
                        </div>
                    </form>
                @endforeach
            </div>
            
            <hr>
            
        </div>
        <div class="white-box col-md-12">
            <h3>Sub Admins </h3>
              
            @foreach($subAdmins as $admin)
                <form method="POST" class="col-md-12" action="{{route('admin.edit')}}"> 
                    @csrf
                    <div class="col-md-1 form-group"> 
                        <input type="text" value="{{$admin->name}}" name="name" class="form-control">
                    </div>
                    <input type="hidden" value="{{$admin->id}}" name="admin_id">
                    <div class="col-md-3 form-group"> 
                        <input type="password" class="form-control" name="password" placeholder="password, Min:6"> 
                    </div>
                    <div class="col-md-3 form-group"> 
                        <input type="email" class="form-control" value="{{$admin->email}}" name="email" placeholder="Email"> 
                    </div>
                    <div class="col-md-2"> 
                        <label>Send Email
                        <input type="checkbox" name="email_permission" value="1" @if($admin->email_permission == 1) checked @endif> </label>
                    </div>
                    <div class="col-md-2 form-group"> 
                        <input type="submit" class="form-control btn-success" value="Save"> 
                    </div>
                    <div class="col-md-1 form-group"> 
                        <a class="btn btn-danger" href="{{route('admin.delete', $admin->id)}}"> Delete</a>
                    </div>
                </form>
            @endforeach
        </div>
        <div class="white-box col-md-12"> 
            <h3> Create An Admin</h3>
            <form method="POST" action="{{route('admin.save')}}"> 
                @csrf
                <div class="col-md-6 form-group"> 
                    <input type="text" placeholder="Name"  name="name" class="form-control" required>
                </div>
                <div class="col-md-6 form-group"> 
                    <input type="password" class="form-control" name="password" placeholder="password, Min:6" required> 
                </div>
                <div class="col-md-6 form-group"> 
                    <input type="email" class="form-control" name="email" placeholder="Email" required> 
                </div>
                <div class="col-md-6 form-group"> 
                    <input type="text" class="form-control" name="phone" placeholder="Phone" required> 
                </div>
                <div class="col-md-6 form-group"> 
                    <input type="text" class="form-control" name="address" placeholder="Address" required> 
                </div>
                <div class="col-md-6 form-group"> 
                    <select class="form-control" name="role"> 
                        <option value="admin"> Admin </option>
                        <option value="sub_admin"> Sub Admin </option>
                    </select>
                </div>
                <div class="col-md-6 form-group"> 
                    <input type="submit" class="form-control btn-success" value="Save"> 
                </div>

            </form>
        </div>
    </div>
</div>
@endsection