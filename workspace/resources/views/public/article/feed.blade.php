@extends('public.layout.default', ['pageTitle' => __('article.feed.page_title')])

@section('content')

@foreach ($articles as $article)

    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $article['name'] }}</h5>
                <p class="card-text">{{ $article['teaser'] }}</p>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="d-flex justify-content-between align-items-center">
                <span>{{ $article['author'] }}</span>
                <span>{{ $article['when'] }}</span>
            </div>
        </div>
    </div>

@endforeach

@endsection