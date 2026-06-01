@extends('layouts.admin')
@section('title', 'Add SEO Tool')
@section('content')

<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Add SEO Tool</h1>
        <p class="admin-page-subtitle">Add a tool shown on the SEO page</p>
    </div>
    <a href="{{ route('admin.seo-projects.index') }}" class="btn-admin btn-admin--ghost">← Back</a>
</div>

{{-- enctype required for file upload --}}
<form action="{{ route('admin.seo-tools.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="admin-card">
        <div class="admin-form-grid">

            <div class="admin-form-group">
                <label class="admin-label" for="name">Tool Name <span class="admin-required">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="admin-input @error('name') is-invalid @enderror"
                    placeholder="e.g. Google Search Console" required>
                @error('name')<p class="admin-error">{{ $message }}</p>@enderror
            </div>

            <div class="admin-form-group">
                <label class="admin-label" for="category">Category Tag</label>
                <input type="text" id="category" name="category" value="{{ old('category') }}"
                    class="admin-input" placeholder="e.g. Analytics, Technical, Research">
            </div>

            <div class="admin-form-group admin-form-group--full">
                <label class="admin-label" for="description">Description</label>
                <textarea id="description" name="description" rows="2"
                    class="admin-input admin-textarea"
                    placeholder="What this tool is used for...">{{ old('description') }}</textarea>
            </div>

            {{-- Icon Upload --}}
            <div class="admin-form-group">
                <label class="admin-label">Icon Image</label>
                <p class="admin-form-hint" style="margin-bottom:.5rem">Upload a PNG/SVG icon for this tool.</p>
                <div class="admin-image-upload-zone" id="iconZone">
                    <div class="admin-image-upload-zone__inner" id="iconPrompt">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="17 8 12 3 7 8"/>
                            <line x1="12" y1="3" x2="12" y2="15"/>
                        </svg>
                        <p>Drop or <label for="icon" class="admin-image-upload-zone__link">browse</label></p>
                        <p class="admin-image-upload-zone__hint">PNG, JPG, SVG, WEBP — max 2MB</p>
                    </div>
                    <img id="iconPreview" class="admin-image-preview" src="#" alt="" style="display:none">
                    <input type="file" id="icon" name="icon" accept="image/*" class="admin-file-input"
                        onchange="previewSingle(this,'iconPreview','iconPrompt')">
                </div>
                @error('icon')<p class="admin-error">{{ $message }}</p>@enderror
            </div>

            {{-- Fallback: manual filename --}}
            <div class="admin-form-group">
                <label class="admin-label" for="icon_path">
                    — or — Icon Filename
                    <span class="admin-form-hint">(from public/images/)</span>
                </label>
                <input type="text" id="icon_path" name="icon_path" value="{{ old('icon_path') }}"
                    class="admin-input" placeholder="e.g. gsc.png">
                <p class="admin-form-hint" style="margin-top:.35rem">Upload above takes priority over this field.</p>
            </div>

            <div class="admin-form-group">
                <label class="admin-label" for="order">Order</label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}"
                    class="admin-input" placeholder="0">
            </div>

        </div>
    </div>

    <div class="admin-form-actions">
        <button type="submit" class="btn-admin btn-admin--primary">Add Tool</button>
        <a href="{{ route('admin.seo-projects.index') }}" class="btn-admin btn-admin--ghost">Cancel</a>
    </div>
</form>

<script>
function previewSingle(input, previewId, promptId) {
    if (!input.files[0]) return;
    const r = new FileReader();
    r.onload = e => {
        document.getElementById(previewId).src = e.target.result;
        document.getElementById(previewId).style.display = 'block';
        document.getElementById(promptId).style.display = 'none';
    };
    r.readAsDataURL(input.files[0]);
}

// Drag & drop
document.addEventListener('dragover', e => {
    const zone = e.target.closest('.admin-image-upload-zone');
    if (zone) { e.preventDefault(); zone.classList.add('is-dragging'); }
});
document.addEventListener('dragleave', e => {
    const zone = e.target.closest('.admin-image-upload-zone');
    if (zone) zone.classList.remove('is-dragging');
});
document.addEventListener('drop', e => {
    const zone = e.target.closest('.admin-image-upload-zone');
    if (!zone) return;
    e.preventDefault();
    zone.classList.remove('is-dragging');
    const file = e.dataTransfer.files[0];
    if (!file || !file.type.startsWith('image/')) return;
    const input = zone.querySelector('input[type=file]');
    const dt = new DataTransfer(); dt.items.add(file); input.files = dt.files;
    input.dispatchEvent(new Event('change'));
});
</script>
@endsection
