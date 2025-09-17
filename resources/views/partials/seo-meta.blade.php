{{-- SEO Meta Tags --}}
<title>{{ $metaData['title'] }}</title>
<meta name="description" content="{{ $metaData['description'] }}">
<meta name="keywords" content="{{ $metaData['keywords'] }}">
<meta name="author" content="Miss Helpers">
<meta name="robots" content="index, follow">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

{{-- Canonical URL --}}
<link rel="canonical" href="{{ $metaData['canonical_url'] }}">

{{-- Alternate Language Links --}}
@foreach($metaData['alternate_locales'] as $locale => $url)
<link rel="alternate" hreflang="{{ $locale }}" href="{{ $url }}">
@endforeach
<link rel="alternate" hreflang="x-default" href="{{ $metaData['canonical_url'] }}">

{{-- Open Graph Meta Tags --}}
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $metaData['og_title'] }}">
<meta property="og:description" content="{{ $metaData['og_description'] }}">
<meta property="og:image" content="{{ $metaData['og_image'] }}">
<meta property="og:url" content="{{ $metaData['canonical_url'] }}">
<meta property="og:site_name" content="Miss Helpers">
<meta property="og:locale" content="{{ $metaData['locale'] === 'ar' ? 'ar_AE' : 'en_US' }}">

{{-- Twitter Card Meta Tags --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaData['twitter_title'] }}">
<meta name="twitter:description" content="{{ $metaData['twitter_description'] }}">
<meta name="twitter:image" content="{{ $metaData['twitter_image'] }}">

{{-- Additional Meta Tags --}}
<meta name="theme-color" content="#e91e63">
<meta name="msapplication-TileColor" content="#e91e63">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">

{{-- Schema Markup (JSON-LD) --}}
@if(!empty($metaData['schema_markup']))
<script type="application/ld+json">
{!! json_encode($metaData['schema_markup'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif
