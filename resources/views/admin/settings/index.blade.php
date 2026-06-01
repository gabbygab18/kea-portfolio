@extends('layouts.admin')
@section('page-title', 'Settings')

@section('content')
<div class="admin-card">
    <table class="admin-table">
        <thead><tr><th>Key</th><th>Value</th><th></th></tr></thead>
        <tbody>
            @forelse($settings as $setting)
            <tr>
                <td><strong>{{ $setting->key }}</strong></td>
                <td><small>{{ \Illuminate\Support\Str::limit($setting->value, 80) }}</small></td>
                <td style="text-align:right">
                    <a href="{{ route('admin.settings.edit', $setting) }}" class="btn-admin btn-admin-outline btn-admin-sm">Edit</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" style="text-align:center;color:var(--a-muted)">No settings found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
