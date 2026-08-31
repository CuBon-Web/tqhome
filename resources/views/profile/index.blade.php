@extends('layouts.main.master')
@section('title')
    Hồ sơ | {{ $setting->company }}
@endsection
@section('description')
    Minh bạch nguồn gốc – An tâm chất lượng. Hồ sơ nguồn gốc sản phẩm và chứng nhận ATTP của {{ $setting->company }}.
@endsection
@section('css')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
@endsection
@section('js')
@endsection
@section('content')
@php
    $heroImage = null;
    if (isset($banner) && $banner->isNotEmpty() && !empty($banner->first()->image)) {
        $heroImage = $banner->first()->image;
    }

    $profileCategories = isset($profileCategories) ? $profileCategories : collect();
    $randomProfileDocs = isset($randomProfileDocs) ? $randomProfileDocs : collect();

    $heroFeatures = [
        ['label' => 'Nguồn gốc rõ ràng', 'image' => '/frontend/images/feature-origin.png'],
        ['label' => 'Kiểm soát chặt chẽ', 'image' => '/frontend/images/feature-control.png'],
        ['label' => 'Đạt chuẩn ATTP', 'image' => '/frontend/images/feature-cert.png'],
        ['label' => 'Minh bạch – An tâm', 'image' => '/frontend/images/feature-trust.png'],
    ];

    $commitments = [
        'Minh bạch nguồn gốc.',
        'Đảm bảo an toàn thực phẩm.',
        'Kiểm soát chất lượng chặt chẽ.',
        'Trách nhiệm với sức khỏe cộng đồng.',
    ];
@endphp
<div class="bodywrap kl-profile">
    <section class="kl-profile__hero">
        @if ($heroImage)
        <div class="kl-profile__hero-media" aria-hidden="true">
            <img src="{{ url($heroImage) }}" alt="">
            <div class="kl-profile__hero-fade"></div>
        </div>
        @endif
        <div class="container">
            <nav class="kl-profile__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Trang chủ</a>
                <span>&gt;</span>
                <span>Hồ sơ</span>
            </nav>
            <div class="kl-profile__hero-inner">
                <div class="kl-profile__hero-content">
                    <h1 class="kl-profile__title">Hồ sơ</h1>
                    <p class="kl-profile__subtitle">Minh bạch nguồn gốc – An tâm chất lượng</p>
                    <p class="kl-profile__desc">Kỳ Linh Food cam kết cung cấp thực phẩm có nguồn gốc rõ ràng, đạt tiêu chuẩn an toàn thực phẩm, kiểm soát chất lượng nghiêm ngặt từ khâu lựa chọn nhà cung cấp đến giao hàng.</p>
                    <div class="kl-profile__features">
                        @foreach ($heroFeatures as $feature)
                        <div class="kl-profile__feature">
                            <span class="kl-profile__feature-icon" aria-hidden="true">
                                @if (!empty($feature['image']))
                                <img src="{{ url($feature['image']) }}" alt="{{ $feature['label'] }}">
                                @endif
                            </span>
                            <span class="kl-profile__feature-label">{{ $feature['label'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="kl-profile__origin" id="ho-so-nguon-goc">
        <div class="container">
            <div class="kl-profile__origin-box">
                <div class="kl-profile__origin-head">
                    <span class="kl-profile__origin-leaf" aria-hidden="true">
                        <img src="/frontend/images/leaf2.png" alt="">
                    </span>
                    <h2 class="kl-profile__origin-title">Hồ sơ nguồn gốc sản phẩm</h2>
                    <span class="kl-profile__origin-leaf kl-profile__origin-leaf--flip" aria-hidden="true">
                        <img src="/frontend/images/leaf2.png" alt="">
                    </span>
                </div>
                <div class="kl-profile__grid">
                    @forelse ($profileCategories as $index => $category)
                    @php
                        $cardNo = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                        $detailUrl = !empty($category->slug)
                            ? route('profileCategoryDetail', ['slug' => $category->slug])
                            : 'javascript:void(0)';
                    @endphp
                    <div class="kl-profile__card">
                        <span class="kl-profile__card-num">{{ $cardNo }}</span>
                        <div class="kl-profile__card-body">
                            <div class="kl-profile__card-icon">
                                @if (!empty($category->image))
                                <img src="{{ url($category->image) }}" alt="{{ $category->title }}">
                                @else
                                @include('partials.profile-icon', ['type' => 'category'])
                                @endif
                            </div>
                            <div class="kl-profile__card-text">
                                <h3 class="kl-profile__card-title">{{ strtoupper($category->title) }}</h3>
                                <p class="kl-profile__card-desc">{{ $category->description ?: '' }}</p>
                            </div>
                        </div>
                        <div class="kl-profile__card-action">
                            <a href="{{ $detailUrl }}" class="kl-profile__card-link" title="Xem hồ sơ {{ $category->title }}">
                                Xem hồ sơ <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="kl-profile__empty" style="grid-column:1/-1;padding:40px 20px;text-align:center;color:#666;">
                        <p>Chưa có danh mục hồ sơ nào được cập nhật.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section class="kl-profile__bottom">
        <div class="container">
            <div class="kl-profile__bottom-grid">
                <div class="kl-profile__certs-intro">
                    <h2 class="kl-profile__certs-title">Hồ sơ ATTP &amp; Chứng nhận</h2>
                    <p class="kl-profile__certs-desc">Kỳ Linh Food tuân thủ đầy đủ các quy định về an toàn thực phẩm, sở hữu hệ thống chứng nhận và giấy tờ pháp lý minh bạch, đảm bảo uy tín với đối tác.</p>
                    <a href="#ho-so-nguon-goc" class="kl-profile__certs-btn" title="Xem tất cả hồ sơ chứng nhận">
                        Xem tất cả hồ sơ chứng nhận <span aria-hidden="true">→</span>
                    </a>
                </div>
                <div class="kl-profile__certs-gallery">
                    @forelse ($randomProfileDocs as $doc)
                    @php
                        $certImage = !empty($doc->image_list[0]) ? $doc->image_list[0] : '';
                        $certLabel = $doc->title ?: ($doc->category ? $doc->category->title : '');
                        $certUrl = ($doc->category && !empty($doc->category->slug))
                            ? route('profileCategoryDetail', ['slug' => $doc->category->slug])
                            : 'javascript:void(0)';
                    @endphp
                    <a href="{{ $certUrl }}" class="kl-profile__cert-item" title="{{ $certLabel }}">
                        <div class="kl-profile__cert-frame">
                            @if ($certImage)
                            <img src="{{ url($certImage) }}" alt="{{ $certLabel }}">
                            @else
                            <span class="kl-profile__cert-placeholder" aria-hidden="true">
                                <svg viewBox="0 0 48 64" fill="none"><rect x="4" y="4" width="40" height="56" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M12 16h24M12 24h20M12 32h16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            </span>
                            @endif
                        </div>
                        <p class="kl-profile__cert-label">{{ $certLabel }}</p>
                    </a>
                    @empty
                    <div class="kl-profile__cert-empty" style="grid-column:1/-1;text-align:center;color:#666;font-size:13px;padding:20px 0;">
                        Chưa có hồ sơ nào để hiển thị.
                    </div>
                    @endforelse
                </div>
                <div class="kl-profile__commit">
                    <div class="kl-profile__commit-head">
                        <span class="kl-profile__commit-icon" aria-hidden="true">
                            @include('partials.profile-icon', ['type' => 'shield'])
                        </span>
                        <h3 class="kl-profile__commit-title">Cam kết từ Kỳ Linh Food</h3>
                    </div>
                    <ul class="kl-profile__commit-list">
                        @foreach ($commitments as $point)
                        <li>
                            <span class="kl-profile__commit-check" aria-hidden="true">
                                <svg viewBox="0 0 16 16" fill="none"><path d="M3.5 8.2 6.4 11 12.5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <span>{{ $point }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
