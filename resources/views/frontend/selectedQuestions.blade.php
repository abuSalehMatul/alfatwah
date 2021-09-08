@extends('frontend.layouts.master')
@section('content')
    <div class="main-section mt-5">
        <div class="container">
            @foreach ($questions as $question)
                @if (sizeof($question->answers) > 0)
                    <a href="{{ route('question.answer', [$question->id]) }} ">
                        <div class="card">
                            <div class="card-body">
                                <div class="left-text">
                                    <span class="short-query two-line text-decoration-dotted">
                                        @php
                                            print_r($question->answers[0]->question_title);
                                        @endphp
                                    </span>
                                </div>
                                <div class="left-text">
                                    <span class="short-query two-line">
                                        @php
                                            print_r($question->answers[0]->question);
                                        @endphp
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
            {{ $questions->links() }}
        </div>
    </div>
@endsection
