@extends('layouts.admin')
@section('title', 'Add Experience')
@section('content')

<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Add Experience</h1>
        <p class="admin-page-subtitle">Add a work or internship entry</p>
    </div>
    <a href="{{ route('admin.experiences.index') }}" class="btn-admin btn-admin--ghost">← Back</a>
</div>

<form action="{{ route('admin.experiences.store') }}" method="POST">
    @csrf
    <div class="admin-card">
        <div class="admin-form-grid">

            <div class="admin-form-group">
                <label class="admin-label">Company <span class="admin-required">*</span></label>
                <input type="text" name="company" value="{{ old('company') }}" class="admin-input" placeholder="e.g. Monte Carlo Technologies" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-label">Type</label>
                <input type="text" name="type" value="{{ old('type', 'Internship') }}" class="admin-input" placeholder="e.g. Internship, Full-time">
            </div>

            <div class="admin-form-group admin-form-group--full">
                <label class="admin-label">Role <span class="admin-required">*</span></label>
                <input type="text" name="role" value="{{ old('role') }}" class="admin-input" placeholder="e.g. UI/UX Designer & SEO Specialist Intern" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-label">Date Range</label>
                <input type="text" name="date_range" value="{{ old('date_range') }}" class="admin-input" placeholder="e.g. Feb 2026 – May 2026">
            </div>

            <div class="admin-form-group">
                <label class="admin-label">Location</label>
                <input type="text" name="location" value="{{ old('location') }}" class="admin-input" placeholder="e.g. Philippines">
            </div>

            <div class="admin-form-group admin-form-group--full">
                <label class="admin-label">Bullet Points <span class="admin-form-hint">(one per line)</span></label>
                <textarea name="bullets" rows="6" class="admin-input admin-textarea"
                    placeholder="Designed wireframes and prototypes in Figma&#10;Conducted SEO audits...">{{ old('bullets') }}</textarea>
            </div>

            <div class="admin-form-group">
                <label class="admin-label">Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" class="admin-input" placeholder="0">
            </div>

        </div>
    </div>

    <div class="admin-form-actions">
        <button type="submit" class="btn-admin btn-admin--primary">Add Experience</button>
        <a href="{{ route('admin.experiences.index') }}" class="btn-admin btn-admin--ghost">Cancel</a>
    </div>
</form>

@endsection
