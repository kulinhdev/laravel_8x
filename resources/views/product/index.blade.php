@extends('layouts.app')

@section('content')
    <x-nav :page="$page" class="active" name="curent-page">
        <x-slot name="description">
            Slot here: This is slot description !
        </x-slot>
        Outside Tag: NavPage nè !
    </x-nav>
    <h2 class="my-4">List Products</h2>
    <table class="table table-bordered text-center table-hover">
        <thead>
          <tr>
            <th>STT</th>
            <th>Name</th>
            <th>Price</th>
            <th>Sale Price</th>
            <th>Category Id</th>
            <th>Status</th>
            <th>Created Time</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $key => $product)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->sale_price }}</td>
            <td>{{ $product->category_id }}</td>
            <td>{{ $product->status }}</td>
            <td>{{ $product->created_date }}</td>
          </tr>
          @endforeach
        </tbody>
    </table>

    <div class="pagination my-5">
      {{-- {{ $products->links() }} --}}
    </div>
@endsection
