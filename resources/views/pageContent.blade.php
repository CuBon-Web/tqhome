@extends('layouts.main.master')
@section('title')
{{$pagecontentdetail->title}}
@endsection
@section('description')
{{$pagecontentdetail->title}}
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('css')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ url('frontend/css/style_page.scss.css') }}?v={{ filemtime(public_path('frontend/css/style_page.scss.css')) }}">
@endsection
@section('js')
@endsection
@section('content')
<div class="bodywrap kl-page">
    <section class="kl-page__hero">
        <div class="container">
            <nav class="kl-page__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Trang chủ</a>
                <span>&gt;</span>
                <span>{{ $pagecontentdetail->title }}</span>
            </nav>
            <h1 class="kl-page__title">{{ $pagecontentdetail->title }}</h1>
        </div>
    </section>

    <section class="kl-page__main">
        <div class="container">
            <div class="kl-page__card">
                <div class="content-page rte">
                    {!! $pagecontentdetail->content !!}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
