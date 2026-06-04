@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section class="hero">
        <div class="hero__content">
            <h1 class="hero__title">
                {{ $siteSettings['hero_title'] ?? 'Working through the night to bring wise ideas to light.' }}
            </h1>
            <p class="hero__description">
                {{ $siteSettings['hero_description'] ?? 'Lorem ipsum dolor sit amet consectetur adipiscing elidolor mattis sit phasellus mollis sit aliquam sit nullam neques.' }}
            </p>
            <div class="hero__cta">
                <a href="{{ route('contact') }}" class="btn btn--primary btn--arrow">Get started<span
                        class="btn__arrow">›</span></a>
                <a href="{{ route('artworks') }}" class="btn btn--outline-light">View artworks</a>
            </div>
        </div>
    </section>

    <div class="brand-bar">
        <div class="brand-bar__track">
            <div class="brand-bar__group">
                <div class="brand-bar__logo"><img src="{{ asset('images/sass.png') }}" alt="Sass" /></div>
                <div class="brand-bar__logo"><img src="{{ asset('images/js.png') }}" alt="JavaScript" /></div>
                <div class="brand-bar__logo"><img src="{{ asset('images/webflow.png') }}" alt="Webflow" /></div>
                <div class="brand-bar__logo"><img src="{{ asset('images/ps.png') }}" alt="Photoshop" /></div>
                <div class="brand-bar__logo"><img src="{{ asset('images/figma.png') }}" alt="Figma" /></div>
                <div class="brand-bar__logo"><img src="{{ asset('images/html.png') }}" alt="HTML" /></div>
                <div class="brand-bar__logo"><img src="{{ asset('images/css.png') }}" alt="CSS" /></div>
            </div>
        </div>
    </div>

    <section class="about">
        <div class="about__inner">
            <div class="about__image-wrap">
                <img src="{{ asset('images/picture.png') }}" alt="About" class="about__image" />
            </div>
            <div class="about__content">
                <h2 class="about__title">{{ $siteSettings['about_title'] ?? 'Highly effective solutions' }}</h2>
                <p class="about__description">
                    {{ $siteSettings['about_description'] ?? 'Lorem ipsum dolor sit amet consectetur adipiscing eli mattis sit phasellus mollis sit aliquam sit nullam neque ultrices.' }}
                </p>
                <div class="about__cta">
                    <a href="{{ route('contact') }}" class="btn btn--primary btn--arrow">Get started<span
                            class="btn__arrow">›</span></a>
                    <a href="{{ route('about') }}" class="btn btn--outline-dark">Learn more</a>
                </div>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="services__inner">
            <div class="services__header">
                <h2 class="services__title">Services</h2>
                <p class="services__desc">
                    {{ $siteSettings['services_description'] ?? 'What I do best — from concept to code.' }}
                </p>
            </div>
            <div class="services__grid">
                @foreach($services as $service)
                    <div class="services__card">
                        <div class="services__card-num">{{ sprintf('%02d', $loop->iteration) }}</div>
                        <h3 class="services__card-title">{{ $service->title }}</h3>
                        <p class="services__card-desc">{{ $service->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="artworks">
        <div class="artworks__header">
            <h2 class="artworks__title">Featured works</h2>
            <p class="artworks__desc">Browse a selection of recent projects built with polished UI, strong storytelling, and
                thoughtful branding.</p>
        </div>
        {{-- After artworks__header, before artworks__outer --}}
        <div class="artworks__filters" id="artworkFilters">
            <button class="artworks__filter-btn active" data-filter="all">All</button>
            @foreach($artworkCategories as $category)
                <button class="artworks__filter-btn" data-filter="{{ Str::slug($category) }}">
                    {{ $category }}
                </button>
            @endforeach
        </div>
        <div class="artworks__outer" id="artworksOuter">
            <div class="artworks__hover-zone artworks__hover-zone--left" id="hoverLeft"></div>
            <div class="artworks__hover-zone artworks__hover-zone--right" id="hoverRight"></div>
            <div class="artworks__track" id="track"></div>
        </div>
        <div class="artworks__footer">
            <a href="{{ route('artworks') }}" class="btn btn--primary btn--arrow">See more <span
                    class="btn__arrow">›</span></a>
        </div>
    </section>

    {{-- Comment Modal --}}
    <div class="modal-overlay" id="commentOverlay">
        <div class="comment-modal">
            <div class="comment-modal__head">
                <span class="comment-modal__title">Comments</span>
                <button class="comment-modal__close" id="closeComment">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <line x1="2" y1="2" x2="12" y2="12" stroke="#531A24" stroke-width="2" stroke-linecap="round" />
                        <line x1="12" y1="2" x2="2" y2="12" stroke="#531A24" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            </div>
            <div class="comment-modal__comments" id="commentList"></div>
            <div class="comment-modal__form">
                <textarea class="comment-modal__input" id="commentInput" placeholder="Write a comment…" rows="1"></textarea>
                <button class="comment-modal__send" id="sendComment">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <line x1="22" y1="2" x2="11" y2="13" stroke="#FFFCF6" stroke-width="2" stroke-linecap="round" />
                        <polygon points="22 2 15 22 11 13 2 9 22 2" fill="#FFFCF6" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Share Modal --}}
    <div class="modal-overlay" id="shareOverlay">
        <div class="share-modal">
            <div class="share-modal__head">
                <span class="share-modal__title">Share Artwork</span>
                <button class="share-modal__close" id="closeShare">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <line x1="2" y1="2" x2="12" y2="12" stroke="#531A24" stroke-width="2" stroke-linecap="round" />
                        <line x1="12" y1="2" x2="2" y2="12" stroke="#531A24" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            </div>
            <div class="share-modal__link-row">
                <input class="share-modal__link-input" id="shareLinkInput" readonly />
                <button class="share-modal__copy-btn" id="copyLinkBtn">Copy link</button>
            </div>
            <div class="share-modal__platforms" id="platformBtns"></div>
        </div>
    </div>

    <div class="toast" id="toast"></div>

    @include('partials.contact-newsletter')

@endsection

@push('scripts')
    <script>
        const cards = {!! json_encode($artworkCards) !!};

        const CARD_W = 300, GAP = 24, STEP = CARD_W + GAP;

        const seededComments = [
            { initials: 'JD', name: '@johndoe', text: 'This is absolutely stunning work! 🔥' },
            { initials: 'MR', name: '@mariariela', text: 'Love the composition on this one.' },
        ];

        const track = document.getElementById('track');
        const outer = document.getElementById('artworksOuter');
        const SCROLL_THRESHOLD = 5;

        function makeCard(d, idx) {
            const card = document.createElement('div');
            card.className = 'artworks__card';
            card.dataset.idx = idx % cards.length;
            card.dataset.category = d.category || 'ui-design';
            card.innerHTML = `
                        <div class="artworks__card__top-bar">
                            <div class="avatar"></div>
                            <span class="name">${d.name}</span>
                            ${d.verified ? `<svg width="14" height="14" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="9" fill="#2C96FF"/><polyline points="6,10 9,13 14,7" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>` : ''}
                        </div>
                        <div class="artworks__card__img-wrap">
                            <img src="${d.img}" alt="${d.title}" />
                        </div>
                        <div class="artworks__card__overlay"></div>
                        <div class="artworks__card__bottom-bar">
                            <div class="actions-row">
                                <div class="actions">
                                    <button class="icon-btn btn-heart" data-idx="${idx % cards.length}" title="Like">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#531A24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 000-7.78z"/></svg>
                                    </button>
                                    <button class="icon-btn btn-comment" data-idx="${idx % cards.length}" title="Comment">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#531A24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                                    </button>
                                    <button class="icon-btn btn-share" data-idx="${idx % cards.length}" data-img="${d.img}" title="Share">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#531A24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2" fill="none"/></svg>
                                    </button>
                                </div>
                                <button class="icon-btn btn-save" data-idx="${idx % cards.length}" title="Save">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#531A24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg>
                                </button>
                            </div>
                            <div class="card-caption">${d.title || ''}</div>
                        </div>`;

            const img = card.querySelector('img');
            const CARD_H = 380;
            function applyPan() {
                const overflow = img.naturalHeight * (300 / img.naturalWidth) - CARD_H;
                if (overflow > 0) {
                    card.style.setProperty('--pan-end', `-${overflow}px`);
                    card.style.setProperty('--pan-dur', `${Math.min(8, Math.max(2, overflow / 200)).toFixed(1)}s`);
                } else {
                    card.style.setProperty('--pan-end', '0px');
                    card.style.setProperty('--pan-dur', '0s');
                }
            }
            img.complete ? applyPan() : img.addEventListener('load', applyPan);

            card.addEventListener('click', (e) => {
                if (e.target.closest('.icon-btn')) return;
                if (d.link) window.location.href = d.link;
            });
            if (d.link) card.style.cursor = 'pointer';

            return card;
        }

        if (cards.length < SCROLL_THRESHOLD) {
            outer.style.justifyContent = 'center';
            track.style.display = 'flex';
            track.style.flexWrap = 'wrap';
            track.style.justifyContent = 'center';
            track.style.gap = GAP + 'px';
            track.style.transform = 'none';
            track.style.width = 'auto';
            track.style.padding = '2rem 1rem';
            cards.forEach((d, i) => track.appendChild(makeCard(d, i)));
        } else {
            const minCopies = Math.max(4, Math.ceil((outer.offsetWidth * 3) / (cards.length * STEP)) + 1);
            for (let copy = 0; copy < minCopies; copy++) {
                cards.forEach((d, i) => track.appendChild(makeCard(d, i)));
            }
            const totalWidth = cards.length * STEP * Math.floor(minCopies / 2);
            let scrollSpeed = 0, currentScroll = 0;
            track.style.transition = 'none';

            (function animateScroll() {
                if (scrollSpeed !== 0) {
                    currentScroll += scrollSpeed;
                    if (currentScroll >= totalWidth) currentScroll -= totalWidth;
                    if (currentScroll < 0) currentScroll += totalWidth;
                    track.style.transform = `translateX(-${currentScroll}px)`;
                }
                requestAnimationFrame(animateScroll);
            })();

            outer.addEventListener('mousemove', (e) => {
                const rect = outer.getBoundingClientRect();
                const x = e.clientX - rect.left, w = rect.width, threshold = w * 0.3;
                if (x < threshold) scrollSpeed = -(1 - x / threshold) * 6;
                else if (x > w - threshold) scrollSpeed = ((x - (w - threshold)) / threshold) * 6;
                else scrollSpeed = 0;
            });
            outer.addEventListener('mouseleave', () => scrollSpeed = 0);
        }  // ← end of else block

        // ↓ NOW OUTSIDE — always runs regardless of card count
        const filterBtns = document.querySelectorAll('.artworks__filter-btn');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const filter = btn.dataset.filter;
                document.querySelectorAll('.artworks__card').forEach(card => {
                    card.style.display = (filter === 'all' || card.dataset.category === filter) ? '' : 'none';
                });
            });
        });

        const liked = new Set(), saved = new Set();
        const comments = cards.map(() => [...seededComments]);
        let currentCardIdx = null;

        function showToast(msg) {
            const t = document.getElementById('toast');
            t.textContent = msg; t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 2200);
        }

        document.addEventListener('click', e => {
            const btn = e.target.closest('.btn-heart'); if (!btn) return; e.stopPropagation();
            const idx = +btn.dataset.idx;
            document.querySelectorAll(`.btn-heart[data-idx="${idx}"]`).forEach(b => {
                if (liked.has(idx)) b.classList.remove('liked');
                else { b.classList.remove('heart-bounce'); void b.offsetWidth; b.classList.add('liked', 'heart-bounce'); b.addEventListener('animationend', () => b.classList.remove('heart-bounce'), { once: true }); }
            });
            liked.has(idx) ? (liked.delete(idx), showToast('Removed from likes')) : (liked.add(idx), showToast('Liked!'));
        });

        document.addEventListener('click', e => {
            const btn = e.target.closest('.btn-comment'); if (!btn) return; e.stopPropagation();
            currentCardIdx = +btn.dataset.idx; renderComments();
            document.getElementById('commentOverlay').classList.add('open');
        });
        function renderComments() {
            const list = document.getElementById('commentList');
            list.innerHTML = (comments[currentCardIdx] || []).map(c => `
                        <div class="comment-item">
                            <div class="comment-item__avatar">${c.initials}</div>
                            <div class="comment-item__body"><div class="comment-item__name">${c.name}</div><div class="comment-item__text">${c.text}</div></div>
                        </div>`).join('');
            list.scrollTop = list.scrollHeight;
        }
        document.getElementById('closeComment').onclick = () => document.getElementById('commentOverlay').classList.remove('open');
        document.getElementById('commentOverlay').addEventListener('click', e => { if (e.target === document.getElementById('commentOverlay')) document.getElementById('commentOverlay').classList.remove('open'); });
        document.getElementById('sendComment').onclick = postComment;
        document.getElementById('commentInput').addEventListener('keydown', e => { if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); postComment(); } });
        function postComment() {
            const input = document.getElementById('commentInput'), text = input.value.trim(); if (!text) return;
            comments[currentCardIdx].push({ initials: 'ME', name: '@you', text }); input.value = ''; renderComments(); showToast('Comment posted!');
        }

        const platforms = [
            { label: 'Facebook', color: '#1877F2', icon: '<path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" stroke="white" stroke-width="1.5" fill="none"/>' },
            { label: 'Twitter/X', color: '#000', icon: '<path d="M4 4l6 6.5L4 18h2l5-5.5 4 5.5h4l-6.5-7.5L18 4h-2l-4.5 5-4-5H4z" fill="white"/>' },
            { label: 'WhatsApp', color: '#25D366', icon: '<path d="M17.5 14.5c-.3-.15-1.8-.9-2.1-1s-.5-.15-.7.15-.8 1-.98 1.2-.36.22-.66.07a8.3 8.3 0 01-2.44-1.51 9.15 9.15 0 01-1.69-2.1c-.17-.3 0-.46.13-.6l.45-.52c.14-.18.18-.3.27-.5s.05-.37-.02-.52c-.07-.15-.7-1.68-.96-2.3-.25-.6-.5-.52-.7-.53h-.6c-.2 0-.52.07-.8.37s-1.04 1.02-1.04 2.48 1.07 2.88 1.22 3.08c.15.2 2.1 3.2 5.08 4.48.7.3 1.26.48 1.68.62.7.22 1.35.19 1.86.12.57-.08 1.75-.72 2-1.41.25-.7.25-1.3.17-1.42z" fill="white"/>' },
            { label: 'LinkedIn', color: '#0A66C2', icon: '<rect x="4" y="9" width="3" height="9" fill="white"/><circle cx="5.5" cy="6.5" r="1.5" fill="white"/><path d="M13 9c-1.1 0-2 .9-2 2v6h3v-5.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5V17h3v-6a4 4 0 00-4-4h-3v2z" fill="white"/>' },
        ];
        document.addEventListener('click', e => {
            const btn = e.target.closest('.btn-share'); if (!btn) return; e.stopPropagation();
            const link = btn.dataset.img || window.location.href;
            document.getElementById('shareLinkInput').value = link;
            document.getElementById('copyLinkBtn').textContent = 'Copy link';
            document.getElementById('copyLinkBtn').classList.remove('copied');
            const wrap = document.getElementById('platformBtns'); wrap.innerHTML = '';
            platforms.forEach(p => {
                const encoded = encodeURIComponent(link);
                const urls = { 'Facebook': `https://www.facebook.com/sharer/sharer.php?u=${encoded}`, 'Twitter/X': `https://twitter.com/intent/tweet?url=${encoded}`, 'WhatsApp': `https://wa.me/?text=${encoded}`, 'LinkedIn': `https://www.linkedin.com/sharing/share-offsite/?url=${encoded}` };
                const el = document.createElement(urls[p.label] ? 'a' : 'button');
                el.className = 'platform-btn';
                if (urls[p.label]) { el.href = urls[p.label]; el.target = '_blank'; el.rel = 'noopener'; }
                el.innerHTML = `<div class="platform-btn__icon" style="background:${p.color}"><svg width="22" height="22" viewBox="0 0 24 24" fill="none">${p.icon}</svg></div><span class="platform-btn__label">${p.label}</span>`;
                wrap.appendChild(el);
            });
            document.getElementById('shareOverlay').classList.add('open');
        });
        document.getElementById('copyLinkBtn').onclick = () => {
            navigator.clipboard.writeText(document.getElementById('shareLinkInput').value).then(() => {
                const btn = document.getElementById('copyLinkBtn');
                btn.textContent = 'Copied!'; btn.classList.add('copied'); showToast('Link copied!');
                setTimeout(() => { btn.textContent = 'Copy link'; btn.classList.remove('copied'); }, 2500);
            });
        };
        document.getElementById('closeShare').onclick = () => document.getElementById('shareOverlay').classList.remove('open');
        document.getElementById('shareOverlay').addEventListener('click', e => { if (e.target === document.getElementById('shareOverlay')) document.getElementById('shareOverlay').classList.remove('open'); });

        document.addEventListener('click', e => {
            const btn = e.target.closest('.btn-save'); if (!btn) return; e.stopPropagation();
            const idx = +btn.dataset.idx;
            document.querySelectorAll(`.btn-save[data-idx="${idx}"]`).forEach(b => {
                if (saved.has(idx)) b.classList.remove('saved');
                else { b.classList.remove('save-bounce'); void b.offsetWidth; b.classList.add('saved', 'save-bounce'); b.addEventListener('animationend', () => b.classList.remove('save-bounce'), { once: true }); }
            });
            saved.has(idx) ? (saved.delete(idx), showToast('Removed from saved')) : (saved.add(idx), showToast('Saved!'));
        });
    </script>
@endpush
