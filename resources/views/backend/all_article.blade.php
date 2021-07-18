@extends('backend.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @role('admin')
            <div class="">
                <a href="{{ route('admin.create.article') }}" class="btn btn-success">Add An Article </a>
            </div>
            <hr>
            @endrole
            @foreach ($articles as $article)
                <div class="col-md-12 col-sm-12 col-12 p-0">
                    <div class="row">
                        <a class="col-md-6 col-sm-6 col-12" href="{{ route('admin.article.find', $article->id) }}">
                            <h4 class="box-title">
                                <b class="badge custom-badge"> {{ $article->status }}</b>
                                <b class="badge custom-badge"> {{ $article->language }}</b>
                                <b class="badge custom-badge"> {{ $article->category->name }}</b>
                                {{ $article->title }}
                            </h4>
                        </a>
                        <p class="col-sm-6 col-md-6 col-12">
                            @role('admin')
                            <select class="form-control" onchange="changeArticleStatus(this, {{ $article->id }})">
                                <option> All Statuses</option>
                                <option value="active"> Active </option>
                                <option value="pending"> Pending </option>
                                <option value="inactive"> In-active </option>
                                <option value="denied"> Denied </option>
                                <option value="in-revision"> In-Revision </option>
                            </select>
                            @endrole
                        </p>
                    </div>
                </div>

            @endforeach
        </div>
        {{ $articles->links() }}
    </div>
@endsection
@section('js')
    <script>
        function changeArticleStatus(dom, id) {
            $.ajax({
                type: "get",
                url: window.location.origin + '/admin/api/article-status-change/' + id + '/' + dom.value,
                success: function(response) {
                    console.log(response);
                    if (response == 1) {
                        alert('successfull');
                    } else {
                        alert("please try again later, something went wrong");
                    }
                    location.reload();
                }
            })
        }
    </script>
@endsection
