@extends('layouts.main.master')
@section('title')
    Về Chúng Tôi
@endsection
@section('description')
    {{ $setting->company }}
@endsection
@section('css')
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
@endsection
@section('js')
@endsection
@section('content')
@php
    $aboutPage = $gioithieu ?? null;
    $aboutImage = null;
    if ($aboutPage && !empty($aboutPage->image)) {
        $imgRaw = $aboutPage->image;
        $imgData = json_decode($imgRaw, true);
        if (is_array($imgData) && !empty($imgData[0])) {
            $aboutImage = $imgData[0];
        } elseif (is_string($imgRaw) && $imgRaw !== '' && strpos(trim($imgRaw), '[') !== 0) {
            $aboutImage = $imgRaw;
        }
    }
    if (!$aboutImage && isset($banner) && $banner->isNotEmpty() && !empty($banner->first()->image)) {
        $aboutImage = $banner->first()->image;
    }

    $galleryItems = collect($album ?? [])->take(4);
    $factoryImage = $aboutImage;
    if ($galleryItems->isNotEmpty() && !empty($galleryItems->first()->after)) {
        $factoryImage = $galleryItems->first()->after;
    }

    $facilities = [
        ['icon' => 'area', 'label' => 'Diện tích nhà xưởng', 'value' => '2.500m²'],
        ['icon' => 'process', 'label' => 'Khu vực sơ chế – chế biến', 'value' => '1.200m²'],
        ['icon' => 'warehouse', 'label' => 'Kho bảo quản đạt chuẩn', 'value' => '1.000m²'],
        ['icon' => 'cold', 'label' => 'Hệ thống kho lạnh công suất lớn', 'value' => ''],
        ['icon' => 'pack', 'label' => 'Khu vực đóng gói – đóng thùng hiện đại', 'value' => ''],
    ];
@endphp
<div class="bodywrap kl-about">
    <nav class="kl-about__breadcrumb" aria-label="Breadcrumb">
        <div class="container">
            <a href="{{ route('home') }}">Trang chủ</a>
            <span class="kl-about__breadcrumb-sep">&gt;</span>
            <span>Giới thiệu</span>
        </div>
    </nav>

    <section class="kl-about__hero">
        <div class="kl-about__hero-slide">
            @if ($aboutImage)
            <div class="kl-about__hero-media">
                <img src="{{ url($aboutImage) }}" alt="Giới thiệu {{ $setting->company ?? 'Kỳ Linh Food' }}" class="kl-about__hero-img">
                <div class="kl-about__hero-fade" aria-hidden="true"></div>
                <div class="kl-about__hero-leaves" aria-hidden="true">
                    @for ($leaf = 1; $leaf <= 4; $leaf++)
                    <span class="kl-about__leaf kl-about__leaf--{{ $leaf }}">
                        <img src="/frontend/images/leaf.png" alt="">
                    </span>
                    @endfor
                </div>
            </div>
            @endif
            <div class="container kl-about__hero-body">
                <div class="kl-about__hero-content">
                    <h1 class="kl-about__hero-title">Giới thiệu về Kỳ Linh Food</h1>
                    <p class="kl-about__hero-motto">Uy tín tạo nên thương hiệu – Chất lượng tạo nên niềm tin</p>
                    <div class="kl-about__hero-desc">
                        <p>Kỳ Linh Food là đơn vị chuyên cung cấp thực phẩm tươi sống và thực phẩm chế biến cho các trường học, bệnh viện, nhà hàng, bếp ăn công nghiệp, cơ quan và doanh nghiệp trên toàn quốc.</p>
                        <p>Với hệ thống quy trình kiểm soát chất lượng khép kín từ khâu nhập hàng, sơ chế, bảo quản đến vận chuyển, chúng tôi cam kết mang đến nguồn thực phẩm an toàn – chất lượng – ổn định cho đối tác.</p>
                    </div>
                    <a href="#kl-about-main" class="kl-about__hero-btn" title="Tìm hiểu thêm về chúng tôi">
                        <span class="kl-about__hero-btn-icon" aria-hidden="true">
                            <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 17.5c-3.5-.5-6-3-6.5-6.2 2.7.1 4.8 1.7 5.5 4.2Z" fill="currentColor"/>
                                <path d="M10.5 17.5c3.5-.5 6-3 6.5-6.2-2.7.1-4.8 1.7-5.5 4.2Z" fill="currentColor"/>
                                <path d="M10 17.7V4.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                            </svg>
                        </span>
                        Tìm hiểu thêm về chúng tôi
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="kl-about__main" id="kl-about-main">
        <div class="container">
            <div class="kl-about__main-grid">
                <div class="kl-about__intro">
                    <h2 class="kl-about__section-title">Về chúng tôi</h2>
                    <div class="kl-about__intro-text">
                        @if ($aboutPage && !empty($aboutPage->content))
                            {!! $aboutPage->content !!}
                        @else
                            <p>Kỳ Linh Food được thành lập với sứ mệnh cung cấp nguồn thực phẩm sạch, an toàn và chất lượng cao cho các đơn vị cung cấp suất ăn tập thể. Qua nhiều năm phát triển, chúng tôi đã xây dựng hệ thống vận hành chuyên nghiệp, đáp ứng nhu cầu cung ứng ổn định cho hàng trăm khách hàng.</p>
                            <p>Chúng tôi không ngừng đầu tư cơ sở vật chất, nâng cao năng lực sản xuất và chế biến, đồng thời đào tạo đội ngũ nhân sự tận tâm – trách nhiệm, góp phần bảo vệ sức khỏe cộng đồng.</p>
                        @endif
                    </div>
                    <p class="kl-about__signature">
                        <span>Kỳ Linh Food</span>
                        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M10 17.5c-3.5-.5-6-3-6.5-6.2 2.7.1 4.8 1.7 5.5 4.2Z" fill="currentColor"/>
                            <path d="M10 17.7V4.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                        </svg>
                    </p>
                </div>

                <div class="kl-about__stats">
                    @forelse ($whyChoose as $item)
                    <div class="kl-about__stat">
                        <div class="kl-about__stat-icon" aria-hidden="true">
                            @if (!empty($item->image))
                            <img src="{{ url($item->image) }}" alt="{{ $item->title }}">
                            @else
                            @include('partials.about-icon', ['type' => 'building'])
                            @endif
                        </div>
                        <p class="kl-about__stat-value">{{ $item->title }}</p>
                        <p class="kl-about__stat-label">{{ $item->description }}</p>
                    </div>
                    @empty
                    <div class="kl-about__stat">
                        <div class="kl-about__stat-icon" aria-hidden="true">
                            @include('partials.about-icon', ['type' => 'building'])
                        </div>
                        <p class="kl-about__stat-value">5+</p>
                        <p class="kl-about__stat-label">Năm kinh nghiệm trong lĩnh vực cung ứng thực phẩm</p>
                    </div>
                    @endforelse
                </div>

                <div class="kl-about__factory">
                    <div class="kl-about__factory-top">
                        @if ($factoryImage)
                        <div class="kl-about__factory-photo">
                            <img src="{{ url($factoryImage) }}" alt="Quy mô nhà xưởng Kỳ Linh Food">
                            <span class="kl-about__factory-badge">
                                @include('partials.about-icon', ['type' => 'factory'])
                                Quy mô nhà xưởng
                            </span>
                        </div>
                        @endif
                        <div class="kl-about__factory-panel">
                            <ul class="kl-about__factory-list">
                                @foreach ($facilities as $facility)
                                <li>
                                    <span class="kl-about__factory-list-icon kl-about__factory-list-icon--{{ $facility['icon'] }}" aria-hidden="true">
                                        @include('partials.about-icon', ['type' => $facility['icon']])
                                    </span>
                                    <span class="kl-about__factory-list-text">
                                        <span class="kl-about__factory-list-label">{{ $facility['label'] }}</span>
                                        @if (!empty($facility['value']))
                                        <strong class="kl-about__factory-list-value">{{ $facility['value'] }}</strong>
                                        @endif
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @if ($galleryItems->isNotEmpty())
                    <div class="kl-about__factory-gallery">
                        @foreach ($galleryItems as $item)
                        @php $thumb = $item->after ?: ($item->before ?? null); @endphp
                        @if ($thumb)
                        <div class="kl-about__factory-thumb">
                            <img src="{{ url($thumb) }}" alt="{{ $item->title ?? 'Hình ảnh nhà xưởng' }}">
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="kl-about__values">
        <div class="container">
            <h2 class="kl-about__values-title">Giá trị cốt lõi</h2>
            <div class="kl-about__values-grid">
                @forelse ($coreValues as $item)
                <div class="kl-about__value">
                    <div class="kl-about__value-icon" aria-hidden="true">
                        @if (!empty($item->image))
                        <img src="{{ url($item->image) }}" alt="{{ $item->title }}">
                        @else
                        @include('partials.about-icon', ['type' => 'shield'])
                        @endif
                    </div>
                    <h3 class="kl-about__value-title">{{ $item->title }}</h3>
                    <p class="kl-about__value-desc">{{ $item->description }}</p>
                </div>
                @empty
                <div class="kl-about__value">
                    <div class="kl-about__value-icon" aria-hidden="true">
                        @include('partials.about-icon', ['type' => 'shield'])
                    </div>
                    <h3 class="kl-about__value-title">An toàn</h3>
                    <p class="kl-about__value-desc">Đảm bảo vệ sinh an toàn thực phẩm theo quy định hiện hành.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
