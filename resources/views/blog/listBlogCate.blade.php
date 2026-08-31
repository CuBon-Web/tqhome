@extends('layouts.main.master')
@section('title')
{{$title_page}} 
@endsection
@section('description')
{{$title_page}} 
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('schema')
@php
    $cleanText = function ($value) {
        $text = (string) $value;
        return preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $text);
    };
    $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
    $currentUrl = url()->current();
    $homeUrl = route('home');
    $siteUrl = url('/');
    $categoryUrl = route('listCateBlog', ['slug' => $cate_name]);
    $pageTitle = $cleanText($title_page);
    $siteName = $cleanText($setting->webname ?? $setting->company ?? $title_page);
    $publisherName = $cleanText($setting->company ?? $siteName);
    $publisherLogo = !empty($setting->logo)
        ? url($setting->logo)
        : (!empty($banner[0]->image) ? url($banner[0]->image) : null);

    $itemListElements = [];
    foreach ($blog as $index => $item) {
        $postUrl = route('detailBlog', ['slug' => $item->slug]);
        $postImage = !empty($item->image) ? url($item->image) : null;
        $itemListElements[] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'url' => $postUrl,
            'item' => array_filter([
                '@type' => 'BlogPosting',
                'headline' => $cleanText(languageName($item->title)),
                'description' => $cleanText(strip_tags(languageName($item->description))),
                'datePublished' => optional($item->created_at)->toIso8601String(),
                'image' => $postImage,
                'mainEntityOfPage' => $postUrl,
            ], function ($value) {
                return !is_null($value) && $value !== '';
            }),
        ];
    }

    $schemaGraph = [
        [
            '@type' => 'WebSite',
            '@id' => $siteUrl . '#website',
            'url' => $siteUrl,
            'name' => $siteName,
            'inLanguage' => 'vi-VN',
        ],
        array_filter([
            '@type' => 'Organization',
            '@id' => $siteUrl . '#organization',
            'name' => $publisherName,
            'url' => $siteUrl,
            'logo' => $publisherLogo ? [
                '@type' => 'ImageObject',
                'url' => $publisherLogo,
            ] : null,
        ], function ($value) {
            return !is_null($value) && $value !== '';
        }),
        [
            '@type' => 'BreadcrumbList',
            '@id' => $currentUrl . '#breadcrumb',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Trang chủ',
                    'item' => $homeUrl,
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => $pageTitle,
                    'item' => $categoryUrl,
                ],
            ],
        ],
        [
            '@type' => 'CollectionPage',
            '@id' => $currentUrl . '#collection',
            'url' => $currentUrl,
            'name' => $pageTitle,
            'description' => $pageTitle,
            'inLanguage' => 'vi-VN',
            'isPartOf' => [
                '@type' => 'WebSite',
                '@id' => $siteUrl . '#website',
            ],
        ],
        [
            '@type' => 'ItemList',
            '@id' => $currentUrl . '#itemlist',
            'name' => $pageTitle,
            'numberOfItems' => count($itemListElements),
            'itemListElement' => $itemListElements,
        ],
    ];
@endphp
<script type="application/ld+json">{!! json_encode(['@context' => 'https://schema.org', '@graph' => $schemaGraph], $jsonFlags) !!}</script>
@endsection
@section('css')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ url('frontend/css/paginate.scss.css') }}">
<link rel="stylesheet" href="{{ url('frontend/css/blog_article_style.scss.css') }}?v={{ filemtime(public_path('frontend/css/blog_article_style.scss.css')) }}">
@endsection
@section('js')
@endsection
@section('content')
<div class="bodywrap kl-blog" itemscope itemtype="https://schema.org/Blog">
  <meta itemprop="name" content="{{ $title_page }}">
  <meta itemprop="description" content="{{ $title_page }}">

  <section class="kl-blog__hero">
    <div class="container">
      <nav class="kl-blog__breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Trang chủ</a>
        <span>&gt;</span>
        <a href="{{ route('allListBlog') }}">Tin tức</a>
        <span>&gt;</span>
        <span>{{ $title_page }}</span>
      </nav>
      <h1 class="kl-blog__title">{{ $title_page }}</h1>
    </div>
  </section>

  <div class="blog_wrapper layout-blog kl-blog__main">
    <div class="container">
      <div class="row kl-blog__layout">
        <div class="right-content col-lg-9 col-12">
          <div class="list-blogs">
            <div class="row row-fix kl-blog__grid">
              @foreach ($blog as $item)
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 col-fix">
                <article class="item-blog">
                  <div class="block-thumb">
                    <a class="thumb" href="{{ route('detailBlog', ['slug' => $item->slug]) }}" title="{{ languageName($item->title) }}">
                      <img width="600" height="380" class="lazyload" src="{{ url('frontend/images/lazy.png') }}" data-src="{{ url($item->image) }}" alt="{{ languageName($item->title) }}">
                    </a>
                    <div class="day_time">
                      <span class="day_item">{{ date_format($item->created_at, 'd') }}</span>
                      <span class="myear_item">{{ date_format($item->created_at, 'm/Y') }}</span>
                    </div>
                  </div>
                  <div class="block-content">
                    <h3>
                      <a href="{{ route('detailBlog', ['slug' => $item->slug]) }}" title="{{ languageName($item->title) }}">{{ languageName($item->title) }}</a>
                    </h3>
                    <p class="justify">{!! languageName($item->description) !!}</p>
                  </div>
                </article>
              </div>
              @endforeach
            </div>
            <div class="text-center kl-blog__pagination">
              <nav class="clearfix relative nav_pagi w_100">
                {{ $blog->links() }}
              </nav>
            </div>
          </div>
        </div>

        <aside class="blog_left_base col-lg-3 col-12">
          <div class="aside-blog-right">
            <div class="blog_noibat">
              <h2 class="h2_sidebar_blog">
                <span>Bài viết mới</span>
              </h2>
              <div class="blog_content">
                @foreach ($blognew as $item)
                <div class="item clearfix">
                  <div class="post-thumb">
                    <a class="image-blog scale_hover" href="{{ route('detailBlog', ['slug' => $item->slug]) }}" title="{{ languageName($item->title) }}">
                      <img width="600" height="380" class="img_blog lazyload" src="{{ url('frontend/images/lazy.png') }}" data-src="{{ url($item->image) }}" alt="{{ languageName($item->title) }}">
                    </a>
                  </div>
                  <div class="contentright">
                    <h3>
                      <a title="{{ languageName($item->title) }}" href="{{ route('detailBlog', ['slug' => $item->slug]) }}">{{ languageName($item->title) }}</a>
                    </h3>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
</div>
@endsection
