<header class="header kl-header">
  <div class="container">
     <div class="kl-header__inner">
        <div class="menu-bar d-lg-none d-inline-flex" role="button" tabindex="0" aria-label="Mở menu">
           <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <path fill="currentColor"
                 d="M436 124H12c-6.627 0-12-5.373-12-12V80c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12z"></path>
           </svg>
        </div>

        <a href="{{ route('home') }}" class="logo kl-header__logo" title="Logo">
           <img width="378" height="96"
              src="{{ $setting->logo }}"
              alt="{{ $setting->company }}">
        </a>

        <div class="header-menu header-menu-left kl-header__menu">
           <div class="header-menu-des">
              <nav class="header-nav header-nav--fio">
                 <div class="title_menu">
                    <span class="title_">Menu</span>
                 </div>
                 <ul class="item_big">
                    <li class="nav-item{{ request()->routeIs('home') ? ' active' : '' }}">
                       <div class="nav-item__row nav-item__row--solo">
                          <a class="nav-item__link" href="{{ route('home') }}" title="Trang chủ">Trang chủ</a>
                       </div>
                    </li>
                    <li class="nav-item{{ request()->routeIs('aboutUs') ? ' active' : '' }}">
                       <div class="nav-item__row nav-item__row--solo">
                          <a class="nav-item__link" href="{{ route('aboutUs') }}" title="Giới thiệu">Giới thiệu</a>
                       </div>
                    </li>
                    <li class="nav-item{{ request()->routeIs('allProduct', 'allListProCate', 'allListType', 'allListTypeTwo', 'detailProduct') ? ' active' : '' }}">
                       <div class="nav-item__row nav-item__row--solo">
                          <a class="nav-item__link" href="{{ route('allProduct') }}" title="Sản phẩm">Sản phẩm</a>
                       </div>
                    </li>
                    <li class="nav-item{{ request()->routeIs('processStep') ? ' active' : '' }}">
                       <div class="nav-item__row nav-item__row--solo">
                          <a class="nav-item__link" href="{{ route('processStep') }}" title="Quy trình">Quy trình</a>
                       </div>
                    </li>
                    <li class="nav-item{{ request()->routeIs('duanTieuBieu', 'duanTieuBieuDetail', 'projectCategory') ? ' active' : '' }}">
                       <div class="nav-item__row nav-item__row--solo">
                          <a class="nav-item__link" href="{{ route('duanTieuBieu') }}" title="Hồ sơ">Hồ sơ</a>
                       </div>
                    </li>
                    <li class="nav-item nav-item--label nav-item--drawer-only">
                       <span class="nav-label">Danh mục sản phẩm</span>
                    </li>
                    @foreach ($categoryhome as $item)
                    <li class="nav-item nav-item--drawer-only{{ count($item->typeCate) > 0 ? ' has-childs' : '' }}">
                       <div class="nav-item__row">
                          <a class="nav-item__link{{ $item->avatar ? ' nav-cate-link' : '' }}"
                             href="{{ route('allListProCate', ['danhmuc' => $item->slug]) }}"
                             title="{{ languageName($item->name) }}"
                             @if ($item->avatar) style="background-image: url('{{ url($item->avatar) }}')" @endif>
                             {{ languageName($item->name) }}
                          </a>
                          @if (count($item->typeCate) > 0)
                          <button type="button" class="nav-item__toggle" aria-expanded="false" aria-label="Mở danh mục con {{ languageName($item->name) }}">
                             <svg width="14" height="8" viewBox="0 0 14 8" fill="none" aria-hidden="true">
                                <path d="M1 1.5L7 6.5L13 1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                             </svg>
                          </button>
                          @endif
                       </div>
                       @if (count($item->typeCate) > 0)
                       <ul class="item_small nav-submenu">
                          @foreach ($item->typeCate as $type)
                          <li>
                             <a href="{{ route('allListType', ['danhmuc' => $item->slug, 'loaidanhmuc' => $type->slug]) }}"
                                title="{{ languageName($type->name) }}">
                                {{ languageName($type->name) }}
                             </a>
                          </li>
                          @endforeach
                       </ul>
                       @endif
                    </li>
                    @endforeach
                    <li class="nav-item nav-item--label nav-item--drawer-only">
                       <span class="nav-label">Khám phá thêm</span>
                    </li>
                    <li class="nav-item{{ request()->routeIs('allListBlog', 'listCateBlog', 'detailBlog', 'listTypeBlog') ? ' active' : '' }}{{ ($blogCate ?? collect())->count() > 0 ? ' has-childs' : '' }}">
                       <div class="nav-item__row">
                          <a class="nav-item__link" href="javascript:void(0)" title="Tin tức">Tin tức</a>
                          @if (($blogCate ?? collect())->count() > 0)
                          <button type="button" class="nav-item__toggle" aria-expanded="false" aria-label="Mở danh mục tin tức">
                             <svg width="14" height="8" viewBox="0 0 14 8" fill="none" aria-hidden="true">
                                <path d="M1 1.5L7 6.5L13 1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                             </svg>
                          </button>
                          @endif
                       </div>
                       @if (($blogCate ?? collect())->count() > 0)
                       <ul class="item_small nav-submenu">
                          @foreach ($blogCate as $blogItem)
                          <li>
                             <a href="{{ route('listCateBlog', ['slug' => $blogItem->slug]) }}"
                                title="{{ languageName($blogItem->name) }}">
                                {{ languageName($blogItem->name) }}
                             </a>
                          </li>
                          @endforeach
                       </ul>
                       @endif
                    </li>
                    <li class="nav-item nav-item--drawer-only{{ request()->routeIs('fag') ? ' active' : '' }}">
                       <div class="nav-item__row nav-item__row--solo">
                          <a class="nav-item__link" href="{{ route('fag') }}" title="Câu hỏi thường gặp">Câu hỏi thường gặp</a>
                       </div>
                    </li>
                    <li class="nav-item{{ request()->routeIs('lienHe') ? ' active' : '' }}">
                       <div class="nav-item__row nav-item__row--solo">
                          <a class="nav-item__link" href="{{ route('lienHe') }}" title="Liên hệ">Liên hệ</a>
                       </div>
                    </li>
                 </ul>
              </nav>
           </div>
        </div>

        <a href="tel:{{ $setting->phone1 }}" class="kl-header__phone d-none d-lg-inline-flex" title="{{ $setting->phone1 }}">
           <span class="kl-header__phone-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                 <path d="M7.2 3.8c.4-.4 1-.5 1.5-.3l2.2.8c.5.2.8.7.8 1.3v2.1c0 .4-.2.8-.5 1.1L9.8 10.2c.8 1.7 2.2 3.1 3.9 3.9l1.4-1.4c.3-.3.7-.5 1.1-.5h2.1c.6 0 1.1.3 1.3.8l.8 2.2c.2.5.1 1.1-.3 1.5l-1.2 1.2c-.4.4-1 .6-1.6.5C11.4 17.7 6.3 12.6 5.5 6.6c-.1-.6.1-1.2.5-1.6L7.2 3.8Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
              </svg>
           </span>
           <span>{{ $setting->phone1 }}</span>
        </a>

        <div class="kl-header__tools d-lg-none">
           @include('partials.google-translate-lang')
           {{-- <a href="{{ route('listCart') }}" class="kl-header__cart" title="Giỏ hàng">
              <img width="28" height="28" class="lazyload"
                 src="{{ asset('frontend/images/lazy.png') }}"
                 data-src="/frontend/images/icon_poly_hea_4.png"
                 alt="Giỏ hàng" />
              <span class="count count_item_pr">{{ collect($cartcontent ?? [])->sum('quantity') }}</span>
           </a> --}}
        </div>
     </div>
  </div>
</header>
