@extends('layouts.admin')
@section('page-title', 'Edit Skill')
@section('topbar-actions')
    <a href="{{ route('admin.skills.index') }}" class="btn-admin btn-admin-secondary">← Back</a>
@endsection

@section('content')
<div class="admin-card">
    <form method="POST" action="{{ route('admin.skills.update', $skill) }}" class="admin-form">
        @csrf @method('PUT')
        <div class="form-row">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $skill->name) }}" required />
            </div>
            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" value="{{ old('category', $skill->category) }}" />
            </div>
        </div>
        <div class="form-group">
            <label>Order</label>
            <input type="number" name="order" value="{{ old('order', $skill->order) }}" />
        </div>
        <button type="submit" class="btn-admin btn-admin-primary">Update Skill</button>
    </form>
</div>
@endsection
