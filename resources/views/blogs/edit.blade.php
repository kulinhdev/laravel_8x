@extends('layouts.app')

@section('content')

<x-nav :title="$title" :page="$page" class="active">
</x-nav>

<div class="bg-white p-5 border border-success">
        <div class="col-md-6">
        <form action="/blogs/{{ $blog->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title :</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}">
            </div>
            <div class="form-group">
                <label for="image">Image: </label>
                <input type="file" class="form-control-file" name="image">
                <span>{{ $blog->image }}</span>
            </div>
            <label for="body">Content: </label>
            <div class="form-group">
                <textarea class="form-control" name="body" id="body" rows="3">{{ $blog->body }}</textarea>
            </div>

            <button class="btn btn-success">Submit !</button>
        </form>
    </div>
</div>

@endsection