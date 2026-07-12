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

    {{-- ===================== HERO ===================== --}}
    <section class="tuc-hero">
        {{-- Ambient glows --}}
        <div class="tuc-glow tuc-glow--left" aria-hidden="true"></div>
        <div class="tuc-glow tuc-glow--right" aria-hidden="true"></div>

        {{-- Floating card scatters (same assets as the Artworks hero) --}}
        <img class="tuc-hero__deco tuc-hero__deco--cards-left" src="{{ asset('images/Untitled_design__10_.png') }}"
            alt="" aria-hidden="true" />
        <img class="tuc-hero__deco tuc-hero__deco--cards-right" src="{{ asset('images/Untitled_design__9_.png') }}"
            alt="" aria-hidden="true" />

        <div class="tuc-hero__inner">
            <div class="tuc-hero__breadcrumb">
                <a href="{{ route('artworks') }}" class="tuc-hero__breadcrumb-link">Artworks</a>
                <span class="tuc-hero__breadcrumb-sep">›</span>
                <span class="tuc-hero__breadcrumb-current">{{ $project->title }}</span>
            </div>

            @if ($project->category)
                <p class="tuc-hero__eyebrow">{{ $project->category }}</p>
            @endif

            <h1 class="tuc-hero__title">{{ $project->title }}</h1>

            @if ($project->description)
                <p class="tuc-hero__subtitle">{{ $project->description }}</p>
            @endif

            <div class="tuc-hero__cta-row">
                @if ($project->link && $project->link !== '#')
                    <a href="{{ $project->link }}" target="_blank" rel="noopener" class="btn btn--table btn--arrow">
                        Enter the Table <span class="btn__arrow">›</span>
                    </a>
                @else
                    <a href="{{ route('artworks') }}" class="btn btn--table btn--arrow">
                        Back to Portfolio <span class="btn__arrow">›</span>
                    </a>
                @endif
            </div>
        </div>
    </section>

    {{-- ===================== READING THE BOARD ===================== --}}
    <section class="tuc-board">
        <div class="tuc-board__inner">
            <div class="tuc-board__content">
                <h2 class="tuc-board__title">Reading the Board</h2>
                <p class="tuc-board__body">{{ $project->meta ?? ($project->description ?? 'A polished project built for client storytelling, user conversion, and digital presentation.') }}</p>
            </div>
        </div>
    </section>

    {{-- ===================== THE GAME PLAN ===================== --}}
    <section class="tuc-plan">
        <div class="tuc-plan__header">
            <h2 class="tuc-plan__title">The Game Plan</h2>
            <p class="tuc-plan__sub">No move is made without a plan. Here's the sequence that shaped this project, from
                first read to final play.</p>
        </div>

        <div class="tuc-plan__cards">
            {{-- The Deal (Research) — club --}}
            <article class="tuc-plan-card">
                <div class="tuc-plan-card__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="#98001B" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="7" r="4.4" />
                        <circle cx="7" cy="13.4" r="4.4" />
                        <circle cx="17" cy="13.4" r="4.4" />
                        <path d="M11 13h2l1.4 8h-4.8L11 13z" />
                    </svg>
                </div>
                <h3 class="tuc-plan-card__title">The Deal (Research)</h3>
                <p class="tuc-plan-card__body">Understanding the user, the market, and the competition. Research methods
                    used: user interviews, competitor analysis, and analytics review.</p>
            </article>

            {{-- The Draw (Wireframes & IA) — heart --}}
            <article class="tuc-plan-card">
                <div class="tuc-plan-card__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="#98001B" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </div>
                <h3 class="tuc-plan-card__title">The Draw (Wireframes &amp; IA)</h3>
                <p class="tuc-plan-card__body">Structuring the site — sitemaps, wireframes, and information architecture
                    built around user flow and business goals.</p>
            </article>

            {{-- The Play (UI Design) — diamond --}}
            <article class="tuc-plan-card">
                <div class="tuc-plan-card__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="#98001B" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 1.5L20 12l-8 10.5L4 12 12 1.5z" />
                    </svg>
                </div>
                <h3 class="tuc-plan-card__title">The Play (UI Design)</h3>
                <p class="tuc-plan-card__body">Turning structure into visual design — color, typography, layout, and
                    interaction design applied with intention.</p>
            </article>
        </div>
    </section>

    {{-- ===================== THE WINNING HAND ===================== --}}
    @php
        $previewUrl = null;
        if ($project->preview_image) {
            $previewUrl = str_starts_with($project->preview_image, 'artworks/')
                ? asset('storage/' . $project->preview_image)
                : asset('images/' . $project->preview_image);
        } elseif ($project->hero_image) {
            $previewUrl = str_starts_with($project->hero_image, 'artworks/')
                ? asset('storage/' . $project->hero_image)
                : asset('images/' . $project->hero_image);
        } elseif ($imgUrl) {
            $previewUrl = $imgUrl;
        }
        $gallery = collect((array) ($project->gallery ?? []))->filter(fn($g) => !empty($g['file']));
    @endphp

    <section class="tuc-hand">
        {{-- Ambient glows --}}
        <div class="tuc-glow tuc-glow--left" aria-hidden="true"></div>
        <div class="tuc-glow tuc-glow--right-top" aria-hidden="true"></div>
        <div class="tuc-glow tuc-glow--right-mid" aria-hidden="true"></div>

        <div class="tuc-hand__header">
            <h2 class="tuc-hand__title">The Winning Hand</h2>
            <p class="tuc-hand__sub">A look at the final design — every screen, every detail, placed with purpose.</p>
        </div>

        @if ($gallery->isNotEmpty())
            <div class="tuc-hand__grid">
                @foreach ($gallery as $item)
                    <figure class="tuc-hand__item">
                        <img src="{{ str_starts_with($item['file'], 'artworks/') ? asset('storage/' . $item['file']) : asset('images/' . $item['file']) }}"
                            alt="{{ $item['label'] ?? $project->title }}" loading="lazy" />
                        @if (!empty($item['label']))
                            <figcaption class="tuc-hand__item-label">{{ $item['label'] }}</figcaption>
                        @endif
                    </figure>
                @endforeach
            </div>
        @elseif ($previewUrl)
            <div class="tuc-hand__single">
                <img src="{{ $previewUrl }}" alt="{{ $project->title }} preview" loading="lazy" />
            </div>
        @endif

        {{-- Bottom CTA band now lives in layouts/app.blade.php as the global
             .site-footer — removed here so it doesn't render twice. --}}
    </section>

@endsection
