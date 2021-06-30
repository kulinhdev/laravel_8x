@extends('layouts.app')

@section('content')

<x-nav :title="$title" :page="$page" class="active">
</x-nav>

@foreach ($blogs as $blog)
<div class="jumbotron p-5 my-5">
    <img class="mt-3 mr-3 float-left" width="250px" height="150px" src="{{ asset('images/'.$blog->image) }}"
        alt="Image Blogs">
    <h3 class="display-4"><a href="blog/{{ $blog->id }}">{{ $blog->title }}</a></h3>
    <p class="lead">{{ $blog->body }}</p>
    <div class="lead mt-3">
        <a class="btn btn-warning btn-md m-2" href="blogs/{{ $blog->id }}/edit" role="button">Edit <i
                class="fad fa-edit"></i></a>
        <form class="d-inline-block" action="/blogs/{{ $blog->id }}" method="POST">
            @csrf
            @method('delete')
            <button class="btn btn-danger btn-md m-2" type="submit">Delete <i class="fal fa-trash-alt pl-1"></i></button>
        </form>
    </div>
    <hr>
</div>
@endforeach

<div class="pagination my-5">
</div>
@endsection