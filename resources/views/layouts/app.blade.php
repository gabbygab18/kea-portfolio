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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    @stack('styles')
</head>

<body>

    <header class="header">
        <div class="header__pill">
            <a class="header__logo" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="header__logo-img" />
            </a>

            <button class="header__toggle" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="bar"></span>
            </button>

            <nav class="header__nav collapse" id="mainNav">
                <a href="{{ route('home') }}"
                    class="header__nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}">HOME</a>
                <a href="{{ route('about') }}"
                    class="header__nav-link {{ request()->routeIs('about') ? 'is-active' : '' }}">ABOUT ME</a>
                <a href="{{ route('artworks') }}"
                    class="header__nav-link {{ request()->routeIs('artworks') || request()->routeIs('project.*') ? 'is-active' : '' }}">ARTWORKS</a>
                <a href="{{ route('seo') }}"
                    class="header__nav-link {{ request()->routeIs('seo') ? 'is-active' : '' }}">SEO</a>
                <a href="{{ route('contact') }}"
                    class="header__nav-link {{ request()->routeIs('contact') ? 'is-active' : '' }}">CONTACT</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    {{-- ── SITE FOOTER — "Like This Hand?" CTA band ─────────────── --}}
    <footer class="site-footer">
        <div class="site-footer__glow site-footer__glow--left" aria-hidden="true"></div>
        <div class="site-footer__glow site-footer__glow--right" aria-hidden="true"></div>

        <div class="site-footer__inner">
            <div class="site-footer__left">
                <img class="site-footer__logo" src="{{ asset('images/logo.png') }}" alt="Logo" />
                <p class="site-footer__text">Like This Hand? Let's Play Another.</p>
            </div>

            <div class="site-footer__btns">
                <a href="{{ route('artworks') }}" class="btn btn--table btn--arrow">
                    Enter the Table <span class="btn__arrow">›</span>
                </a>
                <a href="{{ asset('assets/docs/Keana_Resume_SEO_Highlighted.pdf') }}" download
                    class="btn btn--outline-white">Download CV</a>
            </div>
        </div>
    </footer>

    <div class="toast" id="toast"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')

    <script>
        // ── Smooth scroll for anchor links ───────────────────────────
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (!target) return;
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });

        // ── Scroll-reveal via IntersectionObserver ───────────────────
        const revealEls = document.querySelectorAll(
            '.skill-card, .services__card, .exp-item, .about__content, ' +
            '.newsletter__content, .about-hero__inner, .about-hero__image-wrap'
        );

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) return;
                    const siblings = [...(entry.target.parentElement?.children ?? [])];
                    const delay = siblings.indexOf(entry.target) * 80;
                    setTimeout(() => entry.target.classList.add('visible'), delay);
                    observer.unobserve(entry.target);
                });
            }, {
                threshold: 0.12
            });

            revealEls.forEach(el => {
                el.classList.add('scroll-reveal');
                observer.observe(el);
            });
        }
    </script>

</body>

</html>
