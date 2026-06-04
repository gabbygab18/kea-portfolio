@extends('layouts.app')

@section('title', 'SEO Work — Keana\'s Portfolio')

@section('content')

    {{-- ── HERO ── --}}
    <section class="seo-hero">
        <div class="seo-hero__inner">
            <div class="seo-hero__label">SEO Specialist</div>
            <h1 class="seo-hero__title">
                Search strategies<br />
                that <em>actually</em> rank.
            </h1>
            <p class="seo-hero__desc">
                {{ $siteSettings['seo_hero_description'] ?? 'From keyword research to technical audits — here\'s a look at the SEO tools I use and the projects I\'ve contributed to.' }}
            </p>
            <div class="seo-hero__cta">
                <a href="{{ route('contact') }}" class="btn btn--primary btn--arrow">
                    Work with me <span class="btn__arrow">›</span>
                </a>
                <a href="{{ route('artworks') }}" class="btn btn--outline-dark">View design work</a>
            </div>
        </div>
        {{-- replace the existing seo-hero__visual div --}}
<div class="seo-hero__visual">
    <div class="seo-hero__badge seo-hero__badge--1">
        <span class="seo-hero__badge-num">{{ $siteSettings['seo_projects_count'] ?? '10+' }}</span>
        <span class="seo-hero__badge-label">Projects</span>
    </div>
    <div class="seo-hero__badge seo-hero__badge--2">
        <span class="seo-hero__badge-num">{{ $siteSettings['seo_audits_count'] ?? '5+' }}</span>
        <span class="seo-hero__badge-label">Audits Done</span>
    </div>
    <div class="seo-hero__rank-card">
        <div class="seo-hero__rank-bar" data-width="90">
            <span>Organic Traffic</span>
            <div class="seo-hero__rank-track">
                <div class="seo-hero__rank-fill"></div>
            </div>
            <strong>↑ 90%</strong>
        </div>
        <div class="seo-hero__rank-bar" data-width="75">
            <span>Keyword Rankings</span>
            <div class="seo-hero__rank-track">
                <div class="seo-hero__rank-fill"></div>
            </div>
            <strong>↑ 75%</strong>
        </div>
        <div class="seo-hero__rank-bar" data-width="60">
            <span>Page Speed Score</span>
            <div class="seo-hero__rank-track">
                <div class="seo-hero__rank-fill"></div>
            </div>
            <strong>↑ 60%</strong>
        </div>
    </div>
</div>
    </section>

    {{-- ── TOOLS ── --}}
    <section class="seo-tools">
        <div class="seo-tools__inner">
            <div class="seo-tools__header">
                <span class="seo-section-label">My Toolkit</span>
                <h2 class="seo-tools__title">Tools I work with</h2>
            </div>
            <div class="seo-tools__grid">
                @forelse($seoTools as $tool)
                    <div class="seo-tool-card"> {{-- ← THIS was missing --}}
                        <div class="seo-tool-card__icon">
                            @if($tool->icon)
                                <img src="{{ asset('storage/' . $tool->icon) }}" alt="{{ $tool->name }}" />
                            @elseif($tool->icon_path)
                                <img src="{{ asset('images/' . $tool->icon_path) }}" alt="{{ $tool->name }}" />
                            @else
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <circle cx="11" cy="11" r="7" />
                                    <line x1="16.5" y1="16.5" x2="22" y2="22" />
                                </svg>
                            @endif
                        </div>
                        <h3 class="seo-tool-card__name">{{ $tool->name }}</h3>
                        <p class="seo-tool-card__desc">{{ $tool->description }}</p>
                        @if($tool->category)
                            <span class="seo-tool-card__tag">{{ $tool->category }}</span>
                        @endif
                    </div>
                @empty
                    {{-- Fallback hardcoded tools --}}
                    @foreach([
            ['name' => 'Google Search Console', 'desc' => 'Monitor search performance, crawl errors, and indexing status.', 'tag' => 'Analytics'],
            ['name' => 'Google Analytics', 'desc' => 'Track user behavior, traffic sources, and conversion goals.', 'tag' => 'Analytics'],
            ['name' => 'Ahrefs', 'desc' => 'Backlink analysis, keyword research, and competitor audits.', 'tag' => 'Research'],
            ['name' => 'SEMrush', 'desc' => 'Full-suite SEO platform for site audits and rank tracking.', 'tag' => 'Audit'],
            ['name' => 'Screaming Frog', 'desc' => 'Technical SEO crawler for site structure and broken links.', 'tag' => 'Technical'],
            ['name' => 'Figma', 'desc' => 'Design SEO-optimized landing page wireframes and layouts.', 'tag' => 'Design'],
            ['name' => 'Yoast SEO', 'desc' => 'WordPress on-page SEO optimization and readability checks.', 'tag' => 'On-Page'],
            ['name' => 'PageSpeed Insights', 'desc' => 'Core Web Vitals and performance optimization scoring.', 'tag' => 'Technical'],
        ] as $t)
                    <div class="seo-tool-card">
                        <div class="seo-tool-card__icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="22" y2="22"/>
                            </svg>
                        </div>
                        <h3 class="seo-tool-card__name">{{ $t['name'] }}</h3>
                        <p class="seo-tool-card__desc">{{ $t['desc'] }}</p>
                        <span class="seo-tool-card__tag">{{ $t['tag'] }}</span>
                    </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    {{-- ── PROJECTS ── --}}
    {{-- <section class="seo-projects">
        <div class="seo-projects__inner">
            <div class="seo-projects__header">
                <span class="seo-section-label">Case Studies</span>
                <h2 class="seo-projects__title">Projects I've worked on</h2>
                <p class="seo-projects__desc">Real work, real results — from audits to full SEO strategy implementation.</p>
            </div>

            <div class="seo-projects__list">
                @forelse($seoProjects as $project)
                    <div class="seo-project-card">
                        <div class="seo-project-card__meta">
                            <span class="seo-project-card__num">{{ sprintf('%02d', $loop->iteration) }}</span>
                            @if($project->category)
                                <span class="seo-project-card__cat">{{ $project->category }}</span>
                            @endif
                        </div>
                        <div class="seo-project-card__body">
                            <h3 class="seo-project-card__title">{{ $project->title }}</h3>
                            <p class="seo-project-card__desc">{{ $project->description }}</p>
                            @if($project->results)
                                <ul class="seo-project-card__results">
                                    @foreach(is_array($project->results) ? $project->results : json_decode($project->results, true) as $result)
                                        <li>{{ $result }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            @if($project->tools_used)
                                <div class="seo-project-card__tools">
                                    @foreach(is_array($project->tools_used) ? $project->tools_used : json_decode($project->tools_used, true) as $tool)
                                        <span class="seo-project-card__tool-tag">{{ $tool }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        @if($project->link)
                            <a href="{{ $project->link }}" target="_blank" rel="noopener" class="seo-project-card__link">
                                View →
                            </a>
                        @endif
                    </div>
                @empty

                    @foreach([
            [
                'num' => '01',
                'cat' => 'On-Page SEO',
                'title' => 'Monte Carlo Technologies — Full SEO Audit',
                'desc' => 'Conducted a comprehensive on-page and technical SEO audit for MCTech\'s company website. Identified crawl errors, optimized meta tags, restructured heading hierarchies, and implemented structured data.',
                'results' => ['Improved organic visibility by 40% in 3 months', 'Fixed 120+ crawl errors identified via Screaming Frog', 'Meta tags and H1–H3 hierarchy restructured across 30 pages'],
                'tools' => ['Google Search Console', 'Screaming Frog', 'Ahrefs'],
            ],
            [
                'num' => '02',
                'cat' => 'Content Strategy',
                'title' => 'Keyword Research & Content Mapping',
                'desc' => 'Developed a keyword strategy and content map for a client\'s blog and service pages. Performed competitor gap analysis and identified high-intent keywords with low competition.',
                'results' => ['Identified 200+ target keywords across 5 topic clusters', 'Built content calendar aligned with search intent', 'Increased blog traffic by 25% month-over-month'],
                'tools' => ['SEMrush', 'Google Analytics', 'Ahrefs'],
            ],
            [
                'num' => '03',
                'cat' => 'Technical SEO',
                'title' => 'Core Web Vitals Optimization',
                'desc' => 'Diagnosed and resolved performance issues affecting Core Web Vitals scores. Worked alongside the dev team to compress assets, defer scripts, and implement lazy loading.',
                'results' => ['LCP improved from 4.2s to 1.8s', 'CLS score reduced to under 0.05', 'PageSpeed score jumped from 48 to 89'],
                'tools' => ['PageSpeed Insights', 'Figma', 'Google Search Console'],
            ],
        ] as $p)
                    <div class="seo-project-card">
                        <div class="seo-project-card__meta">
                            <span class="seo-project-card__num">{{ $p['num'] }}</span>
                            <span class="seo-project-card__cat">{{ $p['cat'] }}</span>
                        </div>
                        <div class="seo-project-card__body">
                            <h3 class="seo-project-card__title">{{ $p['title'] }}</h3>
                            <p class="seo-project-card__desc">{{ $p['desc'] }}</p>
                            <ul class="seo-project-card__results">
                                @foreach($p['results'] as $r)<li>{{ $r }}</li>@endforeach
                            </ul>
                            <div class="seo-project-card__tools">
                                @foreach($p['tools'] as $t)
                                    <span class="seo-project-card__tool-tag">{{ $t }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section> --}}

    {{-- ── SKILLS & EXPERTISE ── --}}
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
                        <div class="seo-skill-card__num">{{ sprintf('%02d', $loop->iteration) }}</div>
                        <h3 class="seo-skill-card__title">{{ $skill->title }}</h3>
                        @if($skill->description)
                            <p class="seo-skill-card__text">{{ $skill->description }}</p>
                        @endif
                    </div>
                @empty
                    @foreach([
            ['title' => 'On-Page Optimisation', 'text' => 'Meta tags, heading hierarchy, keyword placement, internal linking, and content structure aligned with search intent.'],
            ['title' => 'Technical SEO', 'text' => 'Site crawlability, indexation, Core Web Vitals, structured data, canonical tags, and page speed improvements.'],
            ['title' => 'Keyword Research', 'text' => 'Search volume analysis, competitor gap audits, long-tail targeting, and content cluster mapping.'],
            ['title' => 'Link Building', 'text' => 'Outreach campaigns, backlink profile audits, disavow strategies, and authority-building content.'],
            ['title' => 'Content Strategy', 'text' => 'Topic clustering, editorial calendars, intent-based content briefs, and SEO-led copywriting guidance.'],
            ['title' => 'SEO Auditing', 'text' => 'Full-site technical and on-page audits using Screaming Frog, Ahrefs, and Google Search Console.'],
        ] as $s)
                        <div class="seo-skill-card">
                            <div class="seo-skill-card__num">{{ sprintf('%02d', $loop->iteration) }}</div>
                            <h3 class="seo-skill-card__title">{{ $s['title'] }}</h3>
                            <p class="seo-skill-card__text">{{ $s['text'] }}</p>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    @include('partials.contact-newsletter')

@endsection

@push('scripts')
<script>
    const bars = document.querySelectorAll('.seo-hero__rank-bar');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const bar   = entry.target;
            const fill  = bar.querySelector('.seo-hero__rank-fill');
            const width = bar.dataset.width + '%';

            // stagger each bar slightly
            const idx = [...bars].indexOf(bar);
            setTimeout(() => {
                fill.style.width = width;
            }, idx * 180);

            observer.unobserve(bar);
        });
    }, { threshold: 0.4 });

    bars.forEach(bar => observer.observe(bar));
</script>
@endpush
