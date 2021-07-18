@extends('frontend.layouts.master')
@section('content')
    <div class="main-section mt-5">
        <div class="container">
            @if ($childs)
                <div>
                    <h1> {{$category->name}}<i class="fas fa-arrow-alt-circle-down"></i></h1>
                </div>
                <div class="col-md-6" style="padding-left: 0">
                    @foreach ($childs as $child)
                        <div class="sub-div" onclick="selectASub({{ $child->id }},  '{{ app()->getLocale() }}')">
                            {{ $child->name }}
                        </div>
                    @endforeach

                </div>
                <br>

            @endif
            @foreach ($questions as $question)
                <a href="{{ route('question.answer', [$question->id]) }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="left-text">
                                <span class="short-query two-line">
                                    {!! $question->description !!}
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
            {{ $questions->links() }}
        </div>

    </div>
@endsection
@section('js')
    <script>
        function selectASub(child, lang) {
            window.location.href =  window.location.origin+ "/"+lang +"/category/"+child;
        }

    </script>
@endsection
