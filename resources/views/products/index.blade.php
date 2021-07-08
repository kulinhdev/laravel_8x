@extends('layouts.app')

@section('content')

<x-nav :title="$title" :page="$page" class="active">
</x-nav>

<div class="row my-12">
    <div class="col-lg-12 mt-4">

        {{-- Alert --}}
        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        {{-- Show List Products --}}
        <table class="table table-bordered text-center table-hover table-dark">
            <thead>
                <tr>
                    <th width="10%" scope="col">STT</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Sale Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @if(count($products) == 0)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <span>No any products here !</span>
                </div>
                @else

                @foreach ($products as $product)
                <tr>
                    <th width="5%">{{ $loop->iteration }}</th>
                    <td width="25%"><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></td>
                    <td><img width="200px" src="{{ ($product->image) }}" alt="" srcset=""></td>
                    <td width="15%">{{ $product->category_id }} - {{ $product->category->name }}</td>
                    <td width="15%">{{ $product->price }}</td>
                    <td width="15%">{{ $product->sale_price }}</td>

                    {{-- Action --}}
                    <td width="15%">
                        <a class="btn btn-warning btn-md m-2" href="products/{{ $product->id }}/edit" role="button">Edit
                            <i class="fad fa-edit"></i></a>
                        <form class="d-inline-block" action="/products/{{ $product->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-md m-2" type="submit">Delete <i
                                    class="fal fa-trash-alt pl-1"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @endif
            </tbody>
        </table>

        {{-- Paginate --}}
        {{ $products->links() }}
    </div>
</div>
</div>


@endsection