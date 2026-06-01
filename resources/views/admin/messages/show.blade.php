@extends('layouts.admin')
@section('page-title', 'Message Detail')
@section('topbar-actions')
    <a href="{{ route('admin.messages.index') }}" class="btn-admin btn-admin-secondary">← Back</a>
    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this message?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn-admin btn-admin-danger">Delete</button>
    </form>
@endsection

@section('content')
<div class="admin-card">
    <div class="message-meta-grid">
        <div class="meta-item">
            <div class="meta-label">Name</div>
            <div class="meta-value">{{ $message->name }}</div>
        </div>
        <div class="meta-item">
            <div class="meta-label">Email</div>
            <div class="meta-value"><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></div>
        </div>
        @if($message->phone)
        <div class="meta-item">
            <div class="meta-label">Phone</div>
            <div class="meta-value">{{ $message->phone }}</div>
        </div>
        @endif
        @if($message->company)
        <div class="meta-item">
            <div class="meta-label">Company</div>
            <div class="meta-value">{{ $message->company }}</div>
        </div>
        @endif
        <div class="meta-item">
            <div class="meta-label">Received</div>
            <div class="meta-value">{{ $message->created_at->format('F j, Y H:i') }}</div>
        </div>
    </div>
    <div class="message-body">{{ $message->message }}</div>
</div>
@endsection
