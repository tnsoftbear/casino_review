@extends('public.layout.default', [
    'pageTitle' => $article['name'],
    'meta' => $article['meta'],
])

@section('content')

<h1>{!! $article['name'] !!}</h1>
<div>
{!! $article['content'] !!}
<p>{{ $article['author'] }}</p>
</div>

@endsection