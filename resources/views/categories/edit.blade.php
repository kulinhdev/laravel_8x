@extends('layouts.app')

@section('content')

<x-nav :title="$title" :page="$page" class="active">
</x-nav>

<div class="bg-white p-5 border border-success">
    <div class="col-md-6">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name :</label>
                <input class="form-control @error('name') error @enderror" type="text" id="name" name="name"
                    placeholder="Name Category ..." value="{{ $category->name }}" autofocus>
            </div>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="status">Status: </label>
            <select class="form-control" name="status" id="status">
                <option {{ $category->status == 1 ? 'selected' : '' }} value="1">Show</option>
                <option {{ $category->status == 0 ? 'selected': '' }} value="0">Hide</option>
            </select>
            <button class="btn btn-warning mt-4">
                Save change !
            </button>
        </form>
    </div>
</div>

@endsection