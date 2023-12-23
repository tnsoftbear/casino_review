@extends('admin.layout.default', ['pageTitle' => 'Articles'])

@section('content')

<div class="container mt-4">
    <p><a href="{{ route('article.create') }}" class="btn btn-primary">Create Article</a></p>
    @if (count($articles) == 0) <p>No articles found.</p>
    @else
    <table class="table article-table">
        <thead>
            <tr>
                <th class="col">Name</th>
                <th>Rubric</th>
                <th>Publish Date</th>
                <th class="col-auto">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->name }}</td>
                    <td>{{ config('article.rubric')[(int)$article->rubric_id] }}</td>
                    <td>
                        {{ $article->publish_at }}
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ route('article.show', ['id' => $article->id]) }}" class="btn btn-info btn-sm" target="_blank">Preview</a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('article.edit', ['id' => $article->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                            </div>
                            <div class="col-md-4">
                                <form action="{{ route('article.destroy', ['id' => $article->id]) }}" method="POST" class="article-action-form">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this article?')">
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@endsection