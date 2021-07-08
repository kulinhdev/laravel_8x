@extends('layouts.app')

@section('content')

<x-nav :title="$title" :page="$page" class="active">
</x-nav>

<div class="bg-white p-5 border border-success">
    <div class="col-md-6">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title :</label>
                <input class="form-control @error('title') error @enderror" type="text"id="title" name="title" placeholder="Title ..." value="{{ old('title') }}" autofocus>
            </div>
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="image">Image: </label>
                {{ old('image') }}
                <input type="file" class="form-control-file @error('image') error @enderror" name="image">
            </div>
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="body">Content: </label>
            <div class="form-group">
                <textarea class="form-control @error('body') error @enderror" name="body" id="body" rows="3" placeholder="Content ...">{{ old('body') }}</textarea>
            </div>
            @error('body')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button class="btn btn-success">Submit !</button>
        </form>
    </div>
</div>

@endsection