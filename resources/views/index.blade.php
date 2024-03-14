@extends('layouts.app')
@section('content')
<div class="bg_block">
    <h1>Welcome To My Blog</h1>
    <a href="/blog" class="uppercase btn btn-primary">Start Reading</a>
</div>
<div class="container">

    <div class="mb-2 mt-4">
        <h2>Recent Posts</h2>
        <div class="col-md-12 d-flex align-items-center">
        @foreach($posts as $post)
            <div class="col-md-4 card" style="margin-left:15px;" >
                <img class="card-img-top" src="{{ asset('uploads/' . $post->image_path) }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection