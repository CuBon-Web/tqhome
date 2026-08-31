@extends('layouts.main.master')
@section('title')
Liên hệ với chúng tôi
@endsection
@section('description')
Liên hệ với chúng tôi
@endsection
@section('image')
{{url(''.$setting->logo)}}
@endsection
@section('css')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
<link href="{{ url('frontend/css/contact_style.scss.css') }}?v={{ filemtime(public_path('frontend/css/contact_style.scss.css')) }}" rel="stylesheet" type="text/css" media="all">
@endsection
@section('js')
@endsection
@section('content')
@php
    $contactPhone1 = trim((string) ($setting->phone1 ?? ''));
    $contactPhone2 = trim((string) ($setting->phone2 ?? ''));
    $contactPhone1Digits = preg_replace('/[^0-9+]/', '', $contactPhone1);
    $contactPhone2Digits = preg_replace('/[^0-9+]/', '', $contactPhone2);
    $contactEmail = trim((string) ($setting->email ?? ''));
    $contactAddressMain = trim((string) ($setting->address2 ?? ''));
    $contactAddressOffice = trim((string) ($setting->address1 ?? ''));
    $contactAddress = $contactAddressMain !== '' ? $contactAddressMain : $contactAddressOffice;
@endphp
<div class="bodywrap kl-contact">
  <section class="kl-contact__hero">
    <div class="container">
      <nav class="kl-contact__breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Trang chủ</a>
        <span>&gt;</span>
        <span>Liên hệ</span>
      </nav>
      <h1 class="kl-contact__title">Liên hệ</h1>
      <p class="kl-contact__subtitle">Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn</p>
    </div>
  </section>

  <div class="layout-contact kl-contact__main">
    <div class="container">
      <div class="row kl-contact__layout">
        <div class="col-lg-6 col-12">
          <div class="contact kl-contact__card">
            <h4>{{ $setting->company ? strtoupper($setting->company) : 'LIÊN HỆ VỚI CHÚNG TÔI' }}</h4>
            <div class="des_foo">
              @if (!empty($setting->footer_content))
                {!! $setting->footer_content !!}
              @else
                {{ $setting->company }}@if (!empty($setting->webname)) - {{ $setting->webname }}@endif
              @endif
            </div>
            <div class="info-contact">
              <div class="group-address">
                <ul>
                  @if ($contactAddress !== '')
                  <li>
                    <div class="icon" aria-hidden="true">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 256c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z"/></svg>
                    </div>
                    <div class="info">
                      <b>Địa chỉ</b>
                      <span>{{ $contactAddress }}</span>
                    </div>
                  </li>
                  @endif
                  @if ($contactAddressOffice !== '' && $contactAddressOffice !== $contactAddress)
                  <li>
                    <div class="icon" aria-hidden="true">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 256c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z"/></svg>
                    </div>
                    <div class="info">
                      <b>Văn phòng đại diện</b>
                      <span>{{ $contactAddressOffice }}</span>
                    </div>
                  </li>
                  @endif
                  @if ($contactPhone1 !== '')
                  <li>
                    <div class="icon" aria-hidden="true">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M280 0C408.1 0 512 103.9 512 232c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-101.6-82.4-184-184-184c-13.3 0-24-10.7-24-24s10.7-24 24-24zm8 192a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm-32-72c0-13.3 10.7-24 24-24c75.1 0 136 60.9 136 136c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-48.6-39.4-88-88-88c-13.3 0-24-10.7-24-24zM117.5 1.4c19.4-5.3 39.7 4.6 47.4 23.2l40 96c6.8 16.3 2.1 35.2-11.6 46.3L144 207.3c33.3 70.4 90.3 127.4 160.7 160.7L345 318.7c11.2-13.7 30-18.4 46.3-11.6l96 40c18.6 7.7 28.5 28 23.2 47.4l-24 88C481.8 499.9 466 512 448 512C200.6 512 0 311.4 0 64C0 46 12.1 30.2 29.5 25.4l88-24z"/></svg>
                    </div>
                    <div class="info">
                      <b>Hotline</b>
                      <a title="{{ $contactPhone1 }}" href="tel:{{ $contactPhone1Digits }}">{{ $contactPhone1 }}</a>
                    </div>
                  </li>
                  @endif
                  @if ($contactPhone2 !== '')
                  <li>
                    <div class="icon" aria-hidden="true">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M280 0C408.1 0 512 103.9 512 232c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-101.6-82.4-184-184-184c-13.3 0-24-10.7-24-24s10.7-24 24-24zm8 192a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm-32-72c0-13.3 10.7-24 24-24c75.1 0 136 60.9 136 136c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-48.6-39.4-88-88-88c-13.3 0-24-10.7-24-24zM117.5 1.4c19.4-5.3 39.7 4.6 47.4 23.2l40 96c6.8 16.3 2.1 35.2-11.6 46.3L144 207.3c33.3 70.4 90.3 127.4 160.7 160.7L345 318.7c11.2-13.7 30-18.4 46.3-11.6l96 40c18.6 7.7 28.5 28 23.2 47.4l-24 88C481.8 499.9 466 512 448 512C200.6 512 0 311.4 0 64C0 46 12.1 30.2 29.5 25.4l88-24z"/></svg>
                    </div>
                    <div class="info">
                      <b>Hotline phụ</b>
                      <a title="{{ $contactPhone2 }}" href="tel:{{ $contactPhone2Digits }}">{{ $contactPhone2 }}</a>
                    </div>
                  </li>
                  @endif
                  @if ($contactEmail !== '')
                  <li>
                    <div class="icon" aria-hidden="true">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                    </div>
                    <div class="info">
                      <b>Email</b>
                      <a title="{{ $contactEmail }}" href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
                    </div>
                  </li>
                  @endif
                  @if ($setting->google !== '')
                  <li>
                    <div class="icon" aria-hidden="true">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448 209.91a210.06 210.06 0 0 1-122.77-39.25V349.38A162.55 162.55 0 1 1 185 188.31V278.2a74.62 74.62 0 1 0 52.23 71.18V0l88 0a121.18 121.18 0 0 0 1.86 22.17h0A122.18 122.18 0 0 0 381 102.39a121.43 121.43 0 0 0 67 20.14Z"/></svg>
                    </div>
                    <div class="info">
                      <b>TikTok</b>
                      <a title="{{ $setting->google }}" href="{{ $setting->google }}" target="_blank" rel="nofollow noreferrer">TikTok</a>
                    </div>
                  </li>
                  @endif
                </ul>
              </div>
            </div>
          </div>

          <div class="form-contact kl-contact__card">
            <h4>Gửi tin nhắn</h4>
            <span class="content-form">
              Nếu bạn có thắc mắc, hãy gửi yêu cầu cho chúng tôi — chúng tôi sẽ liên hệ lại sớm nhất có thể.
            </span>
            @if (session('success'))
            <div class="alert alert-success kl-contact__alert">{{ session('success') }}</div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger kl-contact__alert">{{ session('error') }}</div>
            @endif
            <div id="pagelogin">
              <form method="post" action="{{ route('postcontact') }}" id="contact" accept-charset="UTF-8">
                @csrf
                <input type="hidden" name="redirect_url" value="{{ route('lienHe') }}">
                <div class="group_contact">
                  <input placeholder="Họ và tên *" type="text" class="form-control form-control-lg" required name="name" value="{{ old('name') }}">
                  <input placeholder="Email *" type="email" required class="form-control form-control-lg" name="email" value="{{ old('email') }}">
                  <input type="tel" placeholder="Điện thoại *" name="phone" class="form-control form-control-lg" required value="{{ old('phone') }}">
                  <textarea placeholder="Nội dung *" name="mess" class="form-control content-area form-control-lg" rows="5" required>{{ old('mess') }}</textarea>
                  <button type="submit" class="btn-lienhe">Gửi thông tin</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-12">
          <div id="contact_map" class="map kl-contact__map">
            @if (!empty($setting->iframe_map))
              {!! $setting->iframe_map !!}
            @else
              <iframe src="https://www.google.com/maps?q={{ urlencode($contactAddress) }}&output=embed" style="border:0" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="js-global-alert" class="alert alert-success" role="alert">
    <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
    <h5 class="alert-heading"></h5>
    <p class="alert-content"></p>
  </div>
</div>
@endsection
