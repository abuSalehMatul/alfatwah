@extends('backend.layouts.master')
@section('content')
    <div class="container-fluid">

        <div class="row">
            @foreach ($questions as $question)
                <a href="{{route('admin.question', [$question->id])}}">
                    <div class="col-md-12 ">
                        <div class="white-box hover-red">
                            <h3 class="box-title">{{ $question->title }}</h3>
                            <p>{{ $question->description }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
            {{ $questions->links() }}
        </div>
    </div>
@endsection
