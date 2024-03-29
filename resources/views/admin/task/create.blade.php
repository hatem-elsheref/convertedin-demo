@extends('layouts.master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container">
        <p style="text-align: left">Add New Task</p>

        <form method="post" action="{{route('admin.tasks.store')}}">
            @csrf
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" required name="title" id="title" placeholder="Enter Title" value="{{old('title')}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="admin">Admin Name</label>
                        <select class="form-control" name="assigned_by_id" id="admin" required>
                            <option disabled selected>__</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="user">Assigned  Name</label>
                        <select class="form-control" name="assigned_to_id" id="user" required>
                            <option disabled selected>__</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" required placeholder="Task Description" id="description" name="description"  rows="3">{{old('description')}}</textarea>
                    </div>
                </div>
                <div class="col-sm-12 mt-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#admin').select2({
                ajax: {
                    url: '{{route('admin.users.index', 'admin')}}',
                    dataType: 'json'
                }
            });
            $('#user').select2({
                ajax: {
                    url: '{{route('admin.users.index', 'user')}}',
                    dataType: 'json'
                }
            });
        });
    </script>
@endsection
