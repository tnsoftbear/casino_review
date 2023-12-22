@extends('admin.layout.default')

@section('content')

<div class="container mt-4">
  <form action="{{ route('casino.store') }}" method="POST">
    @csrf

    @section('edit_buttons')
    <div>
        @include('admin.casino.edit_buttons')
    </div>
    @show

    @include('admin.casino.edit_fields')

    @yield('edit_buttons')
  </form>
</div>

@endSection