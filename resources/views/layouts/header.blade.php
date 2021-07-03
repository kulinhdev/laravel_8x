<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Laravel Basic</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
        aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
                <a class="nav-link " href="/">Home</a>
            </li>
            <li class="nav-item {{ request()->is('blogs') ? 'active' : '' }}">
                <a class="nav-link " href="{{ route('blogs.index') }}">Blogs</a>
            </li>
            <li class="nav-item {{ request()->is('blogs/create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('blogs.create') }}">Add Blogs</a>
            </li>
            <li class="nav-item {{ request()->is('trash') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('trash') }}">Trashs</a>
            </li>

        </ul>
    </div>
    <div class="right-part">
        <ul class="navbar-nav">
            @if (Auth::user())
            <li class="nav-item active">
                <span class="nav-link mr-3" style="cursor: pointer">Phạm Ngọc Linh</span>
            </li>
            <li class="nav-item active">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            </li>
            @else
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            @endif
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