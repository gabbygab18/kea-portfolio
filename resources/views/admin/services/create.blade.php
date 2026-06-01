@extends('layouts.admin')
@section('page-title', 'Add Service')
@section('topbar-actions')
    <a href="{{ route('admin.services.index') }}" class="btn-admin btn-admin-secondary">← Back</a>
@endsection

@section('content')
<div class="admin-card">
    <form method="POST" action="{{ route('admin.services.store') }}" class="admin-form">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required />
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="4">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label>Order</label>
            <input type="number" name="order" value="{{ old('order', 0) }}" />
        </div>
        <button type="submit" class="btn-admin btn-admin-primary">Save Service</button>
    </form>
</div>
@endsection
