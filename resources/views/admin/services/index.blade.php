@extends('layouts.admin')
@section('page-title', 'Services')
@section('topbar-actions')
    <a href="{{ route('admin.services.create') }}" class="btn-admin btn-admin-primary">+ Add Service</a>
@endsection

@section('content')
<div class="admin-card">
    <table class="admin-table">
        <thead><tr><th>Title</th><th>Order</th><th></th></tr></thead>
        <tbody>
            @forelse($services as $service)
            <tr>
                <td><strong>{{ $service->title }}</strong></td>
                <td>{{ $service->order }}</td>
                <td style="text-align:right;white-space:nowrap">
                    <a href="{{ route('admin.services.edit', $service) }}" class="btn-admin btn-admin-outline btn-admin-sm">Edit</a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Delete this service?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-admin btn-admin-danger btn-admin-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" style="text-align:center;color:var(--a-muted)">No services yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
