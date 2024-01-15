    <meta property="og:locale" content="{{ config('app.locale') }}">
    <meta property="og:type" content="@if (!empty($ogType)) {{ $ogType }} @else{{ 'article' }}@endif">
    <meta property="og:title" content="{{ __('global.meta.og.title') }}">
    <meta property="og:description" content="{{ __('global.meta.og.description') }}">
    <meta property="og:url" content="{!! config('public.global.site_url') !!}">
    <meta property="og:site_name" content="{{ __('global.meta.og.site_name') }}">
    <meta property="og:image" content="{!! config('public.global.og_image_url') !!}">
@if (empty($ogType) || $ogType == 'article')
  @if (!empty($meta['article_published_time']))
    <meta property="article:published_time" content="{!! $meta['article_published_time'] !!}" />
  @endif
  @if (!empty($meta['article_modified_time']))
    <meta property="article:modified_time" content="{!! $meta['article_modified_time'] !!}" />
  @endif
  @if (!empty($meta['article_expiration_time']))
    <meta property="article:expiration_time" content="{!! $meta['article_expiration_time'] !!}" />
  @endif
  @if (!empty($meta['article_author']))
    <meta property="article:author" content="{!! $meta['article_author'] !!}" />
  @endif
  @if (!empty($meta['article_section']))
    <meta property="article:section" content="{!! $meta['article_section'] !!}" />
  @endif
  @if (!empty($meta['article_tag']))
    <meta property="article:tag" content="{!! $meta['article_tag'] !!}" />
  @endif
@endif