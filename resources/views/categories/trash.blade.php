@extends('layouts.app')

@section('content')

<x-nav :title="$title" :page="$page" class="active">
</x-nav>

@if(count($categoriesDeleted) == 0)
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <span>No categories have been deleted yet !</span><a class="ml-3" href="{{ route('categories.index') }}">All Categories !</a>
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

<div class="soft-delete bg-light my-5 pb-3">
    <table class="table table-bordered table-hover text-center">
        <thead>
            <tr>
                <th>
                    <input value="checked" id="select-all" name="select-all" class="form-control w-50 ml-3 pt-0"
                        type="checkbox">
                </th>
                <th>STT</th>
                <th>Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categoriesDeleted as $category)
            <tr class="{{ $category->status == 1 ? 'bg-success' : 'bg-info' }}">
                <form action="{{ route('categories.soft_delete') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <th width="5%">
                        <input class="form-control w-50 ml-3" type="checkbox" value="{{ $category->id }}"
                            name="id-{{ $category->id }}">
                    </th>
                    <th width="5%" scope="row">{{ $loop->iteration }}</th>
                    <td width="30%">{{ $category->name}}</td>
                    <td width="20%">{{ $category->status == 1 ? 'Show' : 'Hide' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="action text-left m-3">
        {{-- Action --}}

        <button type="submit" name="action" value="restore" class="btn btn-success m-1">Restore <i
                class="far fa-trash-undo ml-1"></i></button>
        <button type="submit" name="action" value="delete" class="btn btn-danger m-1">Delete <i
                class="fal fa-trash-alt ml-1"></i></button>
        </form>
        {{-- End Form --}}
    </div>
    <div>
@endif
@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>

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
@endpush