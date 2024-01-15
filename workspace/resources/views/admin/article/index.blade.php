@extends('admin.layout.default', ['pageTitle' => 'Articles'])

@section('content')

<div class="container mt-4">
    <p><a href="{{ route('article.create') }}" class="btn btn-primary">Create Article</a></p>
    @if (count($articles) == 0) <p>No articles found.</p>
    @else
    <table class="table article-table">
        <thead>
            <tr>
                <th>Article</th>
                <th>Rubric</th>
                <th>Publish Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-1">
                                    <strong>Name</strong>
                                </div>
                                <div class="col-11 fs-5">
                                    <div class="d-flex align-items-start">
                                        {{ $article->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-1">
                                    <strong>Slug</strong>
                                </div>
                                <div class="col-11">
                                    <div class="d-flex align-items-start">
                                        <i>{{ $article->slug }}</i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>{{ config('article.rubric')[(int)$article->rubric_id] }}</td>
                    <td>
                        {{ $article->publish_at }}
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ route('article.show', ['article' => $article->id]) }}" class="btn btn-info btn-sm" target="_blank">Preview</a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('article.edit', ['article' => $article->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                            </div>
                            <div class="col-md-4">
                                <form action="{{ route('article.destroy', ['article' => $article->id]) }}" method="POST" class="article-action-form">
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