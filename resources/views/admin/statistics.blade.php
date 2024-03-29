@extends('layouts.master')

@section('content')
    <div class="container">
        <p style="text-align: left">Statistics</p>
        <table class="table table-light table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Tasks Count</th>
                </tr>
                @foreach($topUsers as $index => $user)
                    <tr>
                        <td>{{$index + 1 }}</td>
                        <td>{{$user->user->name}}</td>
                        <td>{{$user->total_tasks}}</td>
                    </tr>
                @endforeach
            </thead>
        </table>
    </div>
@endsection

