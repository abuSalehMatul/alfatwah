@extends('backend.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="col-md-12 row">
                <div style="">
                    <div class="space-position col-md-12" style="padding-left: 0">
                        @role('admin')
                        <tr>
                            <td> <a class="btn"
                                    href="{{ route('question.change.status', [$question->id, $question->status]) }}">{{ $question->status != 'active' ? 'Active' : 'Deactive' }}</a>
                            </td>
                            <td> <a class="btn" href="{{ route('question.edit', $question->id) }}">Edit </a> </td>
                            @if (!$question->is_selected)
                                <td> <a class="" href="{{ route('question.selection', [$question->id]) }}">Selected Question
                                    </a> </td>
                            @else
                                <td> <a class="btn" href="{{ route('question.selection', [$question->id]) }}">Unselect</a>
                                </td>
                            @endif

                        </tr>
                        @endrole

                    </div>
                    <div class="space-position col-md-12 col-sm-12">
                        <tr>
                            <td> <i class="badge {{ $question->status == 'active' ? 'badge-info' : 'badge-warning' }}">
                                    {{ $question->status }} </i> </td>
                            <td> <i class="badge {{ $question->status == 1 ? 'badge-info' : 'badge-danger' }}">Is Answered:
                                    {{ $question->is_answered == 0 ? 'No' : 'Yes' }} </i> </td>
                            <td> <i class="badge badge-sm custom-badge" style="">{{ $question->tag }} </i></td>
                            <td> <i class="badge  badge-sm custom-badge" style=""> Category:
                                    {{ optional($question->category)->name_en }} </i>
                            </td>
                            <td> <i class="badge badge-sm custom-badge" style=""> Views:
                                    {{ $question->view_count }} </i></td>
                            <td> <i class="badge badge-sm custom-badge" style=""> Asked at:
                                    {{ $question->created_at->format('d-m-y h:i:s') }} </i></td>
                            <td></td>
                        </tr>


                    </div>
                </div>
                <div class="col-md-12  space-position row" style="margin-left:-21px">
                    <form method="post" class="col-md-12 col-sm-12" action="{{ route('question.add.tag_category') }}">
                        @csrf
                        <div class="col-md-4 form-group">
                            <input type="hidden" value="{{ $question->id }}" name="question_id">
                            <label>Add A TAG</label>
                            <input type="text" class="form-control" placeholder="Enter a Tag" name="tag"
                                value="{{ $question->tag }}">
                        </div>
                        @php
                        $categories = App\Category::get();
                        @endphp
                        <div class="col-md-4 form-group">
                            <label>Add A Category</label>
                            <select class="form-control" name="attached_category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name_bn }}, {{ $category->name_en }}, {{ $category->name_ar }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-4 form-group">
                            <label>Click to Save Tag and Category </label>
                            <input type="submit" class="btn btn-secondary col-md-12" value="Save">
                        </div>
                    </form>

                </div>

                <div class="col-md-12 space-position p-l-20">

                    <div>
                        <h4 class="" style="margin-left: -4px"><b>Title</b>:
                            <i class="badge custom-badge" style="">id:{{ $question->id }}</i>
                            {{ $question->title }}</h4>
                    </div>

                    <div class="well" style="margin-left: -5px">
                        {{ $question->description }}
                    </div>
                </div>
            </div>
            <br>
            <div class="col-md-12">
                <a href="{{ route('admin.question.answer', $question->id) }}" class="text-blue col-md-4 col-sm-12">Answer
                    this question</a>
            </div>
            <div class="space-position col-md-12" style="padding-bottom: 30px">
                <b>User info</b>
                <h6>Email: <i>{{ $question->created_by == null ? '' : $question->user->email }}</i></h6>
                <h6>Name: <b>{{ $question->created_by == null ? '' : $question->user->name }}</b></h6>
            </div>

        </div>
    </div>
@endsection
