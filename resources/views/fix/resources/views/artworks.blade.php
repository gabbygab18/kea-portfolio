@extends('layouts.app')

@section('title', 'Artworks – Portfolio')

@section('content')

    <section class="artworks-hero">
        <div class="artworks-hero__inner">
            <span class="tuc-section-label">Portfolio</span>
            <h1 class="artworks-hero__title">All Projects</h1>
            <p class="artworks-hero__subtitle">A collection of design and development work.</p>
        </div>
    </section>

    <section class="artworks-grid-section">
        <div class="artworks-grid-section__inner">
            @forelse($artworks as $artwork)
            @php
                $thumb = $artwork->image
                    ? (str_starts_with($artwork->image, 'artworks/')
                        ? asset('storage/' . $artwork->image)
                        : asset('images/' . $artwork->image))
                    : null;
            @endphp
            <a href="{{ route('project.detail', $artwork->slug) }}" class="artwork-card">
                <div class="artwork-card__img-wrap">
                    @if($thumb)
                        <img src="{{ $thumb }}" alt="{{ $artwork->title }}" class="artwork-card__img" />
                    @else
                        <div class="artwork-card__img-placeholder"></div>
                    @endif
                </div>
                <div class="artwork-card__body">
                    @if($artwork->category)
                        <span class="artwork-card__tag">{{ $artwork->category }}</span>
                    @endif
                    <h2 class="artwork-card__title">{{ $artwork->title }}</h2>
                    @if($artwork->description)
                        <p class="artwork-card__desc">{{ Str::limit($artwork->description, 100) }}</p>
                    @endif
                    <span class="artwork-card__cta">View Project ›</span>
                </div>
            </a>
            @empty
            <p class="artworks-empty">No projects yet.</p>
            @endforelse
        </div>
    </section>

@endsection
