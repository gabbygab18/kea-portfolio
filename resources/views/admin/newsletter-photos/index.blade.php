@extends('layouts.admin')

@section('page-title', 'Newsletter Photos')

@section('topbar-actions')
    {{-- Upload buttons open the respective modals --}}
    <button class="btn-admin btn-admin--primary" onclick="openModal('left')">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" />
        </svg>
        Add to Left Column
    </button>
    <button class="btn-admin btn-admin--secondary" onclick="openModal('right')">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" />
        </svg>
        Add to Right Column
    </button>
@endsection

@section('content')

<div class="np-page">

    {{-- ── COLUMNS GRID ─────────────────────────────────────── --}}
    <div class="np-columns">

        {{-- LEFT --}}
        <div class="np-column">
            <div class="np-column__head">
                <div class="np-column__title">
                    <span class="np-column__badge np-column__badge--left">Left</span>
                    Scrolls Up
                </div>
                <span class="np-column__count">{{ $leftPhotos->count() }} photo{{ $leftPhotos->count() !== 1 ? 's' : '' }}</span>
            </div>

            @if($leftPhotos->isEmpty())
                <div class="np-empty">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="3" width="18" height="18" rx="3"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <polyline points="21 15 16 10 5 21"/>
                    </svg>
                    <p>No photos yet</p>
                    <button class="btn-admin btn-admin-secondary" onclick="openModal('left')">Upload photos</button>
                </div>
            @else
                <div class="np-grid" id="sortLeft" data-column="left">
                    @foreach($leftPhotos as $photo)
                        <div class="np-card" data-id="{{ $photo->id }}">
                            <div class="np-card__drag" title="Drag to reorder">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="9" cy="5" r="1" fill="currentColor"/><circle cx="15" cy="5" r="1" fill="currentColor"/>
                                    <circle cx="9" cy="12" r="1" fill="currentColor"/><circle cx="15" cy="12" r="1" fill="currentColor"/>
                                    <circle cx="9" cy="19" r="1" fill="currentColor"/><circle cx="15" cy="19" r="1" fill="currentColor"/>
                                </svg>
                            </div>
                            <img src="{{ $photo->url }}" alt="{{ $photo->alt }}" class="np-card__img" />
                            <div class="np-card__footer">
                                <span class="np-card__alt">{{ $photo->alt ?: '—' }}</span>
                                <form method="POST"
                                    action="{{ route('admin.newsletter-photos.destroy', $photo) }}"
                                    onsubmit="return confirm('Delete this photo?')"
                                    class="np-card__delete-form">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="np-card__delete" title="Delete">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                                            <path d="M10 11v6M14 11v6"/>
                                            <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- RIGHT --}}
        <div class="np-column">
            <div class="np-column__head">
                <div class="np-column__title">
                    <span class="np-column__badge np-column__badge--right">Right</span>
                    Scrolls Down
                </div>
                <span class="np-column__count">{{ $rightPhotos->count() }} photo{{ $rightPhotos->count() !== 1 ? 's' : '' }}</span>
            </div>

            @if($rightPhotos->isEmpty())
                <div class="np-empty">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="3" width="18" height="18" rx="3"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <polyline points="21 15 16 10 5 21"/>
                    </svg>
                    <p>No photos yet</p>
                    <button class="btn-admin btn-admin-secondary" onclick="openModal('right')">Upload photos</button>
                </div>
            @else
                <div class="np-grid" id="sortRight" data-column="right">
                    @foreach($rightPhotos as $photo)
                        <div class="np-card" data-id="{{ $photo->id }}">
                            <div class="np-card__drag" title="Drag to reorder">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="9" cy="5" r="1" fill="currentColor"/><circle cx="15" cy="5" r="1" fill="currentColor"/>
                                    <circle cx="9" cy="12" r="1" fill="currentColor"/><circle cx="15" cy="12" r="1" fill="currentColor"/>
                                    <circle cx="9" cy="19" r="1" fill="currentColor"/><circle cx="15" cy="19" r="1" fill="currentColor"/>
                                </svg>
                            </div>
                            <img src="{{ $photo->url }}" alt="{{ $photo->alt }}" class="np-card__img" />
                            <div class="np-card__footer">
                                <span class="np-card__alt">{{ $photo->alt ?: '—' }}</span>
                                <form method="POST"
                                    action="{{ route('admin.newsletter-photos.destroy', $photo) }}"
                                    onsubmit="return confirm('Delete this photo?')"
                                    class="np-card__delete-form">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="np-card__delete" title="Delete">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                                            <path d="M10 11v6M14 11v6"/>
                                            <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>{{-- /.np-columns --}}

    {{-- ── TIPS ─────────────────────────────────────────────── --}}
    <div class="np-tips">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        Drag cards within a column to reorder. Changes save automatically. Recommended image size: <strong>218 × 200 px</strong> or taller (portrait works best).
    </div>

</div>{{-- /.np-page --}}


{{-- ── UPLOAD MODAL ─────────────────────────────────────────── --}}
<div class="np-modal-overlay" id="uploadModal">
    <div class="np-modal">
        <div class="np-modal__head">
            <h3 class="np-modal__title" id="modalTitle">Upload Photos</h3>
            <button class="np-modal__close" onclick="closeModal()" type="button">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <line x1="2" y1="2" x2="12" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <line x1="12" y1="2" x2="2" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </div>

        <form method="POST" action="{{ route('admin.newsletter-photos.store') }}"
              enctype="multipart/form-data" class="np-modal__form" id="uploadForm">
            @csrf
            <input type="hidden" name="column" id="columnInput" value="left" />

            {{-- Drop zone --}}
            <label class="np-dropzone" id="dropzone" for="photoFiles">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                    <polyline points="16 16 12 12 8 16"/>
                    <line x1="12" y1="12" x2="12" y2="21"/>
                    <path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3"/>
                </svg>
                <span class="np-dropzone__text">Drop images here or <u>browse</u></span>
                <span class="np-dropzone__hint">JPG, PNG, WebP · max 4 MB each · multiple allowed</span>
                <input type="file" name="photos[]" id="photoFiles" multiple
                    accept="image/jpeg,image/png,image/webp,image/gif" class="np-dropzone__input" />
            </label>

            {{-- Preview strip --}}
            <div class="np-preview" id="previewStrip"></div>

            {{-- Alt text --}}
            <div class="np-modal__field">
                <label for="altInput">Alt text <span style="opacity:.55;font-weight:400">(optional, applies to all uploaded)</span></label>
                <input type="text" name="alt" id="altInput" placeholder="e.g. UI design showcase" class="np-modal__input" />
            </div>

            <div class="np-modal__actions">
                <button type="button" class="btn-admin btn-admin-outline" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn-admin btn-admin--primary" id="uploadBtn" disabled>
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
<style>
/* ── Page layout ───────────────────────────────────────── */
.np-page {
    display: flex;
    flex-direction: column;
    gap: 28px;
}

.np-columns {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

@media (max-width: 768px) {
    .np-columns { grid-template-columns: 1fr; }
}

/* ── Column panel ──────────────────────────────────────── */
.np-column {
    background: var(--a-glass-bg);
    border: 1px solid var(--a-glass-border);
    border-radius: var(--a-radius-lg);
    overflow: hidden;
}

.np-column__head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px;
    border-bottom: 1px solid var(--a-border);
    background: var(--a-surface-2);
}

.np-column__title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 600;
    color: var(--a-white);
}

.np-column__badge {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    padding: 2px 8px;
    border-radius: 20px;
}

.np-column__badge--left  { background: var(--a-accent-dim); color: var(--a-accent); border: 1px solid var(--a-glass-border); }
.np-column__badge--right { background: var(--a-surface-3);  color: var(--a-muted-2); border: 1px solid var(--a-border); }

.np-column__count {
    font-size: 12px;
    color: var(--a-muted);
}

/* ── Photo grid ────────────────────────────────────────── */
.np-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
    gap: 14px;
    padding: 20px;
    min-height: 100px;
}

/* ── Photo card ────────────────────────────────────────── */
.np-card {
    position: relative;
    border-radius: var(--a-radius);
    overflow: hidden;
    border: 1px solid var(--a-border);
    background: var(--a-surface-2);
    cursor: grab;
    transition: box-shadow .18s, transform .18s, border-color .18s;
    user-select: none;
}

.np-card:hover {
    border-color: var(--a-border-hover);
}

.np-card:active { cursor: grabbing; }

.np-card.dragging {
    opacity: .45;
    transform: scale(.97);
    box-shadow: var(--a-shadow);
}

.np-card__drag {
    position: absolute;
    top: 6px;
    left: 6px;
    z-index: 2;
    background: rgba(0,0,0,.55);
    border-radius: 4px;
    padding: 3px 4px;
    color: var(--a-muted);
    line-height: 0;
    pointer-events: none;
}

.np-card__img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    display: block;
}

.np-card__footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 6px 8px;
    gap: 6px;
    background: var(--a-surface-2);
}

.np-card__alt {
    font-size: 11px;
    color: var(--a-muted);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    flex: 1;
}

.np-card__delete-form { flex-shrink: 0; }

.np-card__delete {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--a-muted);
    display: flex;
    align-items: center;
    padding: 2px;
    border-radius: 4px;
    transition: color .15s, background .15s;
}

.np-card__delete:hover {
    color: var(--a-white);
    background: rgba(255,255,255,.08);
}

/* ── Empty state ───────────────────────────────────────── */
.np-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 48px 24px;
    color: var(--a-muted);
    text-align: center;
}

.np-empty svg { opacity: .3; color: var(--a-muted); }
.np-empty p   { font-size: 13px; margin: 0; color: var(--a-muted); }

/* ── Tips bar ──────────────────────────────────────────── */
.np-tips {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12.5px;
    color: var(--a-muted);
    background: var(--a-glass-bg);
    border: 1px solid var(--a-glass-border);
    border-radius: var(--a-radius);
    padding: 12px 16px;
}

.np-tips strong { color: var(--a-muted-2); }
.np-tips svg { flex-shrink: 0; opacity: .5; }

/* ── Modal overlay ─────────────────────────────────────── */
.np-modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.65);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    z-index: 9000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    opacity: 0;
    pointer-events: none;
    transition: opacity .22s ease;
}

.np-modal-overlay.open {
    opacity: 1;
    pointer-events: all;
}

.np-modal {
    background: var(--a-surface);
    border: 1px solid var(--a-glass-border);
    border-radius: var(--a-radius-lg);
    width: 480px;
    max-width: 100%;
    box-shadow: var(--a-shadow), var(--a-shadow-glow);
    transform: translateY(20px) scale(.97);
    transition: transform .28s cubic-bezier(.34,1.4,.64,1);
    overflow: hidden;
}

.np-modal-overlay.open .np-modal {
    transform: translateY(0) scale(1);
}

.np-modal__head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 22px 0;
}

.np-modal__title {
    font-size: 16px;
    font-weight: 700;
    color: var(--a-white);
    margin: 0;
}

.np-modal__close {
    width: 30px;
    height: 30px;
    border: none;
    border-radius: var(--a-radius);
    background: var(--a-surface-3);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--a-muted);
    transition: background .15s, color .15s;
}
.np-modal__close:hover {
    background: var(--a-border-hover);
    color: var(--a-white);
}

.np-modal__form {
    display: flex;
    flex-direction: column;
    gap: 18px;
    padding: 20px 22px 24px;
}

/* Drop zone */
.np-dropzone {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 32px 20px;
    border: 2px dashed var(--a-border);
    border-radius: var(--a-radius);
    cursor: pointer;
    text-align: center;
    transition: border-color .18s, background .18s;
    color: var(--a-muted);
}

.np-dropzone:hover,
.np-dropzone.drag-over {
    border-color: var(--a-accent);
    background: var(--a-accent-dim);
}

.np-dropzone__text  { font-size: 14px; font-weight: 500; color: var(--a-muted-2); }
.np-dropzone__hint  { font-size: 12px; color: var(--a-muted); }

.np-dropzone__input {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
    width: 100%;
    height: 100%;
}

/* Preview strip */
.np-preview {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.np-preview__thumb {
    width: 64px;
    height: 64px;
    border-radius: 6px;
    object-fit: cover;
    border: 1.5px solid var(--a-border);
}

/* Field */
.np-modal__field {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.np-modal__field label {
    font-size: 13px;
    font-weight: 600;
    color: var(--a-muted);
    text-transform: uppercase;
    letter-spacing: .06em;
}

.np-modal__input {
    width: 100%;
    padding: 11px 13px;
    background: var(--a-glass-bg);
    border: 1px solid var(--a-border);
    border-radius: var(--a-radius);
    font-family: var(--a-font-ui);
    font-size: 14px;
    color: var(--a-text);
    outline: none;
    transition: border-color .18s, box-shadow .18s;
}

.np-modal__input::placeholder { color: var(--a-muted); }

.np-modal__input:focus {
    border-color: var(--a-accent);
    box-shadow: 0 0 0 3px var(--a-accent-glow);
}

/* Actions */
.np-modal__actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}
</style>
@endpush

@push('scripts')
<script>
/* ── Modal open/close ──────────────────────────────── */
function openModal(column) {
    document.getElementById('columnInput').value = column;
    document.getElementById('modalTitle').textContent =
        'Upload Photos — ' + (column === 'left' ? 'Left Column' : 'Right Column');
    document.getElementById('uploadModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('uploadModal').classList.remove('open');
    document.body.style.overflow = '';
    // reset
    document.getElementById('previewStrip').innerHTML = '';
    document.getElementById('photoFiles').value = '';
    document.getElementById('altInput').value = '';
    document.getElementById('uploadBtn').disabled = true;
}

document.getElementById('uploadModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

/* ── File preview ──────────────────────────────────── */
document.getElementById('photoFiles').addEventListener('change', function() {
    const strip = document.getElementById('previewStrip');
    strip.innerHTML = '';
    const btn = document.getElementById('uploadBtn');
    if (!this.files.length) { btn.disabled = true; return; }

    Array.from(this.files).forEach(f => {
        const img = document.createElement('img');
        img.className = 'np-preview__thumb';
        img.src = URL.createObjectURL(f);
        strip.appendChild(img);
    });
    btn.disabled = false;
});

/* ── Drag-over styling on dropzone ─────────────────── */
const dz = document.getElementById('dropzone');
['dragover','dragenter'].forEach(ev => dz.addEventListener(ev, e => { e.preventDefault(); dz.classList.add('drag-over'); }));
['dragleave','drop'].forEach(ev => dz.addEventListener(ev, () => dz.classList.remove('drag-over')));

/* ── Drag-to-reorder (vanilla, no library) ─────────── */
const reorderUrl = "{{ route('admin.newsletter-photos.reorder') }}";
const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

document.querySelectorAll('.np-grid').forEach(grid => {
    let dragged = null;

    grid.addEventListener('dragstart', e => {
        dragged = e.target.closest('.np-card');
        if (!dragged) return;
        dragged.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
    });

    grid.addEventListener('dragend', () => {
        if (dragged) dragged.classList.remove('dragging');
        dragged = null;
        saveOrder(grid);
    });

    grid.addEventListener('dragover', e => {
        e.preventDefault();
        const target = e.target.closest('.np-card');
        if (!target || target === dragged) return;
        const rect = target.getBoundingClientRect();
        const mid  = rect.left + rect.width / 2;
        target.parentNode.insertBefore(dragged, e.clientX < mid ? target : target.nextSibling);
    });

    // Make cards draggable
    grid.querySelectorAll('.np-card').forEach(c => c.setAttribute('draggable', 'true'));
});

function saveOrder(grid) {
    const ids = Array.from(grid.querySelectorAll('.np-card')).map(c => c.dataset.id);
    fetch(reorderUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
        body: JSON.stringify({ ids }),
    });
}
</script>
@endpush
