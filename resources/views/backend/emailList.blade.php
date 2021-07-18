@extends('backend.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row space-position">
            <div class="col-md-12">
               
                <div class="white-box">
                    <h3 >Emails </h3>
                    <table class="table  table-bordered">
                        <thead>
                            <th>Subject</th>
                            <th>Body</th>
                            <th>Sender</th>
                            <th>Time</th>
                        </thead>
                        <tbody>
                            @foreach($emails as $email)
                            <tr>
                            <td nowrap> {{ $email->subject }}</td>
                            <td> <p>{{ $email->body }}</p></td>
                            <td> {{$email->user->name}} </td>
                            <td nowrap> {{$email->created_at->format('d-M-Y')}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $emails->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

