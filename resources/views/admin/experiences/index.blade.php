@extends('layouts.admin')
@section('title', 'Experiences')
@section('content')

<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Work Experience</h1>
        <p class="admin-page-subtitle">Manage your professional history</p>
    </div>
    <a href="{{ route('admin.experiences.create') }}" class="btn-admin btn-admin--primary">+ Add Experience</a>
</div>

@if(session('success'))
    <div class="admin-alert admin-alert--success">{{ session('success') }}</div>
@endif

<div class="admin-card">
    @forelse($experiences as $exp)
        <div style="display:flex;align-items:flex-start;justify-content:space-between;padding:1.25rem 0;border-bottom:1px solid #f0ece6;gap:1rem">
            <div>
                <div style="display:flex;align-items:center;gap:.6rem;margin-bottom:.25rem">
                    <strong style="font-size:.95rem">{{ $exp->company }}</strong>
                    <span class="admin-badge">{{ $exp->type }}</span>
                </div>
                <div style="font-size:.85rem;color:#555;margin-bottom:.2rem">{{ $exp->role }}</div>
                <div style="font-size:.78rem;color:#999">{{ $exp->date_range }} · {{ $exp->location }}</div>
            </div>
            <div style="display:flex;gap:.5rem;flex-shrink:0">
                <a href="{{ route('admin.experiences.edit', $exp) }}" class="btn-admin btn-admin--ghost">Edit</a>
                <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST"
                      onsubmit="return confirm('Delete this experience?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-admin btn-admin--danger">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <p style="color:#999;padding:2rem 0;text-align:center">No experiences yet. <a href="{{ route('admin.experiences.create') }}">Add one.</a></p>
    @endforelse
</div>

@endsection
