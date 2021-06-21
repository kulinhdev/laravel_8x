@extends('layouts.app')

@section('content')
    <x-nav page="Category" class="active"/>
    <h2 class="my-4">List Categories</h2>
    <div class="row">
        <div class="col-lg-8">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cats as $key => $cat)
                    <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
        </div>
    </div>
@endsection

