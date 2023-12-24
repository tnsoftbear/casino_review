@extends('admin.layout.default')

@section('content')

  <div class="container mt-4">
    <form id="mainForm" action="{{ route('article.update', ['article' => $article->id]) }}" method="POST">
        @csrf
        @method('PUT')

        @section('edit_buttons')
        <div>
            @include('admin.article.edit_buttons')
            <input type="button" class="btn btn-danger" value="Delete" onclick="confirmDelete()">
        </div>
        @show

        @include('admin.article.edit_fields')
    
        @yield('edit_buttons')
    </form>

    <form id="deleteForm" action="{{ route('article.destroy', ['article' => $article->id]) }}" method="POST" class="article-action-form">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this article?')) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
  </div>

@endSection