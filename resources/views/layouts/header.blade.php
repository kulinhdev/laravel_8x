<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Laravel Basic</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
        aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <a class="nav-link " href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item {{ request()->is('/add') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('blogs.create') }}">Add Blogs</a>
            </li>
        </ul>
    </div>
</nav>

<style>
    .active {
        color: rgb(37, 31, 43);
        font-weight: 500 !important;
        font-size: 16px;
    }

</style>
