@extends('layouts.app')

@section('title', $project->title . ' – Project Detail | Portfolio')

@php
    $imgUrl = $project->image
        ? (str_starts_with($project->image, 'artworks/')
            ? asset('storage/' . $project->image)
            : asset('images/' . $project->image))
        : null;
@endphp

@section('content')

    {{-- ===================== PROJECT HERO ===================== --}}
    <section class="tuc-hero">
        <div class="tuc-hero__inner">

            {{-- LEFT: all text content --}}
            <div class="tuc-hero__left">
                <div class="tuc-hero__breadcrumb">
                    <a href="{{ route('artworks') }}" class="tuc-hero__breadcrumb-link">Artworks</a>
                    <span class="tuc-hero__breadcrumb-sep">›</span>
                    <span class="tuc-hero__breadcrumb-current">{{ $project->title }}</span>
                </div>
                <div class="tuc-hero__meta">
                    @if($project->category)
                        <span class="tuc-hero__tag">{{ $project->category }}</span>
                    @endif
                </div>
                <h1 class="tuc-hero__title">{{ $project->title }}</h1>
                @if($project->description)
                    <p class="tuc-hero__subtitle">{{ $project->description }}</p>
                @endif
                <div class="tuc-hero__cta-row">
                    @if($project->link && $project->link !== '#')
                        <a href="{{ $project->link }}" target="_blank" rel="noopener" class="btn btn--primary btn--arrow">
                            Visit Live Site <span class="btn__arrow">›</span>
                        </a>
                    @endif
                    <a href="{{ route('artworks') }}" class="btn btn--outline-dark">← Back to Portfolio</a>
                </div>
            </div>

            {{-- RIGHT: mockup --}}
            <div class="tuc-hero__mockup">
                @if($project->hero_image)
                    @php
                        $heroUrl = str_starts_with($project->hero_image, 'artworks/')
                            ? asset('storage/' . $project->hero_image)
                            : asset('images/' . $project->hero_image);
                    @endphp
                    <img src="{{ $heroUrl }}" alt="{{ $project->title }}" />
                @elseif($imgUrl)
                    <img src="{{ $imgUrl }}" alt="{{ $project->title }}" />
                @endif

                @if(!empty($project->stats))
                    @php $positions = ['tuc-hero__badge--top-right', 'tuc-hero__badge--bottom-left', 'tuc-hero__badge--bottom-right']; @endphp
                    @foreach(array_slice((array) $project->stats, 0, 3) as $i => $stat)
                        <div class="tuc-hero__badge {{ $positions[$i] ?? '' }}">
                            <span class="tuc-hero__badge-value">{{ $stat['value'] }}</span>
                            <span class="tuc-hero__badge-label">{{ $stat['label'] }}</span>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </section>

    {{-- ===================== WHY / OVERVIEW ===================== --}}
    <section class="tuc-why">
        <div class="tuc-why__inner">
            <div class="tuc-why__content">
                <span class="tuc-section-label">Project Overview</span>
                <h2 class="tuc-why__title">What this project delivered</h2>
                <p class="tuc-why__body">
                    {{ $project->meta ?? $project->description ?? 'A polished project built for client storytelling, user conversion, and digital presentation.' }}
                </p>
            </div>
            <div class="tuc-why__quote-wrap">
                <blockquote class="tuc-why__quote">
                    <svg class="tuc-why__quote-icon" width="40" height="32" viewBox="0 0 40 32" fill="none">
                        <path
                            d="M0 32V20C0 14.667 1.333 10.333 4 7C6.667 3.667 10.667 1.333 16 0L17.6 3.2C14.933 4.133 12.933 5.6 11.6 7.6C10.267 9.467 9.6 11.8 9.6 14.6H16V32H0ZM24 32V20C24 14.667 25.333 10.333 28 7C30.667 3.667 34.667 1.333 40 0L41.6 3.2C38.933 4.133 36.933 5.6 35.6 7.6C34.267 9.467 33.6 11.8 33.6 14.6H40V32H24Z"
                            fill="currentColor" opacity="0.2" />
                    </svg>
                    @if(!empty($project->tools))
                        <p>Tools used: {{ implode(', ', (array) $project->tools) }}</p>
                    @endif
                    <cite class="tuc-why__quote-cite">— {{ $siteSettings['brand_name'] ?? 'Keana' }}, Designer &amp;
                        Developer</cite>
                </blockquote>
            </div>
        </div>
    </section>

    {{-- ===================== FULL-WIDTH PREVIEW ===================== --}}
    @if($imgUrl)
        <section class="tuc-preview">
            <img src="{{ $imgUrl }}" alt="{{ $project->title }} preview" />
        </section>
    @endif

    {{-- ===================== DESIGN PROCESS ===================== --}}
    <section class="tuc-process">
        <div class="tuc-process__inner">
            <div class="tuc-process__left">
                <span class="tuc-section-label">Behind the Build</span>
                <h2 class="tuc-process__title">Design Process &amp; Approach</h2>
                <p class="tuc-process__body">{{ $project->description }}</p>
                @if(!empty($project->tools))
                    <div class="tuc-process__tools">
                        <span class="tuc-process__tool-label">Tools Used</span>
                        <div class="tuc-process__tool-tags">
                            @foreach((array) $project->tools as $tool)
                                <span class="tuc-process__tag">{{ $tool }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="tuc-process__right">
                <div class="tuc-process__steps">
                    <div class="tuc-process__step">
                        <div class="tuc-process__step-num">01</div>
                        <div class="tuc-process__step-body">
                            <h4>Discovery &amp; Research</h4>
                            <p>User interviews, competitor analysis, and accessibility audit of existing platforms.</p>
                        </div>
                    </div>
                    <div class="tuc-process__step">
                        <div class="tuc-process__step-num">02</div>
                        <div class="tuc-process__step-body">
                            <h4>Wireframing &amp; IA</h4>
                            <p>Information architecture mapping, low-fidelity wireframes, and user flow validation.</p>
                        </div>
                    </div>
                    <div class="tuc-process__step">
                        <div class="tuc-process__step-num">03</div>
                        <div class="tuc-process__step-body">
                            <h4>Visual Design</h4>
                            <p>Brand system creation — color, typography, component library — all in Figma.</p>
                        </div>
                    </div>
                    <div class="tuc-process__step">
                        <div class="tuc-process__step-num">04</div>
                        <div class="tuc-process__step-body">
                            <h4>Build &amp; Launch</h4>
                            <p>Pixel-perfect build with responsive breakpoints, animations, and performance optimization.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== GALLERY ===================== --}}
    @if(!empty($project->gallery) && count((array) $project->gallery))
        <section class="tuc-gallery">
            <div class="tuc-gallery__inner">
                <div class="tuc-gallery__header">
                    <span class="tuc-section-label">More Screens</span>
                    <h2 class="tuc-gallery__title">Project Screenshots</h2>
                </div>
                <div class="tuc-gallery__grid">
                    @foreach((array) $project->gallery as $item)
                        <div class="tuc-gallery__item">
                            <img src="{{ str_starts_with($item['file'], 'artworks/') ? asset('storage/' . $item['file']) : asset('images/' . $item['file']) }}"
                                alt="{{ $item['label'] ?? '' }}" />
                            <div class="tuc-gallery__item-overlay">
                                <span>{{ $item['label'] ?? '' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ===================== NEXT PROJECT CTA ===================== --}}
    <section class="tuc-next">
        <div class="tuc-next__inner">
            @if(isset($next) && $next)
                <span class="tuc-section-label tuc-section-label--light">Next Project</span>
                <h2 class="tuc-next__title">{{ $next->title }}</h2>
                <p class="tuc-next__desc">{{ $next->description }}</p>
                <a href="{{ route('project.detail', $next->slug) }}" class="btn btn--primary btn--arrow">
                    View Project <span class="btn__arrow">›</span>
                </a>
            @else
                <span class="tuc-section-label tuc-section-label--light">Next Project</span>
                <h2 class="tuc-next__title">Explore More Work</h2>
                <p class="tuc-next__desc">Each project tells a different story. Browse the full portfolio to see what else has
                    been crafted.</p>
                <a href="{{ route('artworks') }}" class="btn btn--primary btn--arrow">
                    View All Projects <span class="btn__arrow">›</span>
                </a>
            @endif
        </div>
    </section>

@endsection
