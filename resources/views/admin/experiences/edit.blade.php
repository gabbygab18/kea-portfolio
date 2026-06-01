@extends('layouts.admin')
@section('title', 'Edit Experience')
@section('content')

<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Edit Experience</h1>
        <p class="admin-page-subtitle">{{ $experience->company }}</p>
    </div>
    <a href="{{ route('admin.experiences.index') }}" class="btn-admin btn-admin--ghost">← Back</a>
</div>

<form action="{{ route('admin.experiences.update', $experience) }}" method="POST">
    @csrf @method('PUT')
    <div class="admin-card">
        <div class="admin-form-grid">

            <div class="admin-form-group">
                <label class="admin-label">Company <span class="admin-required">*</span></label>
                <input type="text" name="company" value="{{ old('company', $experience->company) }}" class="admin-input" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-label">Type</label>
                <input type="text" name="type" value="{{ old('type', $experience->type) }}" class="admin-input">
            </div>

            <div class="admin-form-group admin-form-group--full">
                <label class="admin-label">Role <span class="admin-required">*</span></label>
                <input type="text" name="role" value="{{ old('role', $experience->role) }}" class="admin-input" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-label">Date Range</label>
                <input type="text" name="date_range" value="{{ old('date_range', $experience->date_range) }}" class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-label">Location</label>
                <input type="text" name="location" value="{{ old('location', $experience->location) }}" class="admin-input">
            </div>

            <div class="admin-form-group admin-form-group--full">
                <label class="admin-label">Bullet Points <span class="admin-form-hint">(one per line)</span></label>
                <textarea name="bullets" rows="6" class="admin-input admin-textarea">{{ old('bullets', is_array($experience->bullets) ? implode("\n", $experience->bullets) : $experience->bullets) }}</textarea>
            </div>

            <div class="admin-form-group">
                <label class="admin-label">Order</label>
                <input type="number" name="order" value="{{ old('order', $experience->order) }}" class="admin-input">
            </div>

        </div>
    </div>

    <div class="admin-form-actions">
        <button type="submit" class="btn-admin btn-admin--primary">Save Changes</button>
        <a href="{{ route('admin.experiences.index') }}" class="btn-admin btn-admin--ghost">Cancel</a>
    </div>
</form>

<form action="{{ route('admin.experiences.destroy', $experience) }}" method="POST"
      onsubmit="return confirm('Delete this experience? This cannot be undone.')"
      style="margin-top:.75rem;display:flex;justify-content:flex-end">
    @csrf @method('DELETE')
    <button type="submit" class="btn-admin btn-admin--danger">Delete Experience</button>
</form>

@endsection
