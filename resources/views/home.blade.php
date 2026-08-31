@extends('layouts.main.master')
@section('title')
    {{ $setting->company }}
@endsection
@section('description')
    {{ $setting->webname }}
@endsection
@section('image')
    @php
        $ogBanner = $banner->first();
        $ogImage = $ogBanner && $ogBanner->image ? url($ogBanner->image) : url($setting->logo ?? '');
    @endphp
    {{ $ogImage }}
@endsection
@section('css')
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
@endsection
@section('js')
<script src="/frontend/js/wow.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
   (function () {
      if (typeof WOW !== 'function') {
         return;
      }
      new WOW({
         boxClass: 'wow',
         animateClass: 'animate__animated',
         offset: 0,
         mobile: true,
         live: true
      }).init();
   })();

   (function () {
      var gallery = document.getElementById('aboutGallery');
      if (!gallery) return;
      var main = gallery.querySelector('#aboutGalleryMain');
      var thumbs = gallery.querySelectorAll('.about-gallery__thumb');
      if (!main || !thumbs.length) return;

      thumbs.forEach(function (thumb) {
         thumb.addEventListener('click', function () {
            var src = thumb.getAttribute('data-src');
            if (!src || main.getAttribute('src') === src) return;
            main.style.opacity = '0';
            window.setTimeout(function () {
               main.setAttribute('src', src);
               main.style.opacity = '1';
            }, 150);
            thumbs.forEach(function (item) {
               item.classList.toggle('is-active', item === thumb);
            });
         });
      });
   })();

   (function () {
      var text = document.getElementById('aboutCopyText');
      var btn = document.getElementById('aboutCopyToggle');
      if (!text || !btn) return;

      text.classList.add('is-collapsed');
      if (text.scrollHeight <= text.clientHeight + 4) {
         text.classList.remove('is-collapsed');
         return;
      }

      btn.hidden = false;
      btn.addEventListener('click', function () {
         var collapsed = text.classList.toggle('is-collapsed');
         btn.classList.toggle('is-open', !collapsed);
         btn.setAttribute('aria-expanded', collapsed ? 'false' : 'true');
         btn.textContent = collapsed ? 'Xem thêm' : 'Thu gọn';
         if (collapsed) {
            var section = document.getElementById('ve-tqhome');
            if (section) {
               section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
         }
      });
   })();

   (function () {
      var el = document.querySelector('.partner-swiper');
      if (!el || typeof Swiper !== 'function') return;
      var count = el.querySelectorAll('.swiper-slide').length;
      new Swiper(el, {
         slidesPerView: 2,
         spaceBetween: 12,
         speed: 700,
         loop: count >= 6,
         rewind: count > 1 && count < 6,
         grabCursor: true,
         autoplay: count > 1 ? {
            delay: 2400,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
         } : false,
         navigation: {
            nextEl: el.querySelector('.swiper-button-next'),
            prevEl: el.querySelector('.swiper-button-prev')
         },
         pagination: {
            el: el.querySelector('.swiper-pagination'),
            clickable: true
         },
         breakpoints: {
            576: { slidesPerView: 2.4, spaceBetween: 14 },
            768: { slidesPerView: 3, spaceBetween: 16 },
            992: { slidesPerView: 3.4, spaceBetween: 18 }
         }
      });
   })();
</script>
@endsection
@section('content')
 <!-- HERO -->
 <section id="trang-chu" class="hero">
  <div class="hero-video-wrap">
    @php
      $heroPhone = trim((string) ($setting->phone1 ?? ''));
      $heroPhoneDigits = preg_replace('/\D+/', '', $heroPhone);
      $heroZaloSetting = isset($setting->zalo) ? trim((string) $setting->zalo) : '';
      if ($heroZaloSetting !== '') {
        $heroZaloUrl = preg_match('#^https?://#i', $heroZaloSetting) ? $heroZaloSetting : 'https://zalo.me/' . preg_replace('/\D+/', '', $heroZaloSetting);
      } elseif ($heroPhoneDigits !== '') {
        $heroZaloNumber = strpos($heroPhoneDigits, '0') === 0
          ? '84' . substr($heroPhoneDigits, 1)
          : $heroPhoneDigits;
        $heroZaloUrl = 'https://zalo.me/' . $heroZaloNumber;
      } else {
        $heroZaloUrl = '';
      }
    @endphp
    @foreach ($banner as $item)
    @if ($item->type == 'video')
    <div class="hero-video-frame">
      <video class="hero-video" autoplay muted loop playsinline preload="auto">
        <source src="{{url($item->video_url)}}" type="video/mp4">
      </video>
      @if ($heroPhone !== '' || $heroZaloUrl !== '')
      <div class="hero-video-actions">
        @if ($heroPhone !== '')
        <a class="hero-video-btn hero-video-btn--call" href="tel:{{ $heroPhone }}" title="Gọi hotline {{ $heroPhone }}">
          <i class="fa-solid fa-phone"></i>
          <span>Gọi hotline</span>
        </a>
        @endif
        @if ($heroZaloUrl !== '')
        <a class="hero-video-btn hero-video-btn--zalo" href="{{ $heroZaloUrl }}" target="_blank" rel="noopener noreferrer" title="Chat Zalo">
          <i class="fa-solid fa-comment-dots"></i>
          <span>Zalo</span>
        </a>
        @endif
      </div>
      @endif
    </div>
    @endif
    @endforeach
  </div>
</section>

<!-- PRODUCTS -->
<section id="san-pham" class="section">
  <div class="container">
    <div class="section-heading center wow animate__fadeInUp">
      <h2>Lĩnh vực kinh doanh</h2>
      <p>Từ những món kim khí nhỏ nhất đến thiết bị điện nước, vệ sinh và xử lý nước — TQHome hướng đến trải nghiệm mua sắm thuận tiện, đồng bộ.</p>
    </div>

    <div class="row g-3 g-lg-4">
     @foreach ($categoryhome as $item)
     <div class="col-6 col-lg-3">
        <div class="category-card wow animate__fadeInUp">
          <div class="category-image"><img src="{{json_decode($item->imagehome)[0]}}" alt="{{$item->name}}"></div>
          <div class="category-body"><h3>{{languageName($item->name)}}</h3><p>{!!$item->content!!}</p><a class="category-link btn-consult" href="#" data-product="{{$item->name}}">Tư vấn sản phẩm <i class="fa-solid fa-arrow-right"></i></a></div>
        </div>
      </div>
     @endforeach
    </div>
  </div>
</section>

<!-- WHY -->
<section id="uu-diem" class="section section-soft">
  <div class="container">
    <div class="section-heading center wow animate__fadeInUp">
      <div class="eyebrow">LÝ DO KHÁCH HÀNG LỰA CHỌN</div>
      <h2>TQHome không chỉ bán sản phẩm</h2>
      <p>Chúng tôi tập trung vào chất lượng sản phẩm, sự minh bạch và khả năng tư vấn để khách hàng chọn đúng ngay từ đầu.</p>
    </div>

    <div class="why-grid" @if (isset($whyChoose) && $whyChoose->isNotEmpty()) style="--why-cols: {{ min($whyChoose->count(), 5) }}" @endif>
      @php
        $whyIcons = ['fa-layer-group', 'fa-certificate', 'fa-scale-balanced', 'fa-comments', 'fa-handshake-angle'];
      @endphp
      @forelse ($whyChoose as $item)
      <div class="why-item wow animate__fadeInUp" @if ($loop->index) data-wow-delay="{{ number_format($loop->index * 0.08, 2, '.', '') }}s" @endif>
        <div class="why-number">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
        <div class="why-icon">
          @if (!empty($item->image))
          <img src="{{ url($item->image) }}" alt="{{ $item->title }}">
          @else
          <i class="fa-solid {{ $whyIcons[$loop->index % count($whyIcons)] }}"></i>
          @endif
        </div>
        <h3>
          @if (!empty($item->link))
          <a href="{{ $item->link }}">{{ $item->title }}</a>
          @else
          {{ $item->title }}
          @endif
        </h3>
        <p>{{ $item->description }}</p>
      </div>
      @empty
      <div class="why-item wow animate__fadeInUp"><div class="why-number">01</div><div class="why-icon"><i class="fa-solid fa-layer-group"></i></div><h3>ĐA DẠNG SẢN PHẨM</h3><p>Kim khí, điện nước, vệ sinh, sen vòi, bồn nước, máy lọc nước và nhiều phụ kiện.</p></div>
      <div class="why-item wow animate__fadeInUp" data-wow-delay=".08s"><div class="why-number">02</div><div class="why-icon"><i class="fa-solid fa-certificate"></i></div><h3>CHẤT LƯỢNG</h3><p>Ưu tiên sản phẩm có nguồn gốc rõ ràng, thương hiệu và chất lượng phù hợp.</p></div>
      <div class="why-item wow animate__fadeInUp" data-wow-delay=".16s"><div class="why-number">03</div><div class="why-icon"><i class="fa-solid fa-scale-balanced"></i></div><h3>GIÁ HỢP LÝ</h3><p>Tối ưu chi phí cho gia đình, thợ, nhà thầu và khách hàng mua số lượng.</p></div>
      <div class="why-item wow animate__fadeInUp" data-wow-delay=".24s"><div class="why-number">04</div><div class="why-icon"><i class="fa-solid fa-comments"></i></div><h3>TƯ VẤN ĐÚNG NHU CẦU</h3><p>Đội ngũ hỗ trợ lựa chọn theo công trình, ngân sách và mục đích sử dụng.</p></div>
      <div class="why-item wow animate__fadeInUp" data-wow-delay=".32s"><div class="why-number">05</div><div class="why-icon"><i class="fa-solid fa-handshake-angle"></i></div><h3>ĐỒNG HÀNH LÂU DÀI</h3><p>Không dừng ở bán hàng, TQHome chú trọng hỗ trợ sau bán và bảo hành.</p></div>
      @endforelse
    </div>
  </div>
</section>

<!-- ABOUT -->
<section id="ve-tqhome" class="section">
  <div class="container">
    <div class="about-layout">
      @php
        $aboutImages = [];
        $rawAboutImage = $gioithieu->image ?? null;
        $decodedAbout = is_array($rawAboutImage) ? $rawAboutImage : json_decode($rawAboutImage ?? '[]', true);
        if (is_array($decodedAbout)) {
            foreach ($decodedAbout as $img) {
                if (is_string($img) && trim($img) !== '') {
                    $aboutImages[] = $img;
                } elseif (is_array($img) && !empty($img['url'])) {
                    $aboutImages[] = $img['url'];
                }
            }
        } elseif (is_string($rawAboutImage) && $rawAboutImage !== '' && !in_array($rawAboutImage[0], ['[', '{'], true)) {
            $aboutImages[] = $rawAboutImage;
        }
        if (empty($aboutImages)) {
            $aboutImages[] = 'assets/tqhome-store.jpg';
        }
        $aboutMain = $aboutImages[0];
      @endphp
      <div class="about-photo wow animate__fadeInLeft">
        <div class="about-gallery" id="aboutGallery">
          <div class="about-gallery__main">
            <img
              id="aboutGalleryMain"
              src="{{ url($aboutMain) }}"
              alt="Cửa hàng TQHome tại Thanh Hóa"
            >
          </div>
          @if (count($aboutImages) > 1)
          <div class="about-gallery__thumbs" role="list">
            @foreach ($aboutImages as $index => $aboutImg)
            <button
              type="button"
              class="about-gallery__thumb{{ $index === 0 ? ' is-active' : '' }}"
              data-src="{{ url($aboutImg) }}"
              aria-label="Xem ảnh {{ $index + 1 }}"
            >
              <img src="{{ url($aboutImg) }}" alt="Ảnh TQHome {{ $index + 1 }}">
            </button>
            @endforeach
          </div>
          @endif
        </div>
      </div>

      <div class="about-copy wow animate__fadeInRight">
        <div class="eyebrow">VỀ TQHOME</div>
        <h2>Buôn cái gì cũng có — phục vụ từ gia đình đến công trình</h2>
        <div class="about-copy-body" id="aboutCopyBody">
          <div class="about-copy-text" id="aboutCopyText">
            {!!$gioithieu->content!!}
          </div>
          <button type="button" class="about-copy-toggle" id="aboutCopyToggle" hidden aria-expanded="false">
            Xem thêm
          </button>
        </div>

        <div class="about-cta-row">
          <a class="about-cta btn-consult" href="#" data-product="Tư vấn chung">
            <i class="fa-solid fa-headset"></i>
            <span><small>ĐĂNG KÝ NHẬN TƯ VẤN</small><strong>Gửi yêu cầu ngay</strong></span>
          </a>
          @if (!empty($setting->phone1))
          <a class="about-cta about-cta--call" href="tel:{{ $setting->phone1 }}" title="Gọi hotline {{ $setting->phone1 }}">
            <i class="fa-solid fa-phone"></i>
            <span><small>GỌI HOTLINE</small><strong>{{ $setting->phone1 }}</strong></span>
          </a>
          @endif
        </div>
      </div>
    </div>

    <div class="stats-bar wow animate__fadeInUp">
      <div class="row g-0">
        <div class="col-4"><div class="stat"><strong>20+</strong><span>NĂM KINH NGHIỆM</span></div></div>
        <div class="col-4"><div class="stat"><strong>1000+</strong><span>SẢN PHẨM & VẬT TƯ</span></div></div>
        <div class="col-4"><div class="stat"><strong>5000+</strong><span>KHÁCH HÀNG</span></div></div>
      </div>
    </div>
    @if (isset($Partner) && $Partner->isNotEmpty())
    <div class="partner-slider wow animate__fadeInUp">
      <div class="partner-slider__head">
        <div class="eyebrow">ĐỐI TÁC</div>
        <p>Thương hiệu đồng hành cùng TQHome</p>
      </div>
      <div class="swiper partner-swiper">
        <div class="swiper-wrapper">
          @foreach ($Partner as $item)
          <div class="swiper-slide">
            @if (!empty($item->link))
            <a class="partner-item" href="{{ $item->link }}" target="_blank" rel="noopener noreferrer" title="{{ $item->name }}">
              <img src="{{ url($item->image) }}" alt="{{ $item->name }}">
            </a>
            @else
            <div class="partner-item" title="{{ $item->name }}">
              <img src="{{ url($item->image) }}" alt="{{ $item->name }}">
            </div>
            @endif
          </div>
          @endforeach
        </div>
        <button type="button" class="swiper-button-prev" aria-label="Đối tác trước"></button>
        <button type="button" class="swiper-button-next" aria-label="Đối tác tiếp"></button>
        <div class="swiper-pagination"></div>
      </div>
    </div>
    @endif
  </div>
</section>

<!-- COMMITMENTS -->
<section id="cam-ket" class="section commit-section">
  <div class="container">
    <div class="section-heading commit-heading center wow animate__fadeInUp">
      <div class="eyebrow" style="color:#cbd9f4">CAM KẾT CỦA TQHOME</div>
      <h2>Mua hàng yên tâm, sử dụng lâu dài</h2>
      <p>Những giá trị TQHome muốn khách hàng cảm nhận trong mỗi lần mua hàng.</p>
    </div>

    <div class="commit-grid" @if (isset($coreValues) && $coreValues->isNotEmpty()) style="--commit-cols: {{ min($coreValues->count(), 5) }}" @endif>
      @php
        $commitIcons = ['fa-shield-heart', 'fa-award', 'fa-receipt', 'fa-truck', 'fa-handshake'];
      @endphp
      @forelse ($coreValues as $item)
      <div class="commit-item wow animate__fadeInUp" @if ($loop->index) data-wow-delay="{{ number_format($loop->index * 0.08, 2, '.', '') }}s" @endif>
        @if (!empty($item->image))
        <img src="{{ url($item->image) }}" alt="{{ $item->title }}">
        @else
        <i class="fa-solid {{ $commitIcons[$loop->index % count($commitIcons)] }}"></i>
        @endif
        <h3>{{ $item->title }}</h3>
        <p>{{ $item->description }}</p>
      </div>
      @empty
      <div class="commit-item wow animate__fadeInUp"><i class="fa-solid fa-shield-heart"></i><h3>CHÍNH HÃNG</h3><p>Ưu tiên sản phẩm rõ nguồn gốc, chất lượng phù hợp nhu cầu.</p></div>
      <div class="commit-item wow animate__fadeInUp" data-wow-delay=".08s"><i class="fa-solid fa-award"></i><h3>BẢO HÀNH UY TÍN</h3><p>Hỗ trợ tiếp nhận và hướng dẫn xử lý theo chính sách sản phẩm.</p></div>
      <div class="commit-item wow animate__fadeInUp" data-wow-delay=".16s"><i class="fa-solid fa-receipt"></i><h3>GIÁ MINH BẠCH</h3><p>Báo giá rõ ràng, tư vấn theo nhu cầu và ngân sách.</p></div>
      <div class="commit-item wow animate__fadeInUp" data-wow-delay=".24s"><i class="fa-solid fa-truck"></i><h3>GIAO HÀNG THUẬN TIỆN</h3><p>Hỗ trợ giao hàng phù hợp với khu vực và đơn hàng.</p></div>
      <div class="commit-item wow animate__fadeInUp" data-wow-delay=".32s"><i class="fa-solid fa-handshake"></i><h3>ĐỒNG HÀNH LÂU DÀI</h3><p>Luôn sẵn sàng hỗ trợ khách hàng sau khi mua và sử dụng.</p></div>
      @endforelse
    </div>
  </div>
</section>

<!-- HISTORY -->
<section class="section">
  <div class="container">
    <div class="history wow animate__fadeInUp">
      <div class="history-top">
        <div>
          <div class="history-kicker">LỊCH SỬ HÌNH THÀNH & PHÁT TRIỂN</div>
          <h2>20 năm — một hành trình xây dựng niềm tin</h2>
          <p class="history-intro">Từ một cửa hàng kinh doanh kim khí và điện nước, TQHome từng bước mở rộng ngành hàng, phục vụ đa dạng hơn và hướng tới trở thành địa chỉ quen thuộc của khách hàng tại Thanh Hóa.</p>
        </div>
        <div class="history-big">20+<small>NĂM</small></div>
      </div>

      <div class="timeline">
        @forelse ($historyMilestones as $item)
        <div class="milestone">
          <strong>{{ $item->year }}</strong>
          <h4>{{ $item->title }}</h4>
          <p>{{ $item->description }}</p>
        </div>
        @empty
        <div class="milestone"><strong>2004</strong><h4>KHỞI ĐẦU</h4><p>Bắt đầu kinh doanh kim khí và điện nước, phục vụ nhu cầu thiết yếu của khách hàng địa phương.</p></div>
        <div class="milestone"><strong>2010</strong><h4>MỞ RỘNG NGÀNH HÀNG</h4><p>Đa dạng thêm vật tư điện nước, thiết bị vệ sinh, sen vòi và các sản phẩm phục vụ công trình.</p></div>
        <div class="milestone"><strong>2016</strong><h4>PHÁT TRIỂN QUY MÔ</h4><p>Tăng cường phục vụ thợ, nhà thầu, công trình và xây dựng mạng lưới khách hàng lâu dài.</p></div>
        <div class="milestone"><strong>2024 →</strong><h4>TQHOME HÔM NAY</h4><p>Tiếp tục mở rộng danh mục với định hướng “buôn cái gì cũng có”, lấy uy tín và dịch vụ làm nền tảng.</p></div>
        @endforelse
      </div>
    </div>
  </div>
</section>


<!-- CONTACT -->
<section id="lien-he" class="section">
  <div class="container">
    <div class="section-heading center wow animate__fadeInUp">
      <div class="eyebrow">GHÉ TQHOME TẠI THANH HÓA</div>
      <h2>Đến cửa hàng hoặc gọi để được tư vấn</h2>
    </div>

    <div class="contact-wrap">
      <div class="row g-0">
        <div class="col-lg-4">
          <div class="contact-info wow animate__fadeInLeft">
            <div class="eyebrow" style="color:#cbd9f4">THÔNG TIN LIÊN HỆ</div>
            <h2>TQHOME</h2>
            <p>Kim khí • Điện nước • Thiết bị vệ sinh • Sen vòi • Bồn nước • Máy lọc nước</p>
            <div class="contact-line"><i class="fa-solid fa-location-dot"></i><span>{{$setting->address1}}</span></div>
            <div class="contact-line"><i class="fa-solid fa-phone"></i><span>{{$setting->phone1}}</span></div>
            <div class="contact-line"><i class="fa-solid fa-phone"></i><span>{{$setting->phone2}}</span></div>
            <div class="contact-line"><i class="fa-solid fa-envelope"></i><span>{{$setting->email}}</span></div>
            <div class="contact-line"><i class="fa-regular fa-clock"></i><span>07:30 – 18:00 (T2 – CN)</span></div>
            <a href="tel:{{$setting->phone1}}" class="contact-call"><small>GỌI TQHOME</small><strong>{{$setting->phone1}}</strong></a>
            <button type="button" class="contact-form-btn btn-consult" data-product="Liên hệ cửa hàng"><i class="fa-solid fa-paper-plane"></i> Gửi yêu cầu tư vấn</button>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="map-wrap wow animate__fadeInRight">
           {!!$setting->iframe_map!!}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
