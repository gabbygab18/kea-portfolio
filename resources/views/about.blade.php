@extends('layouts.app')

@section('title', 'About')

@section('content')
    <section class="about-hero">
        <div class="about-hero__inner">
            <div class="about-hero__label">About Me</div>
            <h1 class="about-hero__title">{{ $siteSettings['about_hero_title'] ?? 'UI/UX Designer & SEO Specialist' }}</h1>
            <p class="about-hero__summary">
                {{ $siteSettings['about_hero_description'] ?? 'A designer who bridges aesthetics and discoverability — combining user-centered design with data-driven SEO strategies.' }}
            </p>
            <div class="about-hero__cta">
                <a href="{{ route('contact') }}" class="btn btn--primary btn--arrow">Get in touch<span
                        class="btn__arrow">›</span></a>
                <a href="{{ asset('assets/docs/Keana_Resume_SEO_Highlighted.pdf') }}" download
                    class="btn btn--outline-dark">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                        <line x1="12" y1="15" x2="12" y2="3" />
                    </svg>
                    Download CV
                </a>
            </div>
        </div>
        <div class="about-hero__image-wrap">
            <img src="{{ asset('images/picture.png') }}" alt="About" class="about-hero__image" />
            <div class="about-hero__image-badge">
                <span class="about-hero__image-badge-num">{{ $siteSettings['experience_years'] ?? '2+' }}</span>
                <span class="about-hero__image-badge-label">Years of<br />Experience</span>
            </div>
        </div>
    </section>

    {{-- ── SKILLS ── --}}
    <section class="skills">
        <div class="skills__inner">
            <div class="skills__header">
                <h2 class="skills__title">Technical Skills</h2>
                <p class="skills__desc">A cross-disciplinary toolkit spanning design, development, analytics, and SEO.</p>
            </div>
            <div class="skills__grid">
                @foreach($skills as $skill)
                    <div class="skill-card">
                        <div class="skill-card__icon">
                            @if($skill->icon)
                                @if(str_starts_with($skill->icon, 'si:'))
                                    <img src="https://cdn.simpleicons.org/{{ substr($skill->icon, 3) }}" width="28" height="28"
                                        alt="{{ $skill->name }}"
                                        style="object-fit:contain; filter: sepia(1) saturate(2) hue-rotate(300deg) brightness(0.6);" />
                                @else
                                    <i class="{{ $skill->icon }} colored" style="font-size:28px;"></i>
                                @endif
                            @else
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8" />
                                    <path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14" stroke="currentColor"
                                        stroke-width="1.8" stroke-linecap="round" />
                                </svg>
                            @endif
                        </div>
                        <h3 class="skill-card__title">{{ $skill->name }}</h3>
                        <p class="skill-card__desc">{{ $skill->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── EXPERIENCE ── --}}
    <section class="experience">
        <div class="experience__inner">
            <div class="experience__header">
                <h2 class="experience__title">Professional Experience</h2>
                <p class="experience__desc">Hands-on work across design, development, and digital strategy.</p>
            </div>
            <div class="experience__timeline">
                @forelse($experiences as $exp)
                    <div class="exp-item">
                        <div class="exp-item__meta">
                            <div class="exp-item__dot"></div>
                            <span class="exp-item__date">{{ $exp->date_range }}</span>
                            <span class="exp-item__location">{{ $exp->location }}</span>
                        </div>
                        <div class="exp-item__body">
                            <div class="exp-item__company-row">
                                <span class="exp-item__company">{{ $exp->company }}</span>
                                <span class="exp-item__badge">{{ $exp->type }}</span>
                            </div>
                            <h3 class="exp-item__role">{{ $exp->role }}</h3>
                            @if($exp->bullets)
                                <ul class="exp-item__bullets">
                                    @foreach(is_array($exp->bullets) ? $exp->bullets : json_decode($exp->bullets, true) as $bullet)
                                        <li>{{ $bullet }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @empty
                    {{-- fallback: hardcoded entries if no DB records yet --}}
                    <div class="exp-item">
                        <div class="exp-item__meta">
                            <div class="exp-item__dot"></div>
                            <span class="exp-item__date">Feb 2026 – May 2026</span>
                            <span class="exp-item__location">Philippines</span>
                        </div>
                        <div class="exp-item__body">
                            <div class="exp-item__company-row">
                                <span class="exp-item__company">Monte Carlo Technologies</span>
                                <span class="exp-item__badge">Internship</span>
                            </div>
                            <h3 class="exp-item__role">UI/UX Designer &amp; SEO Specialist Intern</h3>
                            <ul class="exp-item__bullets">
                                <li>Designed wireframes, mockups, and high-fidelity prototypes using Figma</li>
                                <li>Conducted user research and usability testing to improve UX and interface consistency</li>
                                <li>Performed on-page and technical SEO audits — optimizing meta tags, heading hierarchies, and
                                    content structure</li>
                                <li>Implemented keyword research and SEO best practices across site content</li>
                                <li>Collaborated with the dev team to ensure accurate design handoffs with SEO standards
                                    integrated</li>
                                <li>Monitored performance via Google Analytics and Google Search Console</li>
                            </ul>
                        </div>
                    </div>
                    <div class="exp-item">
                        <div class="exp-item__meta">
                            <div class="exp-item__dot"></div>
                            <span class="exp-item__date">2022</span>
                            <span class="exp-item__location">Alaminos, Laguna</span>
                        </div>
                        <div class="exp-item__body">
                            <div class="exp-item__company-row">
                                <span class="exp-item__company">Alaminos Integrated National High School</span>
                                <span class="exp-item__badge">Senior High Internship</span>
                            </div>
                            <h3 class="exp-item__role">Web Development Intern</h3>
                            <ul class="exp-item__bullets">
                                <li>Independently designed and developed a fully functional school website from concept to
                                    deployment</li>
                                <li>Built and styled responsive web pages using HTML and CSS</li>
                                <li>Structured site content and navigation architecture for ease of use</li>
                                <li>Conducted thorough testing and iterative refinement for cross-browser functionality</li>
                            </ul>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('partials.contact-newsletter')

@endsection
