@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section class="hero">
        <div class="blob-field"></div>
        <img class="hero__deco hero__deco--cards" src="{{ asset('images/deco-cards.png') }}" alt=""
            aria-hidden="true" />
        <img class="hero__deco hero__deco--dice" src="{{ asset('images/deco-dice.png') }}" alt="" aria-hidden="true" />
        <img class="hero__deco hero__deco--rook" src="{{ asset('images/deco-rook.png') }}" alt=""
            aria-hidden="true" />
        <img class="hero__deco hero__deco--domino" src="{{ asset('images/deco-domino.png') }}" alt=""
            aria-hidden="true" />
        <div class="hero__content">
            <h1 class="hero__title">
                {{ $siteSettings['hero_title'] ?? 'Every Move Has a Reason.' }}
            </h1>
            <p class="hero__description">
                {{ $siteSettings['hero_description'] ?? 'Nothing about pairing design and search is accidental. Every interface I build and every ranking strategy I run is a calculated move — backed by research, sharpened through practice, and made with purpose. I\'m Keana. Welcome to the table.' }}
            </p>
            <div class="hero__cta">
                <a href="{{ route('contact') }}" class="btn btn--primary btn--arrow">Enter the Table<span
                        class="btn__arrow">›</span></a>
                {{-- <a href="{{ route('artworks') }}" class="btn btn--outline-light btn--arrow">
                    View artworks <span class="btn__arrow">›</span>
                </a> --}}
            </div>
        </div>
        <div class="hero__cards">
            <div class="hero__card hero__card--left">
                <div class="hero__card-img"><img src="{{ asset('images/queen-left.png') }}" alt=""></div>
            </div>
            <div class="hero__card hero__card--center">
                <div class="hero__card-img"><img src="{{ asset('images/queen.png') }}" alt=""></div>
            </div>
            <div class="hero__card hero__card--right">
                <div class="hero__card-img"><img src="{{ asset('images/queen-right.png') }}" alt=""></div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        const cards = {!! json_encode($artworkCards) !!};

        const CARD_W = 300,
            GAP = 24,
            STEP = CARD_W + GAP;
        const SCROLL_THRESHOLD = 1;

        const seededComments = [{
                initials: 'JD',
                name: '@johndoe',
                text: 'This is absolutely stunning work! 🔥'
            },
            {
                initials: 'MR',
                name: '@mariariela',
                text: 'Love the composition on this one.'
            },
        ];

        const track = document.getElementById('track');
        const outer = document.getElementById('artworksOuter');

        // ── Shared scroll state (must be outer-scope so buildTrack can reset them) ──
        let scrollSpeed = 0;
        let currentScroll = 0;
        let currentTotal = 0; // totalWidth for the active set of cards
        let animationActive = false;

        // ── Helpers ───────────────────────────────────────────────────────────────
        function slugify(str) {
            return (str || '').toLowerCase().trim()
                .replace(/\s+/g, '-')
                .replace(/[^a-z0-9-]/g, '');
        }

        // // ── makeCard ──────────────────────────────────────────────────────────────
        // function makeCard(d, idx) {
        //     const card = document.createElement('div');
        //     card.className = 'artworks__card';
        //     card.dataset.idx = idx % cards.length;
        //     card.dataset.category = slugify(d.category) || 'ui';
        //     card.innerHTML = `
    //                 <div class="artworks__card__top-bar">
    //                     <div class="avatar"></div>
    //                     <span class="name">${d.name}</span>
    //                     ${d.verified ? `<svg width="14" height="14" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="9" fill="#2C96FF"/><polyline points="6,10 9,13 14,7" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>` : ''}
    //                 </div>
    //                 <div class="artworks__card__img-wrap">
    //                     <img src="${d.img}" alt="${d.title}" />
    //                 </div>
    //                 <div class="artworks__card__overlay"></div>
    //                 <div class="artworks__card__bottom-bar">
    //                     <div class="actions-row">
    //                         <div class="actions">
    //                             <button class="icon-btn btn-heart" data-idx="${idx % cards.length}" title="Like">
    //                                 <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#531A24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 000-7.78z"/></svg>
    //                             </button>
    //                             <button class="icon-btn btn-comment" data-idx="${idx % cards.length}" title="Comment">
    //                                 <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#531A24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
    //                             </button>
    //                             <button class="icon-btn btn-share" data-idx="${idx % cards.length}" data-img="${d.img}" title="Share">
    //                                 <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#531A24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2" fill="none"/></svg>
    //                             </button>
    //                         </div>
    //                         <button class="icon-btn btn-save" data-idx="${idx % cards.length}" title="Save">
    //                             <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#531A24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg>
    //                         </button>
    //                     </div>
    //                     <div class="card-caption">${d.title || ''}</div>
    //                 </div>`;

        //     const img = card.querySelector('img');
        //     const CARD_H = 380;

        //     function applyPan() {
        //         const overflow = img.naturalHeight * (300 / img.naturalWidth) - CARD_H;
        //         if (overflow > 0) {
        //             card.style.setProperty('--pan-end', `-${overflow}px`);
        //             card.style.setProperty('--pan-dur', `${Math.min(8, Math.max(2, overflow / 200)).toFixed(1)}s`);
        //         } else {
        //             card.style.setProperty('--pan-end', '0px');
        //             card.style.setProperty('--pan-dur', '0s');
        //         }
        //     }
        //     img.complete ? applyPan() : img.addEventListener('load', applyPan);

        //     card.addEventListener('click', (e) => {
        //         if (e.target.closest('.icon-btn')) return;
        //         if (d.link) window.location.href = d.link;
        //     });
        //     if (d.link) card.style.cursor = 'pointer';

        //     return card;
        // }

        // // ── buildTrack — handles ALL cases including filter rebuilds ──────────────
        // function buildTrack(filteredCards) {
        //     // Reset state
        //     track.innerHTML = '';
        //     scrollSpeed = 0;
        //     currentScroll = 0;
        //     currentTotal = 0;
        //     track.style.transform = 'translateX(0)';

        //     // Empty state
        //     if (!filteredCards.length) {
        //         outer.style.justifyContent = 'center';
        //         track.style.cssText =
        //             'display:flex;align-items:center;justify-content:center;padding:2rem 1rem;width:100%;';
        //         track.innerHTML = '<p style="color:rgba(123,29,46,0.5);font-size:14px;">No artworks found.</p>';
        //         return;
        //     }

        //     // Static layout — too few cards to scroll
        //     if (filteredCards.length <= SCROLL_THRESHOLD) {
        //         animationActive = false; // ← add this
        //         scrollSpeed = 0; // ← add this
        //         outer.style.justifyContent = 'center';
        //         track.style.cssText =
        //             'display:flex;flex-wrap:wrap;justify-content:center;gap:24px;transform:none;width:auto;padding:2rem 1rem;';
        //         filteredCards.forEach((d, i) => track.appendChild(makeCard(d, i)));
        //         return;
        //     }

        //     // Infinite scroll layout
        //     outer.style.justifyContent = '';
        //     track.style.cssText = '';

        //     const minCopies = Math.max(4, Math.min(20,
        //         Math.ceil((outer.offsetWidth * 3) / (filteredCards.length * STEP)) + 1
        //     ));

        //     for (let copy = 0; copy < minCopies; copy++) {
        //         filteredCards.forEach((d, i) => track.appendChild(makeCard(d, i)));
        //     }

        //     currentTotal = filteredCards.length * STEP * Math.floor(minCopies / 2);

        //     // Start the animation loop only once ever
        //     if (!animationActive) {
        //         animationActive = true;
        //         (function loop() {
        //             if (!animationActive) return; // ← add this
        //             if (scrollSpeed !== 0) {
        //                 currentScroll += scrollSpeed;
        //                 if (currentTotal > 0) {
        //                     if (currentScroll >= currentTotal) currentScroll -= currentTotal;
        //                     if (currentScroll < 0) currentScroll += currentTotal;
        //                 }
        //                 track.style.transform = `translateX(-${currentScroll}px)`;
        //             }
        //             requestAnimationFrame(loop);
        //         })();
        //     }
        // }

        // // ── Hover-to-scroll (attach once) ─────────────────────────────────────────
        // outer.addEventListener('mousemove', (e) => {
        //     const rect = outer.getBoundingClientRect();
        //     const x = e.clientX - rect.left,
        //         w = rect.width,
        //         threshold = w * 0.3;
        //     if (x < threshold) scrollSpeed = -(1 - x / threshold) * 6;
        //     else if (x > w - threshold) scrollSpeed = ((x - (w - threshold)) / threshold) * 6;
        //     else scrollSpeed = 0;
        // });
        // outer.addEventListener('mouseleave', () => scrollSpeed = 0);

        // // ── Filter buttons ────────────────────────────────────────────────────────
        // const filterBtns = document.querySelectorAll('.artworks__filter-btn');
        // filterBtns.forEach(btn => {
        //     btn.addEventListener('click', () => {
        //         filterBtns.forEach(b => b.classList.remove('active'));
        //         btn.classList.add('active');
        //         const filter = btn.dataset.filter;
        //         const filtered = filter === 'all' ?
        //             cards :
        //             cards.filter(d => slugify(d.category) === filter);
        //         buildTrack(filtered);
        //     });
        // });

        // // ── Initial render ────────────────────────────────────────────────────────
        // buildTrack(cards);

        // // ── Like / Save / Comment / Share ─────────────────────────────────────────
        // const liked = new Set(),
        //     saved = new Set();
        // const comments = cards.map(() => [...seededComments]);
        // let currentCardIdx = null;

        // function showToast(msg) {
        //     const t = document.getElementById('toast');
        //     t.textContent = msg;
        //     t.classList.add('show');
        //     setTimeout(() => t.classList.remove('show'), 2200);
        // }

        // document.addEventListener('click', e => {
        //     const btn = e.target.closest('.btn-heart');
        //     if (!btn) return;
        //     e.stopPropagation();
        //     const idx = +btn.dataset.idx;
        //     document.querySelectorAll(`.btn-heart[data-idx="${idx}"]`).forEach(b => {
        //         if (liked.has(idx)) b.classList.remove('liked');
        //         else {
        //             b.classList.remove('heart-bounce');
        //             void b.offsetWidth;
        //             b.classList.add('liked', 'heart-bounce');
        //             b.addEventListener('animationend', () => b.classList.remove('heart-bounce'), {
        //                 once: true
        //             });
        //         }
        //     });
        //     liked.has(idx) ? (liked.delete(idx), showToast('Removed from likes')) : (liked.add(idx), showToast(
        //         'Liked!'));
        // });

        // document.addEventListener('click', e => {
        //     const btn = e.target.closest('.btn-comment');
        //     if (!btn) return;
        //     e.stopPropagation();
        //     currentCardIdx = +btn.dataset.idx;
        //     renderComments();
        //     document.getElementById('commentOverlay').classList.add('open');
        // });

        // function renderComments() {
        //     const list = document.getElementById('commentList');
        //     list.innerHTML = (comments[currentCardIdx] || []).map(c => `
    //                 <div class="comment-item">
    //                     <div class="comment-item__avatar">${c.initials}</div>
    //                     <div class="comment-item__body">
    //                         <div class="comment-item__name">${c.name}</div>
    //                         <div class="comment-item__text">${c.text}</div>
    //                     </div>
    //                 </div>`).join('');
        //     list.scrollTop = list.scrollHeight;
        // }
        // document.getElementById('closeComment').onclick = () => document.getElementById('commentOverlay').classList.remove(
        //     'open');
        // document.getElementById('commentOverlay').addEventListener('click', e => {
        //     if (e.target === document.getElementById('commentOverlay')) document.getElementById('commentOverlay')
        //         .classList.remove('open');
        // });
        // document.getElementById('sendComment').onclick = postComment;
        // document.getElementById('commentInput').addEventListener('keydown', e => {
        //     if (e.key === 'Enter' && !e.shiftKey) {
        //         e.preventDefault();
        //         postComment();
        //     }
        // });

        // function postComment() {
        //     const input = document.getElementById('commentInput'),
        //         text = input.value.trim();
        //     if (!text) return;
        //     comments[currentCardIdx].push({
        //         initials: 'ME',
        //         name: '@you',
        //         text
        //     });
        //     input.value = '';
        //     renderComments();
        //     showToast('Comment posted!');
        // }

        // const platforms = [{
        //         label: 'Facebook',
        //         color: '#1877F2',
        //         icon: '<path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" stroke="white" stroke-width="1.5" fill="none"/>'
        //     },
        //     {
        //         label: 'Twitter/X',
        //         color: '#000',
        //         icon: '<path d="M4 4l6 6.5L4 18h2l5-5.5 4 5.5h4l-6.5-7.5L18 4h-2l-4.5 5-4-5H4z" fill="white"/>'
        //     },
        //     {
        //         label: 'WhatsApp',
        //         color: '#25D366',
        //         icon: '<path d="M17.5 14.5c-.3-.15-1.8-.9-2.1-1s-.5-.15-.7.15-.8 1-.98 1.2-.36.22-.66.07a8.3 8.3 0 01-2.44-1.51 9.15 9.15 0 01-1.69-2.1c-.17-.3 0-.46.13-.6l.45-.52c.14-.18.18-.3.27-.5s.05-.37-.02-.52c-.07-.15-.7-1.68-.96-2.3-.25-.6-.5-.52-.7-.53h-.6c-.2 0-.52.07-.8.37s-1.04 1.02-1.04 2.48 1.07 2.88 1.22 3.08c.15.2 2.1 3.2 5.08 4.48.7.3 1.26.48 1.68.62.7.22 1.35.19 1.86.12.57-.08 1.75-.72 2-1.41.25-.7.25-1.3.17-1.42z" fill="white"/>'
        //     },
        //     {
        //         label: 'LinkedIn',
        //         color: '#0A66C2',
        //         icon: '<rect x="4" y="9" width="3" height="9" fill="white"/><circle cx="5.5" cy="6.5" r="1.5" fill="white"/><path d="M13 9c-1.1 0-2 .9-2 2v6h3v-5.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5V17h3v-6a4 4 0 00-4-4h-3v2z" fill="white"/>'
        //     },
        // ];
        // document.addEventListener('click', e => {
        //     const btn = e.target.closest('.btn-share');
        //     if (!btn) return;
        //     e.stopPropagation();
        //     const link = btn.dataset.img || window.location.href;
        //     document.getElementById('shareLinkInput').value = link;
        //     document.getElementById('copyLinkBtn').textContent = 'Copy link';
        //     document.getElementById('copyLinkBtn').classList.remove('copied');
        //     const wrap = document.getElementById('platformBtns');
        //     wrap.innerHTML = '';
        //     platforms.forEach(p => {
        //         const encoded = encodeURIComponent(link);
        //         const urls = {
        //             'Facebook': `https://www.facebook.com/sharer/sharer.php?u=${encoded}`,
        //             'Twitter/X': `https://twitter.com/intent/tweet?url=${encoded}`,
        //             'WhatsApp': `https://wa.me/?text=${encoded}`,
        //             'LinkedIn': `https://www.linkedin.com/sharing/share-offsite/?url=${encoded}`
        //         };
        //         const el = document.createElement(urls[p.label] ? 'a' : 'button');
        //         el.className = 'platform-btn';
        //         if (urls[p.label]) {
        //             el.href = urls[p.label];
        //             el.target = '_blank';
        //             el.rel = 'noopener';
        //         }
        //         el.innerHTML =
        //             `<div class="platform-btn__icon" style="background:${p.color}"><svg width="22" height="22" viewBox="0 0 24 24" fill="none">${p.icon}</svg></div><span class="platform-btn__label">${p.label}</span>`;
        //         wrap.appendChild(el);
        //     });
        //     document.getElementById('shareOverlay').classList.add('open');
        // });
        // document.getElementById('copyLinkBtn').onclick = () => {
        //     navigator.clipboard.writeText(document.getElementById('shareLinkInput').value).then(() => {
        //         const btn = document.getElementById('copyLinkBtn');
        //         btn.textContent = 'Copied!';
        //         btn.classList.add('copied');
        //         showToast('Link copied!');
        //         setTimeout(() => {
        //             btn.textContent = 'Copy link';
        //             btn.classList.remove('copied');
        //         }, 2500);
        //     });
        // };
        // document.getElementById('closeShare').onclick = () => document.getElementById('shareOverlay').classList.remove(
        //     'open');
        // document.getElementById('shareOverlay').addEventListener('click', e => {
        //     if (e.target === document.getElementById('shareOverlay')) document.getElementById('shareOverlay')
        //         .classList.remove('open');
        // });

        // document.addEventListener('click', e => {
        //     const btn = e.target.closest('.btn-save');
        //     if (!btn) return;
        //     e.stopPropagation();
        //     const idx = +btn.dataset.idx;
        //     document.querySelectorAll(`.btn-save[data-idx="${idx}"]`).forEach(b => {
        //         if (saved.has(idx)) b.classList.remove('saved');
        //         else {
        //             b.classList.remove('save-bounce');
        //             void b.offsetWidth;
        //             b.classList.add('saved', 'save-bounce');
        //             b.addEventListener('animationend', () => b.classList.remove('save-bounce'), {
        //                 once: true
        //             });
        //         }
        //     });
        //     saved.has(idx) ? (saved.delete(idx), showToast('Removed from saved')) : (saved.add(idx), showToast(
        //         'Saved!'));
        // });

        // ── Hero cards: spread on load, stack on scroll ───────────────────────────
        (function() {
            const cards = document.querySelector('.hero__cards');
            if (!cards) return;
            const left = cards.querySelector('.hero__card--left');
            const center = cards.querySelector('.hero__card--center');
            const right = cards.querySelector('.hero__card--right');

            function updateCards() {
                if (cards.matches(':hover')) return;
                const CLOSE_START = 300,
                    CLOSE_END = 600;
                const t = Math.min(1, Math.max(0, (window.scrollY - CLOSE_START) / (CLOSE_END - CLOSE_START)));
                const rot = 22 * (1 - t),
                    tx = 90 * (1 - t),
                    ty = -10 * (1 - t);
                left.style.transform = `translateX(-50%) rotate(${-rot}deg) translateX(${-tx}px)`;
                center.style.transform = `translateX(-50%) translateY(${ty}px)`;
                right.style.transform = `translateX(-50%) rotate(${rot}deg) translateX(${tx}px)`;
            }

            left.style.transform = "translateX(-50%) rotate(0deg) translateX(0px)";
            center.style.transform = "translateX(-50%) translateY(0px)";
            right.style.transform = "translateX(-50%) rotate(0deg) translateX(0px)";

            setTimeout(() => {
                updateCards();
                if (window.scrollY === 0) {
                    left.style.transform = "translateX(-50%) rotate(-22deg) translateX(-90px)";
                    center.style.transform = "translateX(-50%) translateY(-10px)";
                    right.style.transform = "translateX(-50%) rotate(22deg) translateX(90px)";
                }
            }, 200);

            window.addEventListener('scroll', updateCards, {
                passive: true
            });
            cards.addEventListener('mouseenter', () => {
                left.style.transform = "translateX(-50%) rotate(-22deg) translateX(-90px)";
                center.style.transform = "translateX(-50%) translateY(-10px)";
                right.style.transform = "translateX(-50%) rotate(22deg) translateX(90px)";
            });
            cards.addEventListener('mouseleave', updateCards);
        })();

        // ── Services: shuffle deal on scroll-into-view ────────────────────────────
        (function() {
            const grid = document.getElementById('servicesGrid');
            if (!grid) return;
            const cards = Array.from(grid.querySelectorAll('.services__card'));
            if (!cards.length) return;

            function getPositions() {
                return cards.map(c => {
                    const r = c.getBoundingClientRect(),
                        gr = grid.getBoundingClientRect();
                    return {
                        x: r.left - gr.left,
                        y: r.top - gr.top,
                        w: r.width,
                        h: r.height
                    };
                });
            }

            function runShuffle() {
                const positions = getPositions();
                const section = grid.closest('.services');
                const lockedH = grid.offsetHeight,
                    lockedW = grid.offsetWidth;
                grid.style.height = lockedH + 'px';
                grid.style.minHeight = lockedH + 'px';
                grid.style.position = 'relative';
                section.style.overflow = 'hidden';
                const cx = lockedW / 2,
                    cy = lockedH / 2;

                cards.forEach((card, i) => {
                    const p = positions[i];
                    card.style.position = 'absolute';
                    card.style.width = p.w + 'px';
                    card.style.height = p.h + 'px';
                    card.style.left = p.x + 'px';
                    card.style.top = p.y + 'px';
                    card.style.margin = '0';
                    card.style.transition = 'none';
                    card.style.zIndex = cards.length - i;
                    card.style.transform = 'translate(0,0) rotate(0deg)';
                });

                const STACK_DUR = 500;
                requestAnimationFrame(() => requestAnimationFrame(() => {
                    cards.forEach((card, i) => {
                        const p = positions[i];
                        card.style.transition =
                            `transform ${STACK_DUR}ms cubic-bezier(0.4,0,0.2,1)`;
                        card.style.transform =
                            `translate(${cx - p.x - p.w / 2}px, ${cy - p.y - p.h / 2}px) rotate(0deg)`;
                    });
                }));

                const SHUFFLE_ROUNDS = 4,
                    SHUFFLE_DUR = 200;

                function shuffleRound(round) {
                    if (round >= SHUFFLE_ROUNDS) {
                        dealOut();
                        return;
                    }
                    cards.forEach((card, i) => {
                        const p = positions[i],
                            dir = round % 2 === 0 ? 1 : -1;
                        const offset = (i - (cards.length - 1) / 2) * 8;
                        card.style.transition = `transform ${SHUFFLE_DUR}ms cubic-bezier(0.25,0.46,0.45,0.94)`;
                        card.style.transform =
                            `translate(${cx - p.x - p.w / 2 + offset * dir}px, ${cy - p.y - p.h / 2 - Math.abs(offset) * 0.4}px) rotate(${dir * (Math.random() * 14 + 6)}deg)`;
                        card.style.zIndex = round % 2 === 0 ? i : cards.length - i;
                    });
                    setTimeout(() => shuffleRound(round + 1), SHUFFLE_DUR + 30);
                }

                function dealOut() {
                    const DEAL_DUR = 480;
                    cards.forEach((card, i) => {
                        setTimeout(() => {
                            card.style.transition =
                                `transform ${DEAL_DUR}ms cubic-bezier(0.34,1.4,0.64,1)`;
                            card.style.transform = 'translate(0,0) rotate(0deg)';
                            card.style.zIndex = '';
                        }, i * 90);
                    });
                    setTimeout(() => {
                        cards.forEach(card => {
                            card.style.position = card.style.width = card.style.height =
                                card.style.left = card.style.top = card.style.transform =
                                card.style.transition = card.style.zIndex = card.style.margin = '';
                        });
                        grid.style.position = grid.style.minHeight = grid.style.height = '';
                        section.style.overflow = '';
                    }, DEAL_DUR + cards.length * 90 + 120);
                }
                setTimeout(() => shuffleRound(0), STACK_DUR + 80);
            }

            new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) runShuffle();
                });
            }, {
                threshold: 0.3
            }).observe(grid);
        })();
    </script>
@endpush
