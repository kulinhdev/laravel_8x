@extends('layouts.app')

@section('content')

<x-nav :title="$title" :page="$page" class="active">
</x-nav>

<div class="row my-5">
    {{-- Add new Category --}}
    <div class="col-lg-5">
        <div class="bg-white p-5 border border-success">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name :</label>
                    <input class="form-control @error('name') error @enderror" type="text" id="name" name="name"
                        placeholder="Name Category ..." value="{{ old('name') }}" autofocus>
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="status">Status: </label>
                <select class="form-control" name="status" id="status">
                    <option value="1">Show</option>
                    <option value="0">Hide</option>
                </select>
                <button class="btn btn-success mt-4">
                    Add new !
                </button>
            </form>
        </div>
    </div>
    {{-- Show all Category --}}
    <div class="col-lg-7">

        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        {{-- Show List Category --}}
        <table class="table table-hover table-dark table-bordered text-center">
            <thead>
                <tr>
                    <th width="10%" scope="col">STT</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @if(count($categories) == 0)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <span>No any categories here !</span>
                </div>
                @else

                @foreach ($categories as $category)
                <tr class="{{ $category->status == 1 ? 'bg-success' : 'bg-info' }}">
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->status == 1 ? 'Show' : 'Hide' }}</td>
                    <td>
                        <a class="btn btn-warning btn-md m-2" href="categories/{{ $category->id }}/edit"
                            role="button">Edit <i class="fad fa-edit"></i></a>
                        <form class="d-inline-block" action="/categories/{{ $category->id }}" method="POST">
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
        {{ $categories->links() }}
    </div>
</div>


@endsection