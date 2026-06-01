@extends('layouts.admin')
@section('page-title', 'Skills')
@section('topbar-actions')
    <a href="{{ route('admin.skills.create') }}" class="btn-admin btn-admin-primary">+ Add Skill</a>
@endsection

@section('content')
<div class="admin-card">
    <table class="admin-table">
        <thead><tr><th>Name</th><th>Category</th><th>Order</th><th></th></tr></thead>
        <tbody>
            @forelse($skills as $skill)
            <tr>
                <td><strong>{{ $skill->name }}</strong></td>
                <td>{{ $skill->category }}</td>
                <td>{{ $skill->order }}</td>
                <td style="text-align:right;white-space:nowrap">
                    <a href="{{ route('admin.skills.edit', $skill) }}" class="btn-admin btn-admin-outline btn-admin-sm">Edit</a>
                    <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Delete this skill?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-admin btn-admin-danger btn-admin-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center;color:var(--a-muted)">No skills yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
