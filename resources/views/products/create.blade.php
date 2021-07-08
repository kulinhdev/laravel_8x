@extends('layouts.app')

@section('content')

<x-nav :title="$title" :page="$page" class="active">
</x-nav>

{{-- Alert --}}
@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ Session::get('success') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="bg-white p-5 my-5">
    {{-- Add new Product --}}
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                {{-- Name --}}
                <div class="form-group">
                    <label for="name">Name :</label>
                    <input class="form-control @error('name') error @enderror" type="text" id="name" name="name"
                        placeholder="Name Product ..." value="{{ old('name') }}" autofocus>
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                {{-- Image --}}
                <div class="form-group">
                    <label for="image">Image: </label>
                    {{ old('image') }}
                    <input type="file" class="form-control-file @error('image') error @enderror" name="image">
                </div>
                @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <button class="btn btn-success mt-4 p-3">
                    Add New Product !
                </button>

            </div>
            <div class="col-sm-6">
                {{-- Category --}}
                <div class="form-group">
                    <label for="status">Category: </label>
                    <select class="form-control" name="category_id" id="status">
                        @foreach ($allCategory as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Price --}}
                <div class="form-group">
                    <label for="price">Price :</label>
                    <input class="form-control @error('price') error @enderror" type="number" id="price" name="price"
                        placeholder="Price ..." value="{{ old('price') }}">
                </div>
                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                {{-- Sale Price --}}
                <div class="form-group">
                    <label for="price">Sale Price :</label>
                    <input class="form-control @error('sale_price') error @enderror" type="number" id="price"
                        name="sale_price" placeholder="Sale Price ..." value="{{ old('sale_price') }}">
                </div>
                @error('sale_price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </form>
</div>

@endsection