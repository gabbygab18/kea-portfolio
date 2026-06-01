@extends('layouts.admin')
@section('page-title', 'Messages')

@section('content')
<div class="admin-card">
    <table class="admin-table">
        <thead><tr><th>Name</th><th>Email</th><th>Date</th><th></th></tr></thead>
        <tbody>
            @forelse($messages as $message)
            <tr>
                <td><strong>{{ $message->name }}</strong></td>
                <td>{{ $message->email }}</td>
                <td><small>{{ $message->created_at->format('Y-m-d') }}</small></td>
                <td style="text-align:right;white-space:nowrap">
                    <a href="{{ route('admin.messages.show', $message) }}" class="btn-admin btn-admin-outline btn-admin-sm">View</a>
                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Delete this message?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-admin btn-admin-danger btn-admin-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center;color:var(--a-muted)">No messages yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
