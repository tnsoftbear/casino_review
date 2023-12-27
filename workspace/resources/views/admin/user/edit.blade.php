@extends('admin.layout.default')

@section('content')

  <div class="container mt-4">
    <form id="mainForm" action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
        @csrf
        @method('PUT')

        @section('edit_buttons')
        <div>
            @include('admin.user.edit_buttons')
            <input type="button" class="btn btn-danger" value="Delete" onclick="confirmDelete()">
        </div>
        @show

        @include('admin.user.edit_fields')
    
        @yield('edit_buttons')
    </form>

    <form id="deleteForm" action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST" class="user-action-form">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this user?')) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
  </div>

@endSection