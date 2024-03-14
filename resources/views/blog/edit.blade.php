@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between mt-4 mb-2">
        <h2 class="font-weight-bolder mx-auto">Edit</h2>
    </div>
    <form action="/blog/{{ $post->slug }}" method="POST" enctype="multipart/form-data" class="mb-2">
        @csrf
        @method('PUT')
        <input type="text" class="form-control mb-2" name="title" id="title" value="{{ $post->title }}">
        <textarea class="form-control mb-2" name="description" rows="3">{{ $post->description }}</textarea>
        <img class="card-img-top" src="{{ asset('uploads/' . $post->image_path) }}" alt="{{ $post->slug }}">
        <input type="file" class="form-control mb-2" name="image">
        <button type="submit" class="btn btn-primary">updated</button>
    </form>
</div>
@endsection