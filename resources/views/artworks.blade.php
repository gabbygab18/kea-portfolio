@extends('layouts.app')

@section('title', 'Artworks')

@section('content')
    <section class="artworks-hero">
        <p class="artworks-hero__eyebrow">Portfolio</p>
        <h1 class="artworks-hero__title">All Artworks & Projects</h1>
        <p class="artworks-hero__desc">A collection of web design, development, and branding projects crafted with care.</p>
    </section>

    {{-- FILTER BAR --}}
    {{-- FILTER BAR --}}
    <div class="filter-bar">
        <div class="filter-bar__inner">
            <button class="filter-btn active" data-filter="all">All</button>
            @foreach($categories as $category)
                <button class="filter-btn" data-filter="{{ Str::slug($category) }}">
                    {{ $category }}
                </button>
            @endforeach
        </div>
    </div>

    <section class="artworks-grid-section">
        <div class="artworks-grid-section__inner">
            <div class="artworks-grid" id="artworksGrid">
                @foreach($artworks as $artwork)
                    @php
                        $idx = $loop->index;
                        $thumb = $artwork->image
                            ? (str_starts_with($artwork->image, 'artworks/')
                                ? asset('storage/' . $artwork->image)
                                : asset('images/' . $artwork->image))
                            : null;
                    @endphp
                   <div class="artwork-card" data-category="{{ Str::slug($artwork->category) }}" data-idx="{{ $idx }}" onclick="window.location='{{ route('project.detail', $artwork->slug) }}'">
                        <div class="artwork-card__img-wrap">
                            @if($thumb)
                                <img src="{{ $thumb }}" alt="{{ $artwork->title }}" />
                            @endif
                            <span class="artwork-card__tag">{{ $artwork->category }}</span>
                        </div>
                        <div class="artwork-card__body">
                            <div class="artwork-card__meta">
                                <div class="artwork-card__author">
                                    <img src="{{ asset('images/logo.png') }}" alt="Avatar" class="artwork-card__avatar" />
                                    <span class="artwork-card__name">{{ $siteSettings['brand_name'] ?? '@keanariela' }}</span>
                                </div>
                                {{-- LIKE & SAVE BUTTONS --}}
                                <div class="artwork-card__actions">
                                    <button class="artwork-card__icon-btn btn-heart" data-idx="{{ $idx }}" title="Like">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#7B1D2E"
                                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 000-7.78z" />
                                        </svg>
                                    </button>
                                    <button class="artwork-card__icon-btn btn-save" data-idx="{{ $idx }}" title="Save">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7B1D2E"
                                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <h2 class="artwork-card__title">{{ $artwork->title }}</h2>
                            <p class="artwork-card__desc">{{ $artwork->description }}</p>
                            <div class="artwork-card__footer">
                                <a href="{{ route('project.detail', $artwork->slug) }}" class="artwork-card__link">
                                    View project
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#7B1D2E"
                                        stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                        <polyline points="12 5 19 12 12 19" />
                                    </svg>
                                </a>
                                <div class="artwork-card__tools">
                                    @foreach($artwork->tools ?? [] as $tool)
                                        <span class="artwork-card__tool-badge">{{ $tool }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="load-more">
                <button class="btn btn--outline-dark" id="loadMoreBtn">Load more projects ›</button>
            </div>
        </div>
    </section>

    @include('partials.contact-newsletter')

@endsection

@push('scripts')
    <script>
        /* TOAST */
        function showToast(msg) {
            const t = document.getElementById('toast');
            t.textContent = msg;
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 2200);
        }

        /* LIKE & SAVE */
        const liked = new Set();
        const saved = new Set();

        document.addEventListener('click', e => {
            const heart = e.target.closest('.btn-heart');
            if (heart) {
                const idx = +heart.dataset.idx;
                document.querySelectorAll(`.btn-heart[data-idx="${idx}"]`).forEach(b => {
                    liked.has(idx) ? b.classList.remove('liked') : b.classList.add('liked');
                });
                liked.has(idx) ? (liked.delete(idx), showToast('Removed from likes')) : (liked.add(idx), showToast('❤️ Liked!'));
            }

            const bookmark = e.target.closest('.btn-save');
            if (bookmark) {
                const idx = +bookmark.dataset.idx;
                document.querySelectorAll(`.btn-save[data-idx="${idx}"]`).forEach(b => {
                    saved.has(idx) ? b.classList.remove('saved') : b.classList.add('saved');
                });
                saved.has(idx) ? (saved.delete(idx), showToast('Removed from saved')) : (saved.add(idx), showToast('🔖 Saved!'));
            }
        });

        /* FILTER */
        const filterBtns = document.querySelectorAll('.filter-btn');
        const cards = document.querySelectorAll('.artwork-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const filter = btn.dataset.filter;
                cards.forEach(card => {
                    card.style.display = (filter === 'all' || card.dataset.category === filter) ? '' : 'none';
                });
            });
        });

        /* LOAD MORE */
        document.getElementById('loadMoreBtn').addEventListener('click', function () {
            this.textContent = 'No more projects to load';
            this.disabled = true;
            this.style.opacity = '0.5';
            showToast('You\'ve seen all projects!');
        });
    </script>
@endpush
