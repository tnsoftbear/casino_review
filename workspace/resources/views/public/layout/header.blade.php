<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@if (!empty($meta['title'])) {{ $meta['title'] }} @else {{ __('global.site_title') }} @endif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@if (!empty($meta['description'])) {{ $meta['description'] }} @else {{ __('global.site_description') }} @endif">
    <meta name="keywords" content="@if (!empty($meta['keywords'])) {{ $meta['keywords'] }} @else {{ __('global.site_keywords') }} @endif">
    <meta name="referrer" content="strict-origin-when-cross-origin" />
    @include('public.layout.partials.twitter')
    @include('public.layout.partials.og')
    @include('public.layout.partials.icon')
    {!! config('app.bootstrap_css_link') !!}
    {!! config('app.bootstrap_js_script') !!}
    {!! config('app.preconnect_link') !!}
</head>
<body>

<!-- Заголовок -->
<header class="bg-dark text-white text-center">
    @include('public.layout.partials.navbar')
</header>

