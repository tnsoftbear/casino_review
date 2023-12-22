@extends('admin.layout.default')

@section('content')

  <div class="container mt-4">
    <form id="mainForm" action="{{ route('casino.update', ['id' => $id]) }}" method="POST">
        @csrf
        @method('PUT')

        @section('edit_buttons')
        <div>
            @include('admin.casino.edit_buttons')
            <input type="button" class="btn btn-danger" value="Delete" onclick="confirmDelete()">
        </div>
        @show

        @include('admin.casino.edit_fields')
    
        @yield('edit_buttons')
    </form>

    <form id="deleteForm" action="{{ route('casino.destroy', ['id' => $id]) }}" method="POST" class="casino-action-form">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this casino?')) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
  </div>

@endSection