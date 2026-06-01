@extends('layouts.admin')
@section('page-title', 'Edit Setting')
@section('topbar-actions')
    <a href="{{ route('admin.settings.index') }}" class="btn-admin btn-admin-secondary">← Back</a>
@endsection

@section('content')
<div class="admin-card">
    <form method="POST" action="{{ route('admin.settings.update', $setting) }}" class="admin-form">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Key</label>
            <input type="text" value="{{ $setting->key }}" disabled style="opacity:0.5" />
        </div>
        <div class="form-group">
            <label>Value</label>
            <textarea name="value" rows="4">{{ old('value', $setting->value) }}</textarea>
        </div>
        <button type="submit" class="btn-admin btn-admin-primary">Update Setting</button>
    </form>
</div>
@endsection
