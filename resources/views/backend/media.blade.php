@extends('backend.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row space-position">
            <div class="col-md-12">
                <div class="white-box">
                    @role('admin')
                    <a class=" btn btn-success" href="{{ route('admin.add.media') }}"> Add Media </a>
                    @endrole
                    <table class="table table-borderless">
                        <thead>
                            <th>
                                Title
                            </th>
                            <th> Link </th>

                            @role('admin')
                            <th>Change Status</th>
                            <th></th>
                            @endrole
                        </thead>
                        <tbody>
                            @foreach ($medias as $media)
                                <tr>
                                    <td nowrap> {{ $media->title }} <i
                                            class="badge badge-secondary">{{ $media->status }}</i></td>
                                    <td><a target="blank" href="{{ $media->url }}">{{ $media->url }}</a></td>
                                    @role('admin')
                                    <td>
                                        <select class="form-control"
                                            onchange="changeStatusMedia(this, {{ $media->id }})">
                                            <option value="">All Option </option>
                                            <option value="active"> Active </option>
                                            <option value="pending"> Pending </option>
                                            <option value="deactive"> Deactive </option>
                                        </select>
                                    </td>
                                    <td>
                                        <button onclick="confirmation({{ $media->id }})" class="btn btn-danger">Delete
                                        </button>
                                    </td>
                                    @endrole
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $medias->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function confirmation(id) {
            if (confirm('Are you sure?')) {
                location.href = window.location.origin + "/admin/api/delete-media/" + id;

            }
        }

        function changeStatusMedia(dom, id) {
            console.log(dom.value)
            if (dom.value != "") {
                if (confirm('Are you sure?')) {
                    location.href = window.location.origin + "/admin/api/status-change-media/" + id + "/" + dom.value;
                }
            }
        }
    </script>
@endsection
