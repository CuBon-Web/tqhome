@extends('layouts.main.master')
@section('title')
    {{ $category->title }} | Hồ sơ | {{ $setting->company }}
@endsection
@section('description')
    {{ $category->description ?: ('Hồ sơ nguồn gốc ' . $category->title . ' - ' . $setting->company) }}
@endsection
@section('css')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
@endsection
@section('js')
<script>
(function () {
    var modal = document.getElementById('klProfileLightbox');
    if (!modal) return;

    var imgEl = modal.querySelector('.kl-profile-lightbox__img');
    var captionEl = modal.querySelector('.kl-profile-lightbox__caption');
    var counterEl = modal.querySelector('.kl-profile-lightbox__counter');
    var prevBtn = modal.querySelector('[data-action="prev"]');
    var nextBtn = modal.querySelector('[data-action="next"]');
    var closeEls = modal.querySelectorAll('[data-action="close"]');
    var items = [];
    var currentIndex = 0;

    function render() {
        if (!items.length) return;
        var item = items[currentIndex];
        imgEl.src = item.src;
        imgEl.alt = item.alt || '';
        captionEl.textContent = item.caption || '';
        counterEl.textContent = (currentIndex + 1) + ' / ' + items.length;
        prevBtn.disabled = currentIndex <= 0;
        nextBtn.disabled = currentIndex >= items.length - 1;
    }

    function openAt(index) {
        if (!items.length) return;
        currentIndex = index;
        render();
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function close() {
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        imgEl.src = '';
    }

    function buildItems() {
        items = [];
        document.querySelectorAll('.kl-profile-detail__thumb[data-lightbox-index]').forEach(function (el) {
            items.push({
                src: el.getAttribute('data-src') || '',
                alt: el.getAttribute('data-alt') || '',
                caption: el.getAttribute('data-caption') || '',
            });
        });
    }

    document.addEventListener('click', function (e) {
        var trigger = e.target.closest('.kl-profile-detail__thumb');
        if (!trigger) return;
        e.preventDefault();
        buildItems();
        var index = parseInt(trigger.getAttribute('data-lightbox-index'), 10);
        if (isNaN(index)) index = 0;
        openAt(index);
    });

    prevBtn.addEventListener('click', function () {
        if (currentIndex > 0) {
            currentIndex--;
            render();
        }
    });

    nextBtn.addEventListener('click', function () {
        if (currentIndex < items.length - 1) {
            currentIndex++;
            render();
        }
    });

    closeEls.forEach(function (el) {
        el.addEventListener('click', close);
    });

    document.addEventListener('keydown', function (e) {
        if (!modal.classList.contains('is-open')) return;
        if (e.key === 'Escape') close();
        if (e.key === 'ArrowLeft' && currentIndex > 0) {
            currentIndex--;
            render();
        }
        if (e.key === 'ArrowRight' && currentIndex < items.length - 1) {
            currentIndex++;
            render();
        }
    });
})();
</script>
@endsection
@section('content')
@php
    $lightboxIndex = 0;
@endphp
<div class="bodywrap kl-profile kl-profile-detail">
    <section class="kl-profile-detail__hero">
        <div class="container kl-profile-detail__container">
            <nav class="kl-profile__breadcrumb kl-profile-detail__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Trang chủ</a>
                <span>&gt;</span>
                <a href="{{ route('duanTieuBieu') }}">Hồ sơ</a>
                <span>&gt;</span>
                <span>{{ $category->title }}</span>
            </nav>

            <div class="kl-profile-detail__head">
                @if (!empty($category->image))
                <div class="kl-profile-detail__avatar">
                    <img src="{{ url($category->image) }}" alt="{{ $category->title }}">
                </div>
                @endif
                <h1 class="kl-profile-detail__title">{{ $category->title }}</h1>
                @if (!empty($category->description))
                <p class="kl-profile-detail__desc">{{ $category->description }}</p>
                @endif
            </div>
        </div>
    </section>

    <section class="kl-profile-detail__body">
        <div class="container kl-profile-detail__container">
            @if ($documents->isEmpty())
            <div class="kl-profile-detail__empty">
                <p>Chưa có hồ sơ nào được cập nhật cho danh mục này.</p>
                <a href="{{ route('duanTieuBieu') }}" class="kl-profile-detail__back-btn">← Quay lại danh sách hồ sơ</a>
            </div>
            @else
            @foreach ($documents as $document)
            <div class="kl-profile-detail__group">
                @if (!empty($document->title))
                <div class="kl-profile-detail__group-head">
                    <span class="kl-profile-detail__group-line" aria-hidden="true"></span>
                    <h2 class="kl-profile-detail__group-title">{{ $document->title }}</h2>
                    <span class="kl-profile-detail__group-line" aria-hidden="true"></span>
                </div>
                @endif
                <div class="kl-profile-detail__stack">
                    @foreach ($document->image_list as $img)
                    <figure class="kl-profile-detail__figure">
                        <button
                            type="button"
                            class="kl-profile-detail__thumb"
                            data-lightbox-index="{{ $lightboxIndex }}"
                            data-src="{{ url($img) }}"
                            data-alt="{{ $document->title ?: $category->title }}"
                            data-caption="{{ $document->title ?: $category->title }}"
                            aria-label="Xem ảnh phóng to"
                        >
                            <img src="{{ url($img) }}" alt="{{ $document->title ?: $category->title }}">
                            <span class="kl-profile-detail__zoom" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </button>
                    </figure>
                    @php $lightboxIndex++; @endphp
                    @endforeach
                </div>
            </div>
            @endforeach
            @endif

            <div class="kl-profile-detail__back">
                <a href="{{ route('duanTieuBieu') }}" class="kl-profile-detail__back-btn">← Quay lại danh sách hồ sơ</a>
            </div>
        </div>
    </section>
</div>

<div id="klProfileLightbox" class="kl-profile-lightbox" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Xem ảnh hồ sơ">
    <div class="kl-profile-lightbox__backdrop" data-action="close"></div>
    <div class="kl-profile-lightbox__panel">
        <button type="button" class="kl-profile-lightbox__close" data-action="close" aria-label="Đóng">&times;</button>
        <button type="button" class="kl-profile-lightbox__nav kl-profile-lightbox__nav--prev" data-action="prev" aria-label="Ảnh trước">‹</button>
        <figure class="kl-profile-lightbox__figure">
            <img class="kl-profile-lightbox__img" src="" alt="">
            <figcaption class="kl-profile-lightbox__caption"></figcaption>
            <div class="kl-profile-lightbox__counter"></div>
        </figure>
        <button type="button" class="kl-profile-lightbox__nav kl-profile-lightbox__nav--next" data-action="next" aria-label="Ảnh sau">›</button>
    </div>
</div>
@endsection
