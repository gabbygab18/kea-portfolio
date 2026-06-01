@extends('layouts.admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card stat-card--green">
        <div class="stat-icon-wrap">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="13.5" cy="6.5" r="2.5"/><path d="M21 16.5A4.5 4.5 0 0 1 16.5 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11.5"/><path d="M3 16l5-5 4 4 3-3 5 5"/></svg>
        </div>
        <div>
            <div class="stat-value">{{ $artworkCount }}</div>
            <div class="stat-label">Artworks</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 17l10 5 10-5M2 12l10 5 10-5M12 2L2 7l10 5 10-5z"/></svg>
        </div>
        <div>
            <div class="stat-value">{{ $serviceCount }}</div>
            <div class="stat-label">Services</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
        </div>
        <div>
            <div class="stat-value">{{ $skillCount }}</div>
            <div class="stat-label">Skills</div>
        </div>
    </div>
    <div class="stat-card stat-card--orange">
        <div class="stat-icon-wrap">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
        </div>
        <div>
            <div class="stat-value">{{ $messageCount }}</div>
            <div class="stat-label">Messages</div>
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem">
    <div class="admin-card">
        <h3>Quick Actions</h3>
        <div class="quick-actions">
            <a href="{{ route('admin.artworks.create') }}" class="btn-admin btn-admin-secondary">+ Add Artwork</a>
            <a href="{{ route('admin.services.create') }}" class="btn-admin btn-admin-secondary">+ Add Service</a>
            <a href="{{ route('admin.skills.create') }}" class="btn-admin btn-admin-secondary">+ Add Skill</a>
            <a href="{{ route('admin.messages.index') }}" class="btn-admin btn-admin-secondary">View Messages</a>
        </div>
    </div>
    <div class="admin-card">
        <h3>Portfolio</h3>
        <p style="margin-bottom:1.25rem">Preview your public portfolio site to see how your content looks live.</p>
        <a href="{{ route('home') }}" target="_blank" class="btn-admin btn-admin-primary">
            Open Site
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        </a>
    </div>
</div>
@endsection
