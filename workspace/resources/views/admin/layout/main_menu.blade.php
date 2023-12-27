  <nav class="navbar navbar-expand-sm bg-primary-subtle">
    <div class="container-fluid">
      <span class="navbar-brand">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dice-5" viewBox="0 0 16 16">
          <path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3z"/>
          <path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m4-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
        </svg>
      </span>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
@php
[$startsWith,] = explode('.', Route::currentRouteName());
@endphp
          @foreach(config('admin.menu') as $id => [$name, $route])
@php
$active = $ariaCurrent = '';
if (str_starts_with($route, $startsWith)) {
    $active = 'active';
    $ariaCurrent = 'aria-current="page"';
}
@endphp
          <li class="nav-item">
            <a class="nav-link {{ $active }}" {!! $ariaCurrent !!}
                href="{{ route($route) }}">{{ $name }}</a>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </nav>