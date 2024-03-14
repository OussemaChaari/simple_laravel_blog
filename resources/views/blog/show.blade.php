@extends('layouts.app')
@section('content')

<div class="container">
 
@if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <div class="d-flex align-items-center justify-content-between mt-4 mb-2">
        <h2 class="font-weight-bolder mx-auto">{{ $post->title }}</h2>
    </div>
    @if(Auth::user() &&  Auth::user()->id == $post->user_id)
    <a href="/blog/{{ $post->slug }}/edit" class="btn btn-outline-secondary">Edit</a>
    @endif
    <div class="mb-2 d-flex align-items-center justify-content-between">
        <span>Created By : {{ $post->user->name }}</span>
        <small class="text-muted">{{ $post->created_at->format('d-m-Y H:i') }}</small>
    </div>
    <img class="card-img-top" src="{{ asset('uploads/' . $post->image_path) }}" alt="{{ $post->slug }}">
    <p class="mt-4">
        {{ $post->description }}
    </p>
</div>
@endsection