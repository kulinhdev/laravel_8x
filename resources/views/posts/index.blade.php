@extends('layouts.app')

@section('content')

<x-nav :title="$title" :page="$page" class="active">
</x-nav>

@if(count($posts) == 0)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <span>No posts yet !</span><a class="ml-3" href="{{ route('posts.create') }}">More posts here!</a>
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

@foreach ($posts as $post)
<div class="jumbotron p-5 my-5">
    {{-- Image --}}
    <img class="mt-3 mr-3 float-left" width="250px" height="150px" src="{{ asset('uploads/posts/'.$post->image) }}"
        alt="Image Blogs">
    {{-- Title --}}
    <h3 class="display-4"><a href="posts/{{ $post->id }}">{{ $post->title }}</a></h3>
    {{-- Content --}}
    <p class="lead">{{ Str::limit($post->body, 30, '...') }}</p>
    {{-- Action --}}
    <div class="lead mt-3">
        <a class="btn btn-warning btn-md m-2" href="posts/{{ $post->id }}/edit" role="button">Edit <i
                class="fad fa-edit"></i></a>
        <form class="d-inline-block" action="/posts/{{ $post->id }}" method="POST">
            @csrf
            @method('delete')
            <button class="btn btn-danger btn-md m-2" type="submit">Delete <i
                    class="fal fa-trash-alt pl-1"></i></button>
        </form>
    </div>
    <hr>
</div>
@endforeach
@endif
@endsection