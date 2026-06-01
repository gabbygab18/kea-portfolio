@extends('layouts.admin')
@section('title', 'SEO Projects')
@section('content')

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">SEO Projects</h1>
            <p class="admin-page-subtitle">Manage your SEO case studies & tools</p>
        </div>
        <a href="{{ route('admin.seo-projects.create') }}" class="btn-admin btn-admin--primary">+ Add Project</a>
    </div>

    @if(session('success'))
        <div class="admin-alert admin-alert--success">{{ session('success') }}</div>
    @endif

    <div class="admin-card">
        @forelse($projects as $project)
            <div
                style="display:flex;align-items:flex-start;justify-content:space-between;padding:1.25rem 0;border-bottom:1px solid #f0ece6;gap:1rem">
                <div style="flex:1">
                    <div style="display:flex;align-items:center;gap:.6rem;margin-bottom:.3rem">
                        <strong style="font-size:.95rem">{{ $project->title }}</strong>
                        <span class="admin-badge">{{ $project->category }}</span>
                        @if($project->featured)
                            <span class="admin-badge" style="background:rgba(83,26,36,.1);color:#531A24">Featured</span>
                        @endif
                    </div>
                    <div style="font-size:.85rem;color:#555;margin-bottom:.2rem">{{ Str::limit($project->description, 100) }}
                    </div>
                    <div style="font-size:.78rem;color:#999;display:flex;gap:1rem;flex-wrap:wrap">
                        @if($project->client)
                            <span>Client: {{ $project->client }}</span>
                        @endif
                        @if($project->tools && count($project->tools))
                            <span>Tools:
                                {{ implode(', ', array_slice($project->tools, 0, 3)) }}{{ count($project->tools) > 3 ? '…' : '' }}</span>
                        @endif
                        <span>Order: {{ $project->order }}</span>
                    </div>
                </div>
                <div style="display:flex;gap:.5rem;flex-shrink:0">
                    <a href="{{ route('admin.seo-projects.edit', $project) }}" class="btn-admin btn-admin--ghost">Edit</a>
                    <form action="{{ route('admin.seo-projects.destroy', $project) }}" method="POST"
                        onsubmit="return confirm('Delete this project?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-admin btn-admin--danger">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p style="color:#999;padding:2rem 0;text-align:center">
                No SEO projects yet. <a href="{{ route('admin.seo-projects.create') }}">Add one.</a>
            </p>
        @endforelse
    </div>

    <div class="admin-page-header" style="margin-top:2.5rem">
        <div>
            <h2 class="admin-page-title" style="font-size:1.2rem">SEO Tools</h2>
            <p class="admin-page-subtitle">Tools shown on the SEO page</p>
        </div>
        <a href="{{ route('admin.seo-tools.create') }}" class="btn-admin btn-admin--primary">+ Add Tool</a>
    </div>

    <div class="admin-card">
        @forelse($tools as $tool)
            <div
                style="display:flex;align-items:center;justify-content:space-between;padding:1rem 0;border-bottom:1px solid #f0ece6;gap:1rem">
                <div style="display:flex;align-items:center;gap:.75rem">
                    @if($tool->icon_path)
                        <img src="{{ asset('images/' . $tool->icon_path) }}"
                            style="width:32px;height:32px;object-fit:contain;border-radius:6px">
                    @endif
                    <div>
                        <div style="font-size:.9rem;font-weight:700">{{ $tool->name }}</div>
                        <div style="font-size:.78rem;color:#999">{{ $tool->category }} · Order: {{ $tool->order }}</div>
                    </div>
                </div>
                <div style="display:flex;gap:.5rem">
                    <a href="{{ route('admin.seo-tools.edit', $tool) }}" class="btn-admin btn-admin--ghost">Edit</a>
                    <form action="{{ route('admin.seo-tools.destroy', $tool) }}" method="POST"
                        onsubmit="return confirm('Delete this tool?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-admin btn-admin--danger">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p style="color:#999;padding:2rem 0;text-align:center">
                No tools yet. <a href="{{ route('admin.seo-tools.create') }}">Add one.</a>
            </p>
        @endforelse
    </div>
    <div class="admin-page-header" style="margin-top:2.5rem">
        <div>
            <h2 class="admin-page-title" style="font-size:1.2rem">SEO Skills &amp; Expertise</h2>
            <p class="admin-page-subtitle">Skills shown on the SEO page</p>
        </div>
        <a href="{{ route('admin.seo-skills.create') }}" class="btn-admin btn-admin--primary">+ Add Skill</a>
    </div>

    <div class="admin-card">
        @forelse($seoSkills as $skill)
            <div
                style="display:flex;align-items:flex-start;justify-content:space-between;padding:1rem 0;border-bottom:1px solid #f0ece6;gap:1rem">
                <div style="flex:1">
                    <div style="font-size:.9rem;font-weight:700;margin-bottom:.2rem">{{ $skill->title }}</div>
                    <div style="font-size:.82rem;color:#777">{{ Str::limit($skill->description, 100) }}</div>
                    <div style="font-size:.75rem;color:#bbb;margin-top:.2rem">Order: {{ $skill->order }}</div>
                </div>
                <div style="display:flex;gap:.5rem;flex-shrink:0">
                    <a href="{{ route('admin.seo-skills.edit', $skill) }}" class="btn-admin btn-admin--ghost">Edit</a>
                    <form action="{{ route('admin.seo-skills.destroy', $skill) }}" method="POST"
                        onsubmit="return confirm('Delete this skill?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-admin btn-admin--danger">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p style="color:#999;padding:2rem 0;text-align:center">
                No skills yet. <a href="{{ route('admin.seo-skills.create') }}">Add one.</a>
            </p>
        @endforelse
    </div>
@endsection
