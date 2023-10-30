@extends('layouts.app-master')

<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

@section('content')
    <div class="bg-light p-5 rounded">
        <h1>Edit Post</h1>

        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', $post->title, ['class' => 'form-control']) !!}
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
            {!! Form::text('describe_short', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('category_id', 'Category') !!}
            {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('status', 'Status') !!}
            <select name="status" class="form-control">
                <option value="draft" @if($post->status == 'draft') selected @endif>Draft</option>
                <option value="published" @if($post->status == 'published') selected @endif>Published</option>
            </select>
        </div>

        <div class="form-group">
            {!! Form::submit('Update Post', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
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
    </html>
