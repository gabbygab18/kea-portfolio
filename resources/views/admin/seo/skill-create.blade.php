@extends('layouts.admin')
@section('title', 'Add SEO Skill')
@section('content')

<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Add SEO Skill</h1>
        <p class="admin-page-subtitle">Add a skill or expertise shown on the SEO page</p>
    </div>
    <a href="{{ route('admin.seo-projects.index') }}" class="btn-admin btn-admin--ghost">← Back</a>
</div>

<form action="{{ route('admin.seo-skills.store') }}" method="POST">
    @csrf

    <div class="admin-card">
        <h3>Skill Details</h3>
        <div class="admin-form-grid">

            <div class="admin-form-group admin-form-group--full">
                <label class="admin-label" for="title">Skill Title <span class="admin-required">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                    class="admin-input @error('title') is-invalid @enderror"
                    placeholder="e.g. On-Page SEO, Link Building, Technical Audit"
                    required>
                @error('title')<p class="admin-error">{{ $message }}</p>@enderror
            </div>

            <div class="admin-form-group admin-form-group--full">
                <label class="admin-label" for="description">Description</label>
                <textarea id="description" name="description" rows="4"
                    class="admin-input admin-textarea"
                    placeholder="Describe what this skill involves and how you apply it...">{{ old('description') }}</textarea>
            </div>

            <div class="admin-form-group">
                <label class="admin-label" for="order">Order</label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}"
                    class="admin-input" placeholder="0">
            </div>

        </div>
    </div>

    <div class="admin-form-actions">
        <button type="submit" class="btn-admin btn-admin--primary">Add Skill</button>
        <a href="{{ route('admin.seo-projects.index') }}" class="btn-admin btn-admin--ghost">Cancel</a>
    </div>
</form>

@endsection
