<h1 class="text-center my-4">{{ $title }}</h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb py-3">
    @if ($page !== 'Home')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    @endif
    <li class="breadcrumb-item {{ $attributes['class'] }}">{{ $page }}</li>
  </ol>
</nav>