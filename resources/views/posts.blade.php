@extends('layouts.app')
@section('title', 'Blog Posts')
@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Post
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                @include('common.errors')

                <!-- New Task Form -->
                    <form action="{{ url('post')}}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <!-- Post Name -->
                        <div class="form-group">
                            <label for="post-title" class="col-sm-3 control-label">Title</label>

                            <div class="col-sm-6">
                                <input type="text" name="title" id="post-title" class="form-control" value="{{ old('post') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="post-description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-6">
                                <textarea name="description" id="post-description" class="form-control" value="{{ old('post') }}"></textarea>
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($posts) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Posts
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                            <th>Title</th>
                            <th>Description</th>
                            <th>&nbsp;</th>
                            </thead>
                            <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td class="table-text"><div>{{ $post->title }}</div></td>
                                    <td class="table-text"><div>{{ $post->description }}</div></td>

                                    <!-- Task Delete Button -->
                                    <td>
                                        <form action="{{ url('post/'.$post->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection