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
    {{-- Add new Category --}}
    <form action="{{ route('products.update', $editProduct->id ) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-sm-6">
                {{-- Name --}}
                <div class="form-group">
                    <label for="name">Name :</label>
                    <input class="form-control @error('name') error @enderror" type="text" id="name" name="name"
                        placeholder="Name Product ..." value="{{ old('name') ?? $editProduct->name }}" autofocus>
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                {{-- Image --}}
                <div class="form-group">
                    <label for="image">Image: </label>
                    <input type="file" class="form-control-file @error('image') error @enderror" name="image"
                        id="image">
                </div>
                {{ $editProduct->image }}
                @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <button class="btn btn-warning mt-3 p2">
                    Update Product !
                </button>

            </div>
            <div class="col-sm-6">
                {{-- Category --}}
                <div class="form-group">
                    <label for="status">Category: </label>
                    <select class="form-control" name="category_id" id="status">
                        @foreach ($allCategory as $category)
                        <option
                            {{ (old('category_id') ?? $editProduct->category_id) == $category->id ? 'selected' : '' }}
                            value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Price --}}
                <div class="form-group">
                    <label for="price">Price :</label>
                    <input class="form-control @error('price') error @enderror" type="number" id="price" name="price"
                        placeholder="Price ..." value="{{ old('price') ?? $editProduct->price }}">
                </div>
                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                {{-- Sale Price --}}
                <div class="form-group">
                    <label for="sale_price">Sale Price :</label>
                    <input class="form-control @error('sale_price') error @enderror" type="number" id="sale_price"
                        name="sale_price" placeholder="Sale Price ..."
                        value="{{ old('sale_price') ?? $editProduct->sale_price }}">
                </div>
                @error('sale_price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </form>
</div>

@endsection