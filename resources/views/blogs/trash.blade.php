@extends('layouts.app')

@section('content')

<x-nav :title="$title" :page="$page" class="active">
</x-nav>

@if(count($blogs) == 0)
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <span>No posts have been deleted yet !</span><a class="ml-3" href="{{ route('blogs.index') }}">All post !</a>
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

<div class="soft-delete bg-light text-center mb-5">
    <table class="table table-striped table-bordered table-hover ">
        <thead>
            <tr>
                <th><input value="checked" id="select-all" name="select-all" class="form-control w-50 ml-2 pt-0" type="checkbox"></th>
                <th>Id</th>
                <th>Title</th>
                <th>Image</th>
                <th>Content</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
            <tr>
                <form action="{{ route('soft_delete') }}" method="POST">
                    @csrf
                    @method('put')
                    <th width="5%"><input class="form-control w-50 ml-2" type="checkbox" value="{{ $blog->id }}"
                            name="id{{ $blog->id }}"></th>
                    <th width="5%" scope="row">{{ $blog->id }}</th>
                    <td width="30%">{{ $blog->title }}</td>
                    <td width="20%"><img class="w-75" src="{{ asset('uploads/'.$blog->image) }}" alt="Image Blogs"></td>
                    <td>{{ $blog->body }}</td>
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

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    
<script>
$(document).ready(function() {
    $("#select-all").click(function (event) {
        if (this.checked) {
            $(":checkbox").each(function () {
            this.checked = true;
        });
        } else {
            $(":checkbox").each(function () {
            this.checked = false;
        });
        }
    });
});
</script>