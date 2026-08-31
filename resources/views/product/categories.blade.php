@extends('layouts.main.master')
@section('title')
    Sản phẩm
@endsection
@section('description')
    Kỳ Linh Food cung cấp đa dạng thực phẩm tươi ngon, rõ nguồn gốc – An toàn – Chất lượng.
@endsection
@section('css')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
@endsection
@section('js')
@endsection
@section('content')
@php
    $categories = $categoryhome ?? collect();


    $heroImage = null;
    if (isset($banner) && $banner->isNotEmpty() && !empty($banner->first()->image)) {
        $heroImage = $banner->first()->image;
    }
    if (!$heroImage) {
        foreach ($categories as $category) {
            $heroImage = $resolveCateImage($category);
            if ($heroImage) {
                break;
            }
        }
    }
@endphp
<div class="bodywrap kl-products">
    <section class="kl-products__hero">
        <div class="kl-products__hero-slide">
            @if ($heroImage)
            <div class="kl-products__hero-media">
                <img src="{{ url($heroImage) }}" alt="Sản phẩm {{ $setting->company ?? 'Kỳ Linh Food' }}" class="kl-products__hero-img">
                <div class="kl-products__hero-fade" aria-hidden="true"></div>
                <div class="kl-products__hero-leaves" aria-hidden="true">
                    @for ($leaf = 1; $leaf <= 4; $leaf++)
                    <span class="kl-products__leaf kl-products__leaf--{{ $leaf }}">
                        <img src="/frontend/images/leaf.png" alt="">
                    </span>
                    @endfor
                </div>
            </div>
            @endif
            <div class="container kl-products__hero-body">
                <div class="kl-products__hero-content">
                    <h1 class="kl-products__hero-title">Sản phẩm</h1>
                    <p class="kl-products__hero-desc">Kỳ Linh Food cung cấp đa dạng thực phẩm tươi ngon, rõ nguồn gốc – An toàn – Chất lượng.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="kl-products__main">
        <div class="container">
            <div class="kl-products__grid">
                @forelse ($categories as $category)
                @php
                    $cateName = languageName($category->name);
                    $cateImage = json_decode($category->imagehome, true);
                    $cateIcon = !empty($category->avatar) ? $category->avatar : $cateImage[0];
                @endphp
                <a href="javascript:void(0)" class="kl-products__card" title="{{ $cateName }}">
                    <div class="kl-products__card-body">
                        <div class="kl-products__card-media">
                            @if ($cateImage)
                            <img src="{{ url($cateImage[0]) }}" alt="{{ $cateName }}" loading="lazy" decoding="async">
                            @else
                            <span class="kl-products__card-placeholder" aria-hidden="true"></span>
                            @endif
                        </div>
                        @if ($cateIcon)
                        <span class="kl-products__card-icon">
                            <img src="{{ url($cateIcon) }}" alt="">
                        </span>
                        @endif
                    </div>
                    <div class="kl-products__card-foot">
                        <span class="kl-products__card-name">{{ $cateName }}</span>
                    </div>
                </a>
                @empty
                <div class="kl-products__empty">
                    <p>Chưa có danh mục sản phẩm.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
