@extends('layouts.admin')
@section('title', 'Edit SEO Skill')
@section('content')

<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Edit SEO Skill</h1>
        <p class="admin-page-subtitle">{{ $skill->title }}</p>
    </div>
    <a href="{{ route('admin.seo-projects.index') }}" class="btn-admin btn-admin--ghost">← Back</a>
</div>

<form action="{{ route('admin.seo-skills.update', $skill) }}" method="POST">
    @csrf @method('PUT')

    <div class="admin-card">
        <h3>Skill Details</h3>
        <div class="admin-form-grid">

            <div class="admin-form-group admin-form-group--full">
                <label class="admin-label" for="title">Skill Title <span class="admin-required">*</span></label>
                <input type="text" id="title" name="title"
                    value="{{ old('title', $skill->title) }}"
                    class="admin-input @error('title') is-invalid @enderror"
                    required>
                @error('title')<p class="admin-error">{{ $message }}</p>@enderror
            </div>

            <div class="admin-form-group admin-form-group--full">
                <label class="admin-label" for="description">Description</label>
                <textarea id="description" name="description" rows="4"
                    class="admin-input admin-textarea">{{ old('description', $skill->description) }}</textarea>
            </div>

            <div class="admin-form-group">
                <label class="admin-label" for="order">Order</label>
                <input type="number" id="order" name="order"
                    value="{{ old('order', $skill->order) }}" class="admin-input">
            </div>

        </div>
    </div>

    <div class="admin-form-actions">
        <button type="submit" class="btn-admin btn-admin--primary">Save Changes</button>
        <a href="{{ route('admin.seo-projects.index') }}" class="btn-admin btn-admin--ghost">Cancel</a>
    </div>
</form>

<form action="{{ route('admin.seo-skills.destroy', $skill) }}" method="POST"
      onsubmit="return confirm('Delete this skill? This cannot be undone.')"
      style="margin-top:.75rem;display:flex;justify-content:flex-end">
    @csrf @method('DELETE')
    <button type="submit" class="btn-admin btn-admin--danger">Delete Skill</button>
</form>

@endsection
