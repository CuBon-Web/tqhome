@extends('layouts.main.master')
@section('title')
Quy trình cung ứng | {{ $setting->company }}
@endsection
@section('description')
{{ $setting->description ?? $setting->company }}
@endsection
@section('css')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
@endsection
@section('js')
@endsection
@section('content')
@php
    $page = $processPage ?? null;
    $pageTitle = $page && !empty($page->page_title) ? $page->page_title : 'Quy trình cung ứng';
    $introContent = $page && !empty($page->intro_content)
        ? $page->intro_content
        : 'Kỳ Linh Food xây dựng quy trình cung ứng khép kín từ khâu lựa chọn nhà cung cấp, tiếp nhận hàng, kiểm tra chất lượng, sơ chế – đóng gói, bảo quản, soạn hàng đến vận chuyển và giao hàng, nhằm đảm bảo thực phẩm <strong>an toàn</strong>, <strong>chất lượng</strong>, <strong>ổn định</strong> và <strong>truy xuất được nguồn gốc</strong> cho đối tác.';
    $commitmentTitle = $page && !empty($page->commitment_title) ? $page->commitment_title : 'Cam kết của Kỳ Linh Food';
    $heroImage = $page && !empty($page->hero_image) ? $page->hero_image : null;
    if (!$heroImage && isset($banner) && $banner->isNotEmpty() && !empty($banner->first()->image)) {
        $heroImage = $banner->first()->image;
    }
    $commitmentImage = $page && !empty($page->commitment_image) ? $page->commitment_image : null;
    if (!$commitmentImage && isset($banner) && $banner->isNotEmpty() && !empty($banner->first()->image)) {
        $commitmentImage = $banner->first()->image;
    }

    $parseChecklist = function ($step) {
        if (!$step) {
            return [];
        }
        if (!empty($step->checklist)) {
            $items = json_decode($step->checklist, true);
            if (is_array($items)) {
                return array_values(array_filter($items, function ($item) {
                    return trim((string) $item) !== '';
                }));
            }
        }
        if (!empty($step->description)) {
            return [strip_tags(languageName($step->description))];
        }
        return [];
    };
@endphp
<div class="bodywrap kl-process">
    <section class="kl-process__head">
        @if ($heroImage)
        <div class="kl-process__head-bg" aria-hidden="true">
            <img src="{{ url($heroImage) }}" alt="">
        </div>
        @endif
        <div class="container">
            <nav class="kl-process__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Trang chủ</a>
                <span>&gt;</span>
                <span>{{ $pageTitle }}</span>
            </nav>
            <div class="kl-process__intro">
                <h1 class="kl-process__title">{{ $pageTitle }}</h1>
                <div class="kl-process__intro-text">{!! $introContent !!}</div>
            </div>
        </div>
    </section>

    <section class="kl-process__steps-section">
        <div class="container">
            @if (($processSteps ?? collect())->isNotEmpty())
            <div class="kl-process__steps-wrap">
                <div class="kl-process__steps-track" aria-hidden="false">
                    @foreach ($processSteps as $step)
                    @php $stepNo = str_pad($loop->iteration, 2, '0', STR_PAD_LEFT); @endphp
                    <div class="kl-process__track-item">
                        <span class="kl-process__step-num">{{ $stepNo }}</span>
                        @if (!$loop->last)
                        <span class="kl-process__step-line" aria-hidden="true"></span>
                        @endif
                    </div>
                    @endforeach
                </div>
                <div class="kl-process__steps-grid">
                    @foreach ($processSteps as $step)
                    @php
                        $stepNo = str_pad($loop->iteration, 2, '0', STR_PAD_LEFT);
                        $points = $parseChecklist($step);
                        $detailLink = !empty($step->link) ? $step->link : 'javascript:void(0)';
                    @endphp
                    <div class="kl-process__step">
                        <div class="kl-process__step-body">
                            <div class="kl-process__step-top">
                                <span class="kl-process__step-num kl-process__step-num--mobile">{{ $stepNo }}</span>
                                @if (!empty($step->icon))
                                <div class="kl-process__step-icon">
                                    <img src="{{ url($step->icon) }}" alt="">
                                </div>
                                @endif
                                <h2 class="kl-process__step-title">{{ $step->title }}</h2>
                            </div>
                            @if (!empty($step->image))
                            <div class="kl-process__step-photo">
                                <img src="{{ url($step->image) }}" alt="{{ $step->title }}" loading="lazy" decoding="async">
                            </div>
                            @endif
                            @if (count($points))
                            <ul class="kl-process__step-list">
                                @foreach ($points as $point)
                                <li>
                                    <span class="kl-process__check" aria-hidden="true">
                                        <svg viewBox="0 0 16 16" fill="none"><path d="M3.5 8.2 6.4 11 12.5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </span>
                                    <span>{{ $point }}</span>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                            <a href="{{ $detailLink }}" class="kl-process__step-btn" title="Xem chi tiết {{ $step->title }}">Xem chi tiết</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <p class="kl-process__empty">Chưa có dữ liệu quy trình. Vui lòng cập nhật trong trang quản trị.</p>
            @endif
        </div>
    </section>

    <section class="kl-process__commitment">
        <div class="container">
            <div class="kl-process__commitment-head">
                <span class="kl-process__commitment-line" aria-hidden="true"></span>
                <h2 class="kl-process__commitment-title">{{ $commitmentTitle }}</h2>
                <span class="kl-process__commitment-line" aria-hidden="true"></span>
            </div>
            <div class="kl-process__commitment-body">
                <div class="kl-process__commitment-list">
                    @forelse ($processCommitments ?? [] as $item)
                    <div class="kl-process__commitment-item">
                        @if (!empty($item->image))
                        <div class="kl-process__commitment-icon">
                            <img src="{{ url($item->image) }}" alt="{{ $item->title }}">
                        </div>
                        @endif
                        <h3 class="kl-process__commitment-name">{{ $item->title }}</h3>
                        <p class="kl-process__commitment-desc">{{ $item->description }}</p>
                    </div>
                    @empty
                    <div class="kl-process__commitment-item">
                        <h3 class="kl-process__commitment-name">An toàn</h3>
                        <p class="kl-process__commitment-desc">Đảm bảo vệ sinh an toàn thực phẩm theo quy định hiện hành.</p>
                    </div>
                    @endforelse
                </div>
                @if ($commitmentImage)
                <div class="kl-process__commitment-media">
                    <img src="{{ url($commitmentImage) }}" alt="{{ $commitmentTitle }}" loading="lazy" decoding="async">
                </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
