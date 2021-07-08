@extends('layouts.app')

@section('content')

<x-nav :title="$title" :page="$page" class="active">
</x-nav>

@if(count($productsDeleted) == 0)
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <span>No products have been deleted yet !</span><a class="ml-3" href="{{ route('products.index') }}">All Products !</a>
</div>
@else

@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ Session::get('success') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="soft-delete bg-light text-center mb-5 pb-2">
    <table class="table table-striped table-bordered table-hover text-center">
        <thead>
            <tr>
                <th><input value="checked" id="select-all" name="select-all" class="form-control w-50 ml-2 pt-0" type="checkbox"></th>
                <th>STT</th>
                <th>Name</th>
                <th>Image</th>
                <th>Category</th>
                <th>Price</th>
                <th>Sale Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productsDeleted as $product)
            <tr>
                <form action="{{ route('products.soft_delete') }}" method="POST">
                    @csrf
                    @method('put')
                    <th width="5%">
                        <input class="form-control w-50 ml-2" 
                        type="checkbox" 
                        value="{{ $product->id }}"
                        name="id-{{ $product->id }}"
                        >
                    </th>
                    <td width="5%">{{ $loop->iteration }}</td>
                    <td width="25%">{{ $product->name }}</td>
                    <td><img width="200px" src="{{ ($product->image) }}" alt=""></td>
                    <td width="15%">{{ $product->category_id }} - {{ $product->category->name }}</td>
                    <td width="15%">{{ $product->price }}</td>
                    <td width="15%">{{ $product->sale_price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="action text-left m-3">
        {{-- Restore and Delete --}}
        <button type="submit" name="action" value="restore" class="btn btn-success m-1">Restore <i class="far fa-trash-undo ml-1"></i></button>
        <button type="submit" name="action" value="delete"class="btn btn-danger m-1">Delete <i class="fal fa-trash-alt ml-1"></i></button>
        </form>
    </div>
    <div>
@endif
@endsection

@include('components.script-slelct-all')