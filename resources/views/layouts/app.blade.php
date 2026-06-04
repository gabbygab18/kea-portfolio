<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Portfolio')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    @php $font = \App\Models\Setting::getValue('font_family', 'Inter'); @endphp
    <link href="https://fonts.googleapis.com/css2?family={{ urlencode($font) }}:wght@400;600;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <style>
        body,
        body * {
            font-family: '{{ $font }}', sans-serif !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    @stack('styles')
</head>

<body>

    <header class="header">

        {{-- ── TOPBAR ── --}}
        <div class="header__topbar">
            <div class="header__topbar-inner">

                <div class="header__topbar-left">
                    <div class="header__contact-item">
                        <svg class="header__icon" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <rect x="1.35" y="2.92" width="15.30" height="12.17" rx="1" stroke="white"
                                stroke-width="1.4" fill="none" />
                            <polyline points="2.14,3.65 9,9.25 15.86,3.65" stroke="white" stroke-width="1.4"
                                fill="none" />
                        </svg>
                        <span class="header__contact-text">{{ $siteSettings['contact_email'] ?? 'contact@brixagency.com'
                            }}</span>
                    </div>
                    <div class="header__contact-item">
                        <svg class="header__icon" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path
                                d="M3.5 2.5h3l1.5 3.5-1.8 1.2c.8 1.6 2 2.8 3.6 3.6L11 9l3.5 1.5v3c0 .6-.4 1-1 1C6.8 14.5 2.5 10.2 2.5 4.5c0-.6.4-1 1-1z"
                                stroke="white" stroke-width="1.3" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span
                            class="header__contact-text">{{ $siteSettings['contact_phone'] ?? '(414) 850 - 0417' }}</span>
                    </div>
                </div>

                <div class="header__topbar-right">
                    <a href="{{ $siteSettings['social_facebook'] ?? '#' }}" class="header__social-icon" target="_blank"
                        rel="noopener" aria-label="Facebook">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect width="24" height="24" rx="4" fill="#E7D8C4" />
                            <path
                                d="M13.5 8H12c-.6 0-1 .4-1 1v1.5h2.5l-.4 2.5H11V18H8.5v-5H7v-2.5h1.5V9c0-1.9 1.1-3 3-3H13.5V8z"
                                fill="#531A24" />
                        </svg>
                    </a>
                    <a href="{{ $siteSettings['social_twitter'] ?? '#' }}" class="header__social-icon" target="_blank"
                        rel="noopener" aria-label="Twitter">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect width="24" height="24" rx="4" fill="#E7D8C4" />
                            <path d="M17.5 6h-2L12 10.5 9 6H6l4.8 6L6 18h2l3.8-4.8L15.2 18H18l-5-6.2L17.5 6z"
                                fill="#531A24" />
                        </svg>
                    </a>
                    <a href="{{ $siteSettings['social_instagram'] ?? '#' }}" class="header__social-icon" target="_blank"
                        rel="noopener" aria-label="Instagram">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect width="24" height="24" rx="4" fill="#E7D8C4" />
                            <rect x="6" y="6" width="12" height="12" rx="3" stroke="#531A24" stroke-width="1.5"
                                fill="none" />
                            <circle cx="12" cy="12" r="3" stroke="#531A24" stroke-width="1.5" fill="none" />
                            <circle cx="16" cy="8" r="1" fill="#531A24" />
                        </svg>
                    </a>
                    <a href="{{ $siteSettings['social_linkedin'] ?? '#' }}" class="header__social-icon" target="_blank"
                        rel="noopener" aria-label="LinkedIn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect width="24" height="24" rx="4" fill="#E7D8C4" />
                            <rect x="6" y="10" width="2.5" height="7" fill="#531A24" />
                            <circle cx="7.25" cy="7.5" r="1.25" fill="#531A24" />
                            <path
                                d="M11 10v7h2.5v-3.75c0-1 .5-1.75 1.5-1.75s1.5.75 1.5 1.75V17H19v-4c0-2-1-3-2.75-3-1 0-1.75.5-2.25 1.25V10H11z"
                                fill="#531A24" />
                        </svg>
                    </a>
                    <a href="{{ $siteSettings['social_github'] ?? '#' }}" class="header__social-icon" target="_blank"
                        rel="noopener" aria-label="GitHub">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect width="24" height="24" rx="4" fill="#E7D8C4" />
                            <path
                                d="M12 4C7.58 4 4 7.58 4 12c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38v-1.33c-2.23.48-2.7-1.07-2.7-1.07-.36-.92-.88-1.17-.88-1.17-.72-.49.05-.48.05-.48.8.06 1.22.82 1.22.82.71 1.21 1.86.86 2.31.66.07-.51.28-.86.5-1.06-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82a7.66 7.66 0 012-.27c.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48v2.19c0 .21.15.46.55.38A8.01 8.01 0 0020 12c0-4.42-3.58-8-8-8z"
                                fill="#531A24" />
                        </svg>
                    </a>
                </div>

            </div>
        </div>

        {{-- ── NAVBAR ── --}}
        <nav class="header__navbar navbar navbar-expand-md"
            style="background: #F2E8D9; border-bottom: 1px solid rgba(123,29,46,0.1); position: relative;">
            <div class="container-fluid">

                <a class="header__logo" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="header__logo-img" />
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                    aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="bar"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav ms-auto align-items-md-center gap-md-3 mt-3 mt-md-0">
                        <li class="nav-item">
                            <a href="{{ route('home') }}"
                                class="header__nav-link nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                HOME
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('about') }}"
                                class="header__nav-link nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                                ABOUT ME
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('artworks') }}"
                                class="header__nav-link nav-link {{ request()->routeIs('artworks') || request()->routeIs('project.*') ? 'active' : '' }}">
                                ARTWORKS
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('seo') }}"
                                class="header__nav-link nav-link {{ request()->routeIs('seo') ? 'active' : '' }}">
                                SEO
                            </a>
                        </li>
                        <li class="nav-item mt-2 mt-md-0">
                            <a href="{{ route('contact') }}" class="btn btn--primary">Get in touch</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>

    </header>

    <main>
        @yield('content')
    </main>

    {{-- ── FOOTER ── --}}
    <footer class="footer">
        <div class="footer__inner">
            <div class="footer__top">
                <h3 class="footer__newsletter-title">Get the latest news and updates</h3>
                <p class="footer__newsletter-desc">Subscribe our newsletters to follow the news about our fresh
                    products.</p>
                <div class="footer__socials">
                    <a href="{{ $siteSettings['social_facebook'] ?? '#' }}" class="footer__social" target="_blank"
                        rel="noopener" aria-label="Facebook">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect width="24" height="24" rx="4" fill="rgba(198,183,163,0.74)" />
                            <path
                                d="M13.5 8H12c-.6 0-1 .4-1 1v1.5h2.5l-.4 2.5H11V18H8.5v-5H7v-2.5h1.5V9c0-1.9 1.1-3 3-3H13.5V8z"
                                fill="rgba(83,26,36,0.58)" />
                        </svg>
                    </a>
                    <a href="{{ $siteSettings['social_twitter'] ?? '#' }}" class="footer__social" target="_blank"
                        rel="noopener" aria-label="Twitter">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect width="24" height="24" rx="4" fill="rgba(198,183,163,0.74)" />
                            <path d="M17.5 6h-2L12 10.5 9 6H6l4.8 6L6 18h2l3.8-4.8L15.2 18H18l-5-6.2L17.5 6z"
                                fill="rgba(83,26,36,0.58)" />
                        </svg>
                    </a>
                    <a href="{{ $siteSettings['social_instagram'] ?? '#' }}" class="footer__social" target="_blank"
                        rel="noopener" aria-label="Instagram">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect width="24" height="24" rx="4" fill="rgba(198,183,163,0.74)" />
                            <rect x="6" y="6" width="12" height="12" rx="3" stroke="rgba(83,26,36,0.58)"
                                stroke-width="1.5" fill="none" />
                            <circle cx="12" cy="12" r="3" stroke="rgba(83,26,36,0.58)" stroke-width="1.5" fill="none" />
                            <circle cx="16" cy="8" r="1" fill="rgba(83,26,36,0.58)" />
                        </svg>
                    </a>
                    <a href="{{ $siteSettings['social_linkedin'] ?? '#' }}" class="footer__social" target="_blank"
                        rel="noopener" aria-label="LinkedIn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect width="24" height="24" rx="4" fill="rgba(198,183,163,0.74)" />
                            <rect x="6" y="10" width="2.5" height="7" fill="rgba(83,26,36,0.58)" />
                            <circle cx="7.25" cy="7.5" r="1.25" fill="rgba(83,26,36,0.58)" />
                            <path
                                d="M11 10v7h2.5v-3.75c0-1 .5-1.75 1.5-1.75s1.5.75 1.5 1.75V17H19v-4c0-2-1-3-2.75-3-1 0-1.75.5-2.25 1.25V10H11z"
                                fill="rgba(83,26,36,0.58)" />
                        </svg>
                    </a>
                    <a href="{{ $siteSettings['social_github'] ?? '#' }}" class="footer__social" target="_blank"
                        rel="noopener" aria-label="GitHub">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect width="24" height="24" rx="4" fill="rgba(198,183,163,0.74)" />
                            <path
                                d="M12 4C7.58 4 4 7.58 4 12c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38v-1.33c-2.23.48-2.7-1.07-2.7-1.07-.36-.92-.88-1.17-.88-1.17-.72-.49.05-.48.05-.48.8.06 1.22.82 1.22.82.71 1.21 1.86.86 2.31.66.07-.51.28-.86.5-1.06-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82a7.66 7.66 0 012-.27c.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48v2.19c0 .21.15.46.55.38A8.01 8.01 0 0020 12c0-4.42-3.58-8-8-8z"
                                fill="rgba(83,26,36,0.58)" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="footer__bottom">
                <p class="footer__copy">
                    <span class="footer__copy--muted">Copyright © {{ date('Y') }}
                        {{ $siteSettings['brand_name'] ?? 'MCTechnologies' }}</span>
                    <span class="footer__copy--divider">|</span>
                    <span class="footer__copy--muted"> All Rights Reserved </span>
                    <span class="footer__copy--divider">|</span>
                    <a href="{{ $siteSettings['terms_url'] ?? '#' }}" class="footer__copy--link">Terms and
                        Conditions</a>
                    <span class="footer__copy--divider">|</span>
                    <a href="{{ $siteSettings['privacy_url'] ?? '#' }}" class="footer__copy--link">Privacy Policy</a>
                </p>
            </div>
        </div>
    </footer>

    <div class="toast" id="toast"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')

</body>

</html>
