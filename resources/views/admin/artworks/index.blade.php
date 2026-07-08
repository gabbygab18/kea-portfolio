@extends('layouts.admin')
@section('page-title', 'Artworks')
@section('topbar-actions')
    <a href="{{ route('admin.artworks.create') }}" class="btn-admin btn-admin-primary">+ Add Artwork</a>
@endsection

@section('content')
<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width:32px"></th>
                <th>Title</th>
                <th>Category</th>
                <th>Featured</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="sortableBody">
            @forelse($artworks as $artwork)
            <tr data-id="{{ $artwork->id }}">
                <td class="drag-handle" title="Drag to reorder" style="cursor:grab;color:var(--a-muted);text-align:center;font-size:1.1rem">⠿</td>
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
            <tr><td colspan="5" style="text-align:center;color:var(--a-muted)">No artworks yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
    const tbody = document.getElementById('sortableBody');
    if (tbody) {
        Sortable.create(tbody, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd() {
                const ids = [...tbody.querySelectorAll('tr[data-id]')]
                    .map(tr => tr.dataset.id);

                fetch('{{ route('admin.artworks.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ ids }),
                })
                .then(r => r.json())
                .then(data => {
                    if (!data.success) console.error('Reorder failed', data);
                })
                .catch(err => console.error('Reorder error', err));
            }
        });
    }
</script>
<style>
    .sortable-ghost { opacity: 0.4; background: var(--a-surface-2, #1e1e1e); }
    .drag-handle:hover { color: var(--a-primary) !important; cursor: grab; }
</style>
@endpush
