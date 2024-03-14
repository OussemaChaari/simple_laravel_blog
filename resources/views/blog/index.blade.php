@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between mt-4 mb-2">
        <h2 class="text-center font-weight-bolder">جميع الموضوعات</h2>
        @if(Auth::check())
        <a href="/blog/create" class="btn btn-outline-secondary">اضف موضوع جديد</a>
        @endif
    </div>
    @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="{{ asset('uploads/' . $post->image_path) }}" alt="Post Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <span>Created By : {{ $post->user->name }}</span>
                    <p class="card-text">{{ $post->description }}</p>
                    <div class="d-flex justify-content-between align-items-center">

                        <a href="/blog/{{ $post->slug }}" class="btn btn-outline-secondary">Read More</a>
                        <form action="/blog/{{ $post->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" onclick="confirmDelete({{ $post->id }})">Delete</button>
                        </form>

                        <!-- this function diffForHumans () is used to display the time in a more human readable format  -->
                        <!-- <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small> -->
                        <small class="text-muted">{{ $post->created_at->format('d-m-Y H:i') }}</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
<script>
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this post?')) {
            document.getElementById('deleteForm-' + id).submit();
        }
    }
</script>