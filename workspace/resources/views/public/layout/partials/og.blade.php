    <meta property="og:locale" content="{{ config('app.locale') }}">
    <meta property="og:type" content="@if (!empty($ogType)) {{ $ogType }} @else{{ 'article' }}@endif">
    <meta property="og:title" content="{{ __('global.meta.og.title') }}">
    <meta property="og:description" content="{{ __('global.meta.og.description') }}">
    <meta property="og:url" content="{!! config('public.global.site_url') !!}">
    <meta property="og:site_name" content="{{ __('global.meta.og.site_name') }}">
    <meta property="og:image" content="{!! config('public.global.og_image_url') !!}">
