<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item {{ $attributes['class'] }}" name="{{ $attributes['name'] }}">{{ $page }}</li>
  </ol>
</nav>
<span>{{ $description ?? '' }}</span>
<p>{{ $slot }}</p>