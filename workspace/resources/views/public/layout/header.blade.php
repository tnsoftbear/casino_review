<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $siteTitle }} - {{ $pageTitle }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $metaDescription }}">
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

<!-- Контент -->
<div class="container mt-4">
    <div class="row">
