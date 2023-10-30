@extends('layouts.app-master')

<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
@section('content')
    <div class="bg-light p-5 rounded">
        <h1>Create a New Post</h1>

        {!! Form::open(['route' => 'posts.stored', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('content', 'Content') !!}
            {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'content-editor']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('image', 'Image') !!}
            {!! Form::file('image', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('describe_short', 'Short Description') !!}
            {!! Form::textarea('describe_short', null, ['class' => 'form-control', 'id' => 'content-editor']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('category_id', 'Category') !!}
            {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('status', 'Status') !!}
            <select name="status" class="form-control">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>
        <div id="editor">
            <p>This is some sample content.</p>
        </div>

        <div class="form-group">
            {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                ClassicEditor
                    .create(document.querySelector('#content-editor'))
                    .catch(error => {
                        console.error(error);
                    });
            });
        </script>

        {!! Form::close() !!}
    </div>
@endsection
