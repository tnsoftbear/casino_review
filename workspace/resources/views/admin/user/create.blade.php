@extends('admin.layout.default')

@section('content')

<div class="container mt-4">
  <form action="{{ route('user.store') }}" method="POST">
    @csrf

    @section('edit_buttons')
    <div>
        @include('admin.user.edit_buttons')
    </div>
    @show

    @include('admin.user.edit_fields')

    @yield('edit_buttons')
  </form>
</div>

@endSection