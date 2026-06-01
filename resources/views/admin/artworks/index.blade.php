@extends('layouts.admin')
@section('page-title', 'Artworks')
@section('topbar-actions')
    <a href="{{ route('admin.artworks.create') }}" class="btn-admin btn-admin-primary">+ Add Artwork</a>
@endsection

@section('content')
<div class="admin-card">
    <table class="admin-table">
        <thead><tr><th>Title</th><th>Category</th><th>Featured</th><th></th></tr></thead>
        <tbody>
            @forelse($artworks as $artwork)
            <tr>
                <td><strong>{{ $artwork->title }}</strong><br><small>{{ $artwork->slug }}</small></td>
                <td>{{ $artwork->category }}</td>
                <td>
                    @if($artwork->featured)
                        <span class="badge badge-success">Yes</span>
                    @else
                        <span class="badge badge-secondary">No</span>
                    @endif
                </td>
                <td style="text-align:right;white-space:nowrap">
                    <a href="{{ route('admin.artworks.edit', $artwork) }}" class="btn-admin btn-admin-outline btn-admin-sm">Edit</a>
                    <form action="{{ route('admin.artworks.destroy', $artwork) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Delete this artwork?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-admin btn-admin-danger btn-admin-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center;color:var(--a-muted)">No artworks yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
