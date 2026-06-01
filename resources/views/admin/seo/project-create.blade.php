@extends('layouts.admin')
@section('title', 'Add SEO Project')
@section('content')

<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Add SEO Project</h1>
        <p class="admin-page-subtitle">Create a new SEO case study</p>
    </div>
    <a href="{{ route('admin.seo-projects.index') }}" class="btn-admin btn-admin--ghost">← Back</a>
</div>

<form action="{{ route('admin.seo-projects.store') }}" method="POST">
    @csrf

    {{-- ── BASIC INFO ── --}}
    <div class="admin-card">
        <h3>Basic Info</h3>
        <div class="admin-form-grid">

            <div class="admin-form-group admin-form-group--full">
                <label class="admin-label" for="title">Project Title <span class="admin-required">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                    class="admin-input @error('title') is-invalid @enderror"
                    placeholder="e.g. Monte Carlo Technologies SEO Audit" required>
                @error('title')<p class="admin-error">{{ $message }}</p>@enderror
            </div>

            <div class="admin-form-group">
                <label class="admin-label" for="client">Client / Company</label>
                <input type="text" id="client" name="client" value="{{ old('client') }}"
                    class="admin-input" placeholder="e.g. Monte Carlo Technologies">
            </div>

            <div class="admin-form-group">
                <label class="admin-label" for="category">Category</label>
                <input type="text" id="category" name="category" value="{{ old('category') }}"
                    class="admin-input" placeholder="e.g. Technical SEO, On-Page SEO">
            </div>

            <div class="admin-form-group admin-form-group--full">
                <label class="admin-label" for="description">Short Description</label>
                <textarea id="description" name="description" rows="3"
                    class="admin-input admin-textarea"
                    placeholder="Brief overview shown on the SEO page card...">{{ old('description') }}</textarea>
            </div>

            <div class="admin-form-group admin-form-group--full">
                <label class="admin-label" for="overview">Project Overview</label>
                <textarea id="overview" name="overview" rows="5"
                    class="admin-input admin-textarea"
                    placeholder="Detailed breakdown of what was done, strategies applied, challenges...">{{ old('overview') }}</textarea>
            </div>

            <div class="admin-form-group">
                <label class="admin-label" for="link">Live URL / Case Study Link</label>
                <input type="url" id="link" name="link" value="{{ old('link') }}"
                    class="admin-input" placeholder="https://example.com">
            </div>

            <div class="admin-form-group">
                <label class="admin-label" for="order">Order</label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}"
                    class="admin-input" placeholder="0">
            </div>

            <div class="admin-form-group">
                <label class="admin-label">Options</label>
                <label class="admin-toggle">
                    <input type="hidden" name="featured" value="0">
                    <input type="checkbox" name="featured" value="1"
                        {{ old('featured') ? 'checked' : '' }}>
                    <span class="admin-toggle__track"></span>
                    <span class="admin-toggle__label">Feature on SEO page</span>
                </label>
            </div>

        </div>
    </div>

    {{-- ── TOOLS USED ── --}}
    <div class="admin-card">
        <h3>Tools Used <span style="font-weight:400;font-size:.8rem;color:#666">(one per line)</span></h3>
        <textarea name="tools" rows="5" class="admin-input admin-textarea"
            placeholder="Google Search Console&#10;Ahrefs&#10;Screaming Frog&#10;Google Analytics">{{ old('tools') }}</textarea>
    </div>

    {{-- ── RESULTS ── --}}
    <div class="admin-card">
        <h3>Key Results <span style="font-weight:400;font-size:.8rem;color:#666">(one per line — shown as bullet points with ↑ prefix)</span></h3>
        <textarea name="results" rows="5" class="admin-input admin-textarea"
            placeholder="Improved page ranking from position 18 to position 3&#10;Organic traffic increased by 42%&#10;Core Web Vitals score improved to 94">{{ old('results') }}</textarea>
    </div>

    <div class="admin-form-actions">
        <button type="submit" class="btn-admin btn-admin--primary">Add Project</button>
        <a href="{{ route('admin.seo-projects.index') }}" class="btn-admin btn-admin--ghost">Cancel</a>
    </div>

</form>
@endsection
