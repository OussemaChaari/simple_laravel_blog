@extends('layouts.app')
@section('content')
<div class="container mb-4">
    <div class="d-flex align-items-center justify-content-between mt-4 mb-2">
        <h2 class="font-weight-bolder mx-auto">اضف موضوع جديد</h2>
    </div>
    <form action="/blog" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <input type="text" class="form-control mb-2" name="title" id="title">

        <textarea class="form-control mb-2" name="description" rows="3"></textarea>

        <input type="file" class="form-control mb-2" name="image">

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection