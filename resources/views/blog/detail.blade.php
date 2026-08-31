@extends('layouts.main.master')

@section('title')

    {{ $blog_detail->seo_title ? $blog_detail->seo_title : languageName($blog_detail->title) }}

@endsection

@section('description')

    {{ $blog_detail->meta_description ? $blog_detail->meta_description : languageName($blog_detail->description) }}

@endsection

@section('image')

    {{ url('' . $blog_detail->image) }}

@endsection

@section('schema')

    @php

        $cleanText = function ($value) {

            $text = (string) $value;

            return preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $text);

        };

        $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;

        $postTitle = $cleanText(languageName($blog_detail->title));

        $postDescription = $cleanText(

            $blog_detail->meta_description ?: strip_tags(languageName($blog_detail->description))

        );

        $postContentText = trim($cleanText(strip_tags(languageName($blog_detail->content))));

        preg_match_all('/[\p{L}\p{N}]+/u', $postContentText, $wordMatches);

        $postWordCount = count($wordMatches[0]);

        $postUrl = url()->current();

        $homeUrl = route('home');

        $categoryUrl = route('listCateBlog', ['slug' => $blog_detail->category]);

        $siteName = $setting->webname ?? ($setting->company ?? 'Website');

        $publisherName = $setting->company ?? $siteName;

        $publisherLogo = !empty($setting->logo) ? url($setting->logo) : url('' . $blog_detail->image);

    @endphp

    <script type="application/ld+json">

{

  "@context": "https://schema.org",

  "@graph": [

    {

      "@type": "WebSite",

      "@id": {!! json_encode(url('/') . '#website', $jsonFlags) !!},

      "url": {!! json_encode(url('/'), $jsonFlags) !!},

      "name": {!! json_encode($siteName, $jsonFlags) !!}

    },

    {

      "@type": "Organization",

      "@id": {!! json_encode(url('/') . '#organization', $jsonFlags) !!},

      "name": {!! json_encode($publisherName, $jsonFlags) !!},

      "url": {!! json_encode(url('/'), $jsonFlags) !!},

      "logo": {

        "@type": "ImageObject",

        "url": {!! json_encode($publisherLogo, $jsonFlags) !!}

      }

    },

    {

      "@type": "BreadcrumbList",

      "@id": {!! json_encode($postUrl . '#breadcrumb', $jsonFlags) !!},

      "itemListElement": [

        {

          "@type": "ListItem",

          "position": 1,

          "name": "Trang chủ",

          "item": {!! json_encode($homeUrl, $jsonFlags) !!}

        },

        {

          "@type": "ListItem",

          "position": 2,

          "name": {!! json_encode($cleanText(languageName($blog_detail->category)), $jsonFlags) !!},

          "item": {!! json_encode($categoryUrl, $jsonFlags) !!}

        },

        {

          "@type": "ListItem",

          "position": 3,

          "name": {!! json_encode($postTitle, $jsonFlags) !!},

          "item": {!! json_encode($postUrl, $jsonFlags) !!}

        }

      ]

    },

    {

      "@type": "BlogPosting",

      "@id": {!! json_encode($postUrl . '#article', $jsonFlags) !!},

      "mainEntityOfPage": {

        "@type": "WebPage",

        "@id": {!! json_encode($postUrl, $jsonFlags) !!}

      },

      "headline": {!! json_encode($postTitle, $jsonFlags) !!},

      "description": {!! json_encode($postDescription, $jsonFlags) !!},

      "articleSection": {!! json_encode($cleanText(languageName($blog_detail->category)), $jsonFlags) !!},

      "keywords": {!! json_encode(implode(', ', $blogTags ?? []), $jsonFlags) !!},

      "inLanguage": "vi-VN",

      "wordCount": {{ $postWordCount }},

      "datePublished": {!! json_encode(optional($blog_detail->created_at)->toIso8601String(), $jsonFlags) !!},

      "dateModified": {!! json_encode(optional($blog_detail->updated_at)->toIso8601String(), $jsonFlags) !!},

      "image": [

        {

          "@type": "ImageObject",

          "url": {!! json_encode(url(''.$blog_detail->image), $jsonFlags) !!}

        }

      ],

      "author": {

        "@type": "Person",

        "name": {!! json_encode($cleanText($blog_detail->author ?: 'Admin'), $jsonFlags) !!}

      },

      "publisher": {

        "@type": "Organization",

        "@id": {!! json_encode(url('/') . '#organization', $jsonFlags) !!}

      }

    }

  ]

}

</script>

@endsection

@section('css')

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ url('frontend/css/blog_article_style.scss.css') }}?v={{ filemtime(public_path('frontend/css/blog_article_style.scss.css')) }}">

@endsection

@section('js')

@endsection

@section('content')

@php

    $postTitle = languageName($blog_detail->title);

    $categoryName = languageName($blog_detail->category);

@endphp

<div class="bodywrap kl-blog kl-blog--detail" itemscope itemtype="https://schema.org/BlogPosting">

  <meta itemprop="headline" content="{{ $postTitle }}">

  <meta itemprop="description" content="{{ languageName($blog_detail->description) }}">



  <section class="kl-blog__hero kl-blog__hero--detail">

    <div class="container">

      <nav class="kl-blog__breadcrumb" aria-label="Breadcrumb">

        <a href="{{ route('home') }}">Trang chủ</a>

        <span>&gt;</span>

        <a href="{{ route('allListBlog') }}">Tin tức</a>

        <span>&gt;</span>

        <a href="{{ route('listCateBlog', ['slug' => $blog_detail->category]) }}">{{ $categoryName }}</a>

        <span>&gt;</span>

        <span>{{ $postTitle }}</span>

      </nav>

    </div>

  </section>



  <div class="blog_wrapper layout-blog layout-article kl-blog__main">

    <div class="container">

      <div class="row kl-blog__layout article-main">

        <div class="right-content col-lg-9 col-12">

          <article class="article-details kl-blog__article clearfix" itemprop="articleBody">

            <h1 class="article-title" itemprop="name">{{ $postTitle }}</h1>



            <div class="posts kl-blog__meta">

              <div class="time-post">

                <svg aria-hidden="true" viewBox="0 0 512 512" width="14" height="14"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-7.1 7.1c-3.1 3.1-8.2 3.1-11.3 0L240 273V136c0-4.4 3.6-8 8-8h16c4.4 0 8 3.6 8 8v118.6l67.1-67.1c3.1-3.1 8.2-3.1 11.3 0l11.3 11.3c3.1 3.1 3.1 8.2 0 11.3z"/></svg>

                <time datetime="{{ optional($blog_detail->created_at)->toIso8601String() }}">{{ date_format($blog_detail->created_at, 'd/m/Y') }}</time>

              </div>

              <div class="time-post">

                <svg aria-hidden="true" viewBox="0 0 448 512" width="14" height="14"><path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg>

                <span itemprop="author">{{ languageName($blog_detail->author ?: 'Admin') }}</span>

              </div>

              {{-- @if (!empty($blogTags))

              <div class="kl-blog__tags">

                @foreach ($blogTags as $tag)

                <a href="{{ route('listBlogTag', ['tag' => urlencode($tag)]) }}" class="kl-blog__tag">#{{ $tag }}</a>

                @endforeach

              </div>

              @endif --}}

            </div>



            @if (!empty($blog_detail->image))

            <figure class="article-image">

              <img src="{{ url($blog_detail->image) }}" alt="{{ $postTitle }}" itemprop="image">

            </figure>

            @endif



            <div class="article-content rte">

              {!! languageName($blog_detail->content) !!}

            </div>



            <div class="share-group kl-blog__share">

              <strong class="share-group__heading">Chia sẻ</strong>

              <div class="share-group__list">

                <a class="share-group__item" title="Chia sẻ lên Facebook" target="_blank" rel="noopener" href="https://www.facebook.com/sharer.php?u={{ urlencode(url()->current()) }}">

                  <img src="{{ url('frontend/images/icon_face.png') }}" alt="Facebook">

                </a>

                <a class="share-group__item" title="Chia sẻ lên Pinterest" target="_blank" rel="noopener" href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}">

                  <img src="{{ url('frontend/images/icon_print.png') }}" alt="Pinterest">

                </a>

                <a class="share-group__item" title="Chia sẻ lên Twitter" target="_blank" rel="noopener" href="https://twitter.com/share?url={{ urlencode(url()->current()) }}">

                  <img src="{{ url('frontend/images/icon_tw.png') }}" alt="Twitter">

                </a>

              </div>

            </div>

          </article>

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

