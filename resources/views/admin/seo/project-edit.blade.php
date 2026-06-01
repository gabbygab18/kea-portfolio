@extends('layouts.admin')
@section('title', 'Edit SEO Project')
@section('content')

<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Edit SEO Project</h1>
        <p class="admin-page-subtitle">{{ $project->title }}</p>
    </div>
    <a href="{{ route('admin.seo-projects.index') }}" class="btn-admin btn-admin--ghost">← Back</a>
</div>

<form action="{{ route('admin.seo-projects.update', $project) }}" method="POST">
    @csrf @method('PUT')

    {{-- ── BASIC INFO ── --}}
    <div class="admin-card">
        <h3>Basic Info</h3>
        <div class="admin-form-grid">

            <div class="admin-form-group admin-form-group--full">
                <label class="admin-label" for="title">Project Title <span class="admin-required">*</span></label>
                <input type="text" id="title" name="title"
                    value="{{ old('title', $project->title) }}"
                    class="admin-input @error('title') is-invalid @enderror" required>
                @error('title')<p class="admin-error">{{ $message }}</p>@enderror
            </div>

            <div class="admin-form-group">
                <label class="admin-label" for="client">Client / Company</label>
                <input type="text" id="client" name="client"
                    value="{{ old('client', $project->client) }}" class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-label" for="category">Category</label>
                <input type="text" id="category" name="category"
                    value="{{ old('category', $project->category) }}" class="admin-input">
            </div>

            <div class="admin-form-group admin-form-group--full">
                <label class="admin-label" for="description">Short Description</label>
                <textarea id="description" name="description" rows="3"
                    class="admin-input admin-textarea">{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="admin-form-group admin-form-group--full">
                <label class="admin-label" for="overview">Project Overview</label>
                <textarea id="overview" name="overview" rows="5"
                    class="admin-input admin-textarea">{{ old('overview', $project->overview) }}</textarea>
            </div>

            <div class="admin-form-group">
                <label class="admin-label" for="link">Live URL / Case Study Link</label>
                <input type="url" id="link" name="link"
                    value="{{ old('link', $project->link) }}" class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-label" for="order">Order</label>
                <input type="number" id="order" name="order"
                    value="{{ old('order', $project->order) }}" class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-label">Options</label>
                <label class="admin-toggle">
                    <input type="hidden" name="featured" value="0">
                    <input type="checkbox" name="featured" value="1"
                        {{ old('featured', $project->featured) ? 'checked' : '' }}>
                    <span class="admin-toggle__track"></span>
                    <span class="admin-toggle__label">Feature on SEO page</span>
                </label>
            </div>

        </div>
    </div>

    {{-- ── TOOLS USED ── --}}
    <div class="admin-card">
        <h3>Tools Used <span style="font-weight:400;font-size:.8rem;color:#666">(one per line)</span></h3>
        <textarea name="tools" rows="5" class="admin-input admin-textarea">{{ old('tools', is_array($project->tools) ? implode("\n", $project->tools) : $project->tools) }}</textarea>
    </div>

    {{-- ── RESULTS ── --}}
    <div class="admin-card">
        <h3>Key Results <span style="font-weight:400;font-size:.8rem;color:#666">(one per line)</span></h3>
        <textarea name="results" rows="5" class="admin-input admin-textarea">{{ old('results', is_array($project->results) ? implode("\n", $project->results) : $project->results) }}</textarea>
    </div>

    <div class="admin-form-actions">
        <button type="submit" class="btn-admin btn-admin--primary">Save Changes</button>
        <a href="{{ route('admin.seo-projects.index') }}" class="btn-admin btn-admin--ghost">Cancel</a>
    </div>

</form>

<form action="{{ route('admin.seo-projects.destroy', $project) }}" method="POST"
      onsubmit="return confirm('Delete this project? This cannot be undone.')"
      style="margin-top:.75rem;display:flex;justify-content:flex-end">
    @csrf @method('DELETE')
    <button type="submit" class="btn-admin btn-admin--danger">Delete Project</button>
</form>

@endsection
