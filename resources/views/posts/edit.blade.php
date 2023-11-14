@extends('layouts.app-update')
@section('title','Blog-Edit-Post')
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
@section('content')
    <script>
        function displayImage(input) {
            var preview = document.getElementById('image-preview');
            var file = input.files[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

    <div class="bg-light p-5 rounded">
        <h1 class="h1-title">Edit Post</h1>

        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
            @if($errors->has('title'))
                <div class="alert alert-danger">{{ $errors->first('title') }}</div>
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('content', 'Content') !!}
            {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'content-editor']) !!}
            @if($errors->has('content'))
                <div class="alert alert-danger">{{ $errors->first('content') }}</div>
            @endif
        </div>

        <div class="col-md-12">
            {!! Form::label('image', 'Image') !!}
            {!! Form::file('image', ['class' => 'form-control', 'onchange' => 'displayImage(this)']) !!}
            @if ($post->image_path)
                <img id="image-preview" src="{{ $post->image_path ? asset($post->image_path) : '#' }}"
                     alt="Image Preview"
                     class="img-thumbnail" style="max-width: 100px;">
            @else
                <img id="image-preview" src="{{ asset('images/default_image.jpg') }}"
                     alt="Default Image"
                     class="img-thumbnail" style="max-width: 100px;">
            @endif
            @if($errors->has('image'))
                <div class="alert alert-danger">{{ $errors->first('image') }}</div>
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('describe_short', 'Short Description') !!}
            {!! Form::text('describe_short', null, ['class' => 'form-control']) !!}
            @if($errors->has('describe_short'))
                <div class="alert alert-danger">{{ $errors->first('describe_short') }}</div>
            @endif
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
            {!! Form::submit('Update Post', ['class' => 'btn btn-primary fa fa-pencil-square']) !!}
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
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
