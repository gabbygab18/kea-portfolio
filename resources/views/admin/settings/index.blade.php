@extends('layouts.admin')
@section('page-title', 'Settings')

@section('content')
<div class="admin-card" style="margin-bottom:1.5rem">
    <div style="padding:1.5rem">
        <h3 style="margin-bottom:1rem;font-size:.95rem;font-weight:700">Font Family</h3>
        <form method="POST" action="{{ route('admin.settings.bulk-update') }}">
            @csrf
            <div style="display:flex;align-items:center;gap:1rem;flex-wrap:wrap">
                <select name="font_family" class="form-control" style="max-width:240px">
                    @foreach(['Inter', 'Poppins', 'Roboto', 'Lato', 'Open Sans', 'Playfair Display'] as $f)
                        <option value="{{ $f }}" {{ \App\Models\Setting::getValue('font_family', 'Inter') === $f ? 'selected' : '' }}>
                            {{ $f }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn-admin btn-admin-primary btn-admin-sm">Save Font</button>
            </div>
        </form>
    </div>
</div>

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
