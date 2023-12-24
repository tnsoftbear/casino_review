@extends('admin.layout.default')

@section('content')

<div class="container mt-4">
  <form action="{{ route('article.store') }}" method="POST">
    @csrf

    @section('edit_buttons')
    <div>
        @include('admin.article.edit_buttons')
    </div>
    @show

    @include('admin.article.edit_fields')

    @yield('edit_buttons')
  </form>
</div>

@endSection