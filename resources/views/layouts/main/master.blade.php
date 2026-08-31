{{-- https://bean-tools.mysapo.net/ --}}
<!DOCTYPE html>
<html lang="vi">
   <head>
      @php
      $seoCanonical = trim($__env->yieldContent('canonical')) ?: seo_canonical_url();
      $seoRobots = trim($__env->yieldContent('robots')) ?: seo_robots_directive();
      $seoTitle = trim($__env->yieldContent('title'));
      $seoDescription = trim($__env->yieldContent('description'));
      $seoImage = trim($__env->yieldContent('image'));
      $seoSiteName = $setting->webname ?? ($setting->company ?? config('app.name'));
      @endphp
      <meta charset="UTF-8" />
      <meta name="theme-color" content="#d70018">
      <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{ $seoTitle }}</title>
      <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
      <meta http-equiv="Content-Language" content="vi" />
      <link rel="alternate" href="{{ $seoCanonical }}" hreflang="vi" />
      <meta name="description" content="{{ $seoDescription }}">
      <meta name="robots" content="{{ $seoRobots }}" />
      <meta name="googlebot" content="{{ $seoRobots }}">
      <meta name="revisit-after" content="3 days" />
      <meta name="rating" content="General">
      <meta name="application-name" content="{{ $seoSiteName }}" />
      <meta name="theme-color" content="#ed3235" />
      <meta name="msapplication-TileColor" content="#ed3235" />
      <meta name="apple-mobile-web-app-capable" content="yes" />
      <meta name="apple-mobile-web-app-title" content="{{ $seoSiteName }}" />
      @if ($seoImage)
      <link rel="apple-touch-icon-precomposed" href="{{ $seoImage }}" sizes="700x700">
      @endif
      <meta property="og:url" content="{{ $seoCanonical }}">
      <meta property="og:title" content="{{ $seoTitle }}">
      <meta property="og:description" content="{{ $seoDescription }}">
      <meta property="og:image" content="{{ $seoImage }}">
      <meta property="og:site_name" content="{{ $seoSiteName }}">
      <meta property="og:image:alt" content="{{ $seoTitle }}">
      <meta property="og:type" content="website" />
      <meta property="og:locale" content="vi_VN" />
      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:title" content="{{ $seoTitle }}" />
      <meta name="twitter:description" content="{{ $seoDescription }}" />
      <meta name="twitter:image" content="{{ $seoImage }}" />
      <meta name="twitter:url" content="{{ $seoCanonical }}" />
      <meta itemprop="name" content="{{ $seoTitle }}">
      <meta itemprop="description" content="{{ $seoDescription }}">
      <meta itemprop="image" content="{{ $seoImage }}">
      <meta itemprop="url" content="{{ $seoCanonical }}">
      <link rel="canonical" href="{{ $seoCanonical }}">
      @if ($seoImage)
      <link rel="image_src" href="{{ $seoImage }}" />
      @endif
      <link rel="shortcut icon" href="{{ url('' . $setting->favicon) }}" type="image/x-icon">
      <link rel="icon" href="{{ url('' . $setting->favicon) }}" type="image/x-icon">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      @hasSection('schema')
      @yield('schema')
      @else
      @include('partials.seo-organization')
      @endif
      <!-- Styles Include -->
      <link rel="preconnect" href="https://cdn.jsdelivr.net">
  <link rel="preconnect" href="https://cdnjs.cloudflare.com">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/frontend/css/style.css">
      @yield('css')
   </head>
   <body>
      <header class="site-header">
         <div class="container h-100 d-flex align-items-center justify-content-between">
           <a href="#trang-chu" aria-label="TQHome">
             <img class="brand-logo" src="{{$setting->logo}}" alt="TQHome">
           </a>
       
           <nav class="nav-menu d-flex desktop-only">
             <a class="active" href="#trang-chu">TRANG CHỦ</a>
             <a href="#san-pham">SẢN PHẨM</a>
             <a href="#ve-tqhome">VỀ TQHOME</a>
             <a href="#uu-diem">ƯU ĐIỂM</a>
             <a href="#cam-ket">CAM KẾT</a>
             <a href="#lien-he">LIÊN HỆ</a>
           </nav>
       
           <a href="tel:{{$setting->phone1}}" class="header-contact desktop-only">
             <span class="icon"><i class="fa-solid fa-phone"></i></span>
             <span><strong>{{$setting->phone1}}</strong><small>Tư vấn & hỗ trợ</small></span>
           </a>
       
           <button class="mobile-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileNav" aria-label="Mở menu">
             <i class="fa-solid fa-bars"></i>
           </button>
         </div>
       </header>
       
       <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileNav">
         <div class="offcanvas-header">
           <strong style="color:var(--primary)">TQHOME</strong>
           <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
         </div>
         <div class="offcanvas-body">
           <div class="list-group list-group-flush">
             <a class="list-group-item py-3" href="#trang-chu" data-bs-dismiss="offcanvas">Trang chủ</a>
             <a class="list-group-item py-3" href="#san-pham" data-bs-dismiss="offcanvas">Sản phẩm</a>
             <a class="list-group-item py-3" href="#ve-tqhome" data-bs-dismiss="offcanvas">Về TQHome</a>
             <a class="list-group-item py-3" href="#uu-diem" data-bs-dismiss="offcanvas">Ưu điểm</a>
             <a class="list-group-item py-3" href="#cam-ket" data-bs-dismiss="offcanvas">Cam kết</a>
             <a class="list-group-item py-3" href="#lien-he" data-bs-dismiss="offcanvas">Liên hệ</a>
           </div>
         </div>
       </div>
       
      @yield('content')
       
       <footer>
         <div class="container">
           <div class="row g-4">
             <div class="col-lg-4">
               <img class="footer-logo" src="{{$setting->logo_footer}}" alt="TQHome">
               <p>{!!$setting->webname!!}</p>
               <div class="social">
                 <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                 <a href="#" aria-label="Zalo"><i class="fa-solid fa-comment-dots"></i></a>
                 <a href="#" aria-label="Youtube"><i class="fa-brands fa-youtube"></i></a>
                 <a href="#" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
               </div>
             </div>
             <div class="col-6 col-lg-2"><h4>DANH MỤC</h4><ul><li><a href="#san-pham">Thiết bị điện</a></li><li><a href="#san-pham">Thiết bị vệ sinh</a></li><li><a href="#san-pham">Sen vòi</a></li><li><a href="#san-pham">Bồn nước</a></li><li><a href="#san-pham">Máy lọc nước</a></li><li><a href="#san-pham">Kim khí</a></li></ul></div>
             <div class="col-6 col-lg-2"><h4>TQHOME</h4><ul><li><a href="#ve-tqhome">Giới thiệu</a></li><li><a href="#ve-tqhome">Lịch sử 20 năm</a></li><li><a href="#uu-diem">Ưu điểm</a></li><li><a href="#cam-ket">Cam kết</a></li><li><a href="#bai-viet">Bài viết</a></li></ul></div>
             <div class="col-6 col-lg-2"><h4>LIÊN HỆ</h4><ul><li>{{$setting->address1}}</li><li>{{$setting->phone1}}</li></ul></div>
           </div>
           <div class="footer-bottom">© 2026 TQHome. All rights reserved.</div>
         </div>
       </footer>
       
       @php
         $floatPhone = trim((string) ($setting->phone1 ?? ''));
         $floatPhoneDigits = preg_replace('/\D+/', '', $floatPhone);
         $floatZaloSetting = isset($setting->zalo) ? trim((string) $setting->zalo) : '';
         if ($floatZaloSetting !== '') {
           $floatZaloUrl = preg_match('#^https?://#i', $floatZaloSetting) ? $floatZaloSetting : 'https://zalo.me/' . preg_replace('/\D+/', '', $floatZaloSetting);
         } elseif ($floatPhoneDigits !== '') {
           $floatZaloNumber = strpos($floatPhoneDigits, '0') === 0
             ? '84' . substr($floatPhoneDigits, 1)
             : $floatPhoneDigits;
           $floatZaloUrl = 'https://zalo.me/' . $floatZaloNumber;
         } else {
           $floatZaloUrl = 'https://zalo.me/84388380637';
         }
         $floatMapQuery = trim((string) ($setting->address1 ?? ''));
         if ($floatMapQuery === '') {
           $floatMapQuery = 'TQHome Thanh Hoa';
         } else {
           $floatMapQuery = 'TQHome, ' . $floatMapQuery;
         }
         $floatMapUrl = 'https://maps.app.goo.gl/r3rCS77EQoCGYmae9';
       @endphp
       <div class="floating-actions" aria-label="Liên hệ nhanh TQHome">
         <div class="floating-action-item">
           <a href="#" class="floating-btn floating-quote btn-consult" data-product="Báo giá" aria-label="Yêu cầu báo giá TQHome">
             <span class="floating-btn-ring" aria-hidden="true"></span>
             <span class="floating-btn-ring floating-btn-ring--delay" aria-hidden="true"></span>
             <span class="floating-btn-shine" aria-hidden="true"></span>
             <i class="fa-solid fa-file-invoice-dollar"></i>
             <span class="floating-btn-label">Báo giá</span>
           </a>
           <span class="floating-btn-caption">Báo giá</span>
         </div>
         <div class="floating-action-item">
           <a href="{{ $floatMapUrl }}" class="floating-btn floating-map" target="_blank" rel="noopener noreferrer" aria-label="Chỉ đường tới TQHome trên Google Maps">
             <span class="floating-btn-ring" aria-hidden="true"></span>
             <span class="floating-btn-ring floating-btn-ring--delay" aria-hidden="true"></span>
             <span class="floating-btn-shine" aria-hidden="true"></span>
             <i class="fa-solid fa-location-dot"></i>
             <span class="floating-btn-label">Chỉ đường</span>
           </a>
           <span class="floating-btn-caption">Chỉ đường</span>
         </div>
         <div class="floating-action-item">
           <a href="tel:{{ $floatPhone }}" class="floating-btn floating-phone" aria-label="Gọi hotline {{ $floatPhone }}">
             <span class="floating-btn-ring" aria-hidden="true"></span>
             <span class="floating-btn-ring floating-btn-ring--delay" aria-hidden="true"></span>
             <span class="floating-btn-shine" aria-hidden="true"></span>
             <i class="fa-solid fa-phone"></i>
             <span class="floating-btn-label">Hotline</span>
           </a>
           <span class="floating-btn-caption">Hotline</span>
         </div>
         <div class="floating-action-item">
           <a href="{{ $floatZaloUrl }}" class="floating-btn floating-zalo" target="_blank" rel="noopener noreferrer" aria-label="Chat Zalo TQHome">
             <span class="floating-btn-ring" aria-hidden="true"></span>
             <span class="floating-btn-ring floating-btn-ring--delay" aria-hidden="true"></span>
             <span class="floating-btn-shine" aria-hidden="true"></span>
             <i class="fa-solid fa-comment-dots"></i>
             <span class="floating-btn-label">Zalo</span>
           </a>
           <span class="floating-btn-caption">Zalo</span>
         </div>
       </div>
       
       <!-- CONSULT MODAL -->
       <div class="modal fade consult-modal" id="consultModal" tabindex="-1" aria-labelledby="consultModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
           <div class="modal-content consult-modal-content">
             <div class="consult-modal-header">
               <button type="button" class="consult-modal-close" data-bs-dismiss="modal" aria-label="Đóng"><i class="fa-solid fa-xmark"></i></button>
               <div class="consult-modal-icon"><i class="fa-solid fa-headset"></i></div>
               <div class="eyebrow" style="color:#cbd9f4">TQHOME • TƯ VẤN MIỄN PHÍ</div>
               <h2 id="consultModalLabel">Đăng ký nhận tư vấn</h2>
               <p>Điền thông tin bên dưới, TQHome sẽ liên hệ tư vấn sản phẩm phù hợp với nhu cầu của bạn.</p>
             </div>
       
             <div class="consult-modal-body">
               <form id="consultForm" class="consult-form" action="{{ route('postcontact') }}" method="post" novalidate>
                 @csrf
                 <input type="hidden" name="ajax" value="1">
                 <div class="consult-field">
                   <label for="consultName">Họ và tên <span>*</span></label>
                   <input type="text" id="consultName" name="name" placeholder="Nhập họ tên của bạn" required autocomplete="name">
                 </div>
                 <div class="consult-field">
                   <label for="consultPhone">Số điện thoại <span>*</span></label>
                   <input type="tel" id="consultPhone" name="phone" placeholder="VD: {{ $setting->phone1 }}" required autocomplete="tel">
                 </div>
                 <div class="consult-field">
                   <label for="consultProduct">Sản phẩm quan tâm</label>
                   <select id="consultProduct" name="product">
                     <option value="">-- Chọn danh mục --</option>
                     <option value="Báo giá">Báo giá sản phẩm</option>
                     <option value="Thiết bị điện">Thiết bị điện</option>
                     <option value="Thiết bị vệ sinh">Thiết bị vệ sinh</option>
                     <option value="Sen vòi & phụ kiện">Sen vòi & phụ kiện</option>
                     <option value="Bồn nước">Bồn nước</option>
                     <option value="Máy lọc nước">Máy lọc nước</option>
                     <option value="Kim khí">Kim khí</option>
                     <option value="Vật tư điện nước">Vật tư điện nước</option>
                     <option value="Phụ kiện công trình">Phụ kiện công trình</option>
                     <option value="Tư vấn chung">Tư vấn chung / Khác</option>
                   </select>
                 </div>
                 <div class="consult-field">
                   <label for="consultNote">Nhu cầu / Ghi chú</label>
                   <textarea id="consultNote" name="note" rows="3" placeholder="Mô tả ngắn nhu cầu công trình, số lượng hoặc sản phẩm cần tư vấn..."></textarea>
                 </div>
                 <p id="consultFormError" class="consult-form-error" hidden></p>
                 <button type="submit" class="consult-submit" id="consultSubmit"><i class="fa-solid fa-paper-plane"></i> <span>Gửi yêu cầu tư vấn</span></button>
                 <p class="consult-note"><i class="fa-solid fa-shield-halved"></i> Thông tin được bảo mật. Hotline: <a href="tel:{{$setting->phone1}}">{{$setting->phone1}}</a></p>
               </form>
       
               <div id="consultSuccess" class="consult-success" hidden>
                 <div class="consult-success-icon"><i class="fa-solid fa-circle-check"></i></div>
                 <h3>Đã gửi yêu cầu thành công!</h3>
                 <p>Cảm ơn bạn đã liên hệ TQHome. Chúng tôi sẽ phản hồi trong thời gian sớm nhất.</p>
                 <div class="consult-success-actions">
                   <a href="tel:{{$setting->phone1}}" class="consult-call-btn"><i class="fa-solid fa-phone"></i> Gọi ngay {{$setting->phone1}}</a>
                   <button type="button" class="consult-close-btn" data-bs-dismiss="modal">Đóng</button>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
       <script>
         if (typeof WOW !== "undefined") {
           new WOW({
             boxClass: "wow",
             animateClass: "animate__animated",
             offset: 60,
             mobile: true,
             live: true
           }).init();
         }
       
         const heroVideo = document.querySelector(".hero-video");
         if (heroVideo) {
           heroVideo.muted = true;
           const play = () => {
             const p = heroVideo.play();
             if (p && p.catch) p.catch(() => {});
           };
           heroVideo.addEventListener("canplay", play, {once:true});
           heroVideo.addEventListener("error", () => {
             heroVideo.style.display = "none";
           });
           play();
         }
       
         document.querySelectorAll('a[href^="#"]').forEach(link => {
           if (link.classList.contains("btn-consult")) return;
           link.addEventListener("click", e => {
             const target = document.querySelector(link.getAttribute("href"));
             if (!target) return;
             e.preventDefault();
             window.scrollTo({
               top: target.getBoundingClientRect().top + window.scrollY - 70,
               behavior: "smooth"
             });
           });
         });
       
         const sections = document.querySelectorAll("section[id]");
         const navLinks = document.querySelectorAll(".nav-menu a");
         const observer = new IntersectionObserver(entries => {
           entries.forEach(entry => {
             if (entry.isIntersecting) {
               navLinks.forEach(a => a.classList.toggle("active", a.getAttribute("href") === "#" + entry.target.id));
             }
           });
         }, {rootMargin:"-35% 0px -55% 0px", threshold:0});
         sections.forEach(s => observer.observe(s));
       
         const consultModalEl = document.getElementById("consultModal");
         const consultForm = document.getElementById("consultForm");
         const consultSuccess = document.getElementById("consultSuccess");
         const consultProduct = document.getElementById("consultProduct");
         const consultSubmit = document.getElementById("consultSubmit");
         const consultFormError = document.getElementById("consultFormError");
         const consultTitle = document.getElementById("consultModalLabel");
         const consultDesc = consultModalEl ? consultModalEl.querySelector(".consult-modal-header p") : null;
       
         if (consultModalEl && consultForm) {
           const consultModal = new bootstrap.Modal(consultModalEl);
           const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content") || "";
       
           const setConsultError = (message) => {
             if (!consultFormError) return;
             if (!message) {
               consultFormError.hidden = true;
               consultFormError.textContent = "";
               return;
             }
             consultFormError.hidden = false;
             consultFormError.textContent = message;
           };
       
           const setSubmitting = (busy) => {
             if (!consultSubmit) return;
             consultSubmit.disabled = busy;
             consultSubmit.classList.toggle("is-loading", busy);
             const label = consultSubmit.querySelector("span");
             if (label) label.textContent = busy ? "Đang gửi..." : "Gửi yêu cầu tư vấn";
           };
       
           const openConsultModal = (product = "") => {
             consultForm.hidden = false;
             consultSuccess.hidden = true;
             consultForm.reset();
             setConsultError("");
             setSubmitting(false);
             if (product) {
               const match = Array.from(consultProduct.options).find(o => o.value === product);
               consultProduct.value = match ? product : "Tư vấn chung";
             }
             if (consultTitle && consultDesc) {
               const isQuote = product === "Báo giá";
               consultTitle.textContent = isQuote ? "Yêu cầu báo giá" : "Đăng ký nhận tư vấn";
               consultDesc.textContent = isQuote
                 ? "Điền thông tin bên dưới, TQHome sẽ liên hệ báo giá sản phẩm phù hợp với nhu cầu của bạn."
                 : "Điền thông tin bên dưới, TQHome sẽ liên hệ tư vấn sản phẩm phù hợp với nhu cầu của bạn.";
             }
             consultModal.show();
             setTimeout(() => document.getElementById("consultName")?.focus(), 350);
           };
       
           document.querySelectorAll(".btn-consult").forEach(btn => {
             btn.addEventListener("click", e => {
               e.preventDefault();
               openConsultModal(btn.dataset.product || "");
             });
           });
       
           consultModalEl.addEventListener("hidden.bs.modal", () => {
             consultForm.hidden = false;
             consultSuccess.hidden = true;
             consultForm.reset();
             setConsultError("");
             setSubmitting(false);
             consultForm.querySelectorAll(".is-invalid").forEach(el => el.classList.remove("is-invalid"));
           });
       
           consultForm.addEventListener("submit", e => {
             e.preventDefault();
             const name = document.getElementById("consultName");
             const phone = document.getElementById("consultPhone");
             let valid = true;
             setConsultError("");
       
             [name, phone].forEach(field => {
               const ok = field.value.trim().length > 0;
               field.classList.toggle("is-invalid", !ok);
               if (!ok) valid = false;
             });
       
             const phoneVal = phone.value.replace(/\D/g, "");
             if (phoneVal.length < 9 || phoneVal.length > 11) {
               phone.classList.add("is-invalid");
               valid = false;
             }
       
             if (!valid) {
               setConsultError("Vui lòng nhập họ tên và số điện thoại hợp lệ.");
               return;
             }
       
             const formData = new FormData(consultForm);
             setSubmitting(true);
       
             fetch(consultForm.getAttribute("action"), {
               method: "POST",
               headers: {
                 "X-CSRF-TOKEN": csrfToken,
                 "X-Requested-With": "XMLHttpRequest",
                 "Accept": "application/json"
               },
               body: formData
             })
               .then(async response => {
                 let payload = {};
                 try {
                   payload = await response.json();
                 } catch (err) {
                   payload = {};
                 }
                 if (!response.ok || payload.success === false) {
                   throw new Error(payload.message || "Gửi yêu cầu thất bại. Vui lòng thử lại.");
                 }
                 consultForm.hidden = true;
                 consultSuccess.hidden = false;
               })
               .catch(error => {
                 setConsultError(error.message || "Gửi yêu cầu thất bại. Vui lòng thử lại.");
               })
               .finally(() => {
                 setSubmitting(false);
               });
           });
         }
       </script>
      @yield('js')
   </body>
</html>