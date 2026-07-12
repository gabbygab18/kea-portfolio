@extends('layouts.app')

@section('title', 'SEO Work — Keana\'s Portfolio')

@section('content')

    {{-- ── HERO ── --}}
    <section class="seo-hero">
        <div class="seo-hero__glow"></div>

        {{-- Chess board sits behind the copy and fades into the black bg --}}
        <div class="seo-hero__board-wrap">
            <img src="{{ asset('images/seo-board.png') }}" alt="Chess board with a lone pawn" />
        </div>

        <div class="seo-hero__content">
            <h1 class="seo-hero__title">Stack the Odds in Your Favor</h1>
            <p class="seo-hero__desc">
                {{ $siteSettings['seo_hero_description'] ??
                    "Search rankings aren't won by chance — they're built move by move. I dig into the data, study the competition, and place every keyword, tag, and technical fix with intention. No shortcuts. No bluffing. Just strategy that shows up in the results." }}
            </p>
            <a href="{{ route('contact') }}" class="seo-hero__btn">
                Enter the Table <span>&rsaquo;</span>
            </a>
        </div>
    </section>

    {{-- ── THE DECK I PLAY WITH (tools) ── --}}
    <section class="seo-deck">
        <div class="seo-deck__glow seo-deck__glow--right"></div>
        <div class="seo-deck__glow seo-deck__glow--bottom"></div>

        <div class="seo-deck__inner">
            <div class="seo-deck__header">
                <h2 class="seo-deck__title">The Deck I Play With</h2>
                <p class="seo-deck__desc">
                    {{ $siteSettings['seo_tools_description'] ??
                        'Lorem ipsum dolor sit amet consectetur adipiscing elidolor mattis sit phasellus mollis sit aliquam sit nullam neques.' }}
                </p>
            </div>

            <div class="seo-deck__grid">
                @forelse($seoTools as $tool)
                    <article class="seo-card">
                        <div class="seo-card__icon">
                            @if ($tool->icon)
                                <img src="{{ asset('storage/' . $tool->icon) }}" alt="{{ $tool->name }}" />
                            @elseif($tool->icon_path)
                                <img src="{{ asset('images/' . $tool->icon_path) }}" alt="{{ $tool->name }}" />
                            @else
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <circle cx="11" cy="11" r="7" />
                                    <line x1="16.5" y1="16.5" x2="22" y2="22" />
                                </svg>
                            @endif
                        </div>
                        <h3 class="seo-card__name">{{ $tool->name }}</h3>
                        <p class="seo-card__desc">{{ $tool->description }}</p>
                        @if ($tool->category)
                            <span class="seo-card__tag">{{ $tool->category }}</span>
                        @endif
                    </article>
                @empty
                    {{-- Fallback: six placeholder cards matching the mockup --}}
                    @foreach (range(1, 6) as $i)
                        <article class="seo-card">
                            <div class="seo-card__icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <circle cx="11" cy="11" r="7" />
                                    <line x1="16.5" y1="16.5" x2="22" y2="22" />
                                </svg>
                            </div>
                            <h3 class="seo-card__name">Google Search Console</h3>
                            <p class="seo-card__desc">Monitors site search performance, indexing status, and
                                identifies crawl errors to improve visibility.</p>
                            <span class="seo-card__tag">SEO Analytics</span>
                        </article>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    {{-- ── SKILLS & EXPERTISE (dark, same card language) ── --}}
    <section class="seo-skills">
        <div class="seo-skills__inner">
            <div class="seo-skills__header">
                <span class="seo-section-label">Skills &amp; Expertise</span>
                <h2 class="seo-skills__title">SEO techniques I specialise in</h2>
                <p class="seo-skills__desc">The core disciplines behind every project and strategy.</p>
            </div>

            <div class="seo-skills__grid">
                @forelse($seoSkills as $skill)
                    <div class="seo-skill-card">
                        <div class="seo-skill-card__num">{{ ['♣', '♥', '♦', '♠', '♣', '♥'][$loop->index % 6] }}</div>
                        <h3 class="seo-skill-card__title">{{ $skill->title }}</h3>
                        @if ($skill->description)
                            <p class="seo-skill-card__text">{{ $skill->description }}</p>
                        @endif
                    </div>
                @empty
                    @foreach ([['title' => 'On-Page Optimisation', 'text' => 'Meta tags, heading hierarchy, keyword placement, internal linking, and content structure aligned with search intent.'], ['title' => 'Technical SEO', 'text' => 'Site crawlability, indexation, Core Web Vitals, structured data, canonical tags, and page speed improvements.'], ['title' => 'Keyword Research', 'text' => 'Search volume analysis, competitor gap audits, long-tail targeting, and content cluster mapping.'], ['title' => 'Link Building', 'text' => 'Outreach campaigns, backlink profile audits, disavow strategies, and authority-building content.'], ['title' => 'Content Strategy', 'text' => 'Topic clustering, editorial calendars, intent-based content briefs, and SEO-led copywriting guidance.'], ['title' => 'SEO Auditing', 'text' => 'Full-site technical and on-page audits using Screaming Frog, Ahrefs, and Google Search Console.']] as $s)
                        <div class="seo-skill-card">
                            <div class="seo-skill-card__num">{{ ['♣', '♥', '♦', '♠', '♣', '♥'][$loop->index % 6] }}</div>
                            <h3 class="seo-skill-card__title">{{ $s['title'] }}</h3>
                            <p class="seo-skill-card__text">{{ $s['text'] }}</p>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

@endsection
