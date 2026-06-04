@extends('layouts.admin')

@section('title', 'Edit Artwork')
@section('page-title', 'Edit Artwork')

@section('content')
    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Edit Artwork</h1>
            <p class="admin-page-subtitle">{{ $artwork->title }}</p>
        </div>
        <a href="{{ route('admin.artworks.index') }}" class="btn-admin btn-admin--ghost">← Back</a>
    </div>

    <form action="{{ route('admin.artworks.update', $artwork) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ── BASIC INFO ──────────────────────────────────────────── --}}
        <div class="admin-card">
            <h3>Basic Info</h3>
            <div class="admin-form-grid">

                <div class="admin-form-group admin-form-group--full">
                    <label class="admin-label" for="title">Title <span class="admin-required">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $artwork->title) }}"
                        class="admin-input @error('title') is-invalid @enderror" placeholder="e.g. TUC Urgent Care"
                        required>
                    @error('title')<p class="admin-error">{{ $message }}</p>@enderror
                </div>

                <div class="admin-form-group">
                    <label class="admin-label" for="slug">Slug <span class="admin-required">*</span></label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $artwork->slug) }}"
                        class="admin-input @error('slug') is-invalid @enderror" placeholder="tuc-urgent-care" required>
                    @error('slug')<p class="admin-error">{{ $message }}</p>@enderror
                </div>

                <div class="admin-form-group">
                    <label class="admin-label" for="category">Category</label>
                    <input type="text" id="category" name="category" value="{{ old('category', $artwork->category) }}"
                        class="admin-input" placeholder="e.g. UI/UX Design">
                </div>

                <div class="admin-form-group admin-form-group--full">
                    <label class="admin-label" for="description">Description</label>
                    <textarea id="description" name="description" rows="3" class="admin-input admin-textarea"
                        placeholder="Short description shown on the artworks grid...">{{ old('description', $artwork->description) }}</textarea>
                </div>

                <div class="admin-form-group admin-form-group--full">
                    <label class="admin-label" for="meta">Project Overview (detail page body text)</label>
                    <textarea id="meta" name="meta" rows="4" class="admin-input admin-textarea"
                        placeholder="Longer text shown in the 'What this project delivered' section...">{{ old('meta', $artwork->meta) }}</textarea>
                </div>

                <div class="admin-form-group">
                    <label class="admin-label" for="link">Live URL</label>
                    <input type="url" id="link" name="link" value="{{ old('link', $artwork->link) }}" class="admin-input"
                        placeholder="https://example.com">
                </div>

                <div class="admin-form-group">
                    <label class="admin-label">Options</label>
                    <label class="admin-toggle">
                        {{-- Hidden input ensures "0" is sent when checkbox is unchecked --}}
                        <input type="hidden" name="featured" value="0">
                        <input type="checkbox" name="featured" value="1" {{ old('featured', $artwork->featured ?? false) ? 'checked' : '' }}>
                        <span class="admin-toggle__track"></span>
                        <span class="admin-toggle__label">Featured project</span>
                    </label>
                </div>

                <div class="admin-form-group admin-form-group--full">
                    <label class="admin-label" for="tools">Tools Used <span class="admin-form-hint">(one per
                            line)</span></label>
                    <textarea id="tools" name="tools" rows="4" class="admin-input admin-textarea"
                        placeholder="Figma&#10;HTML/CSS&#10;JavaScript&#10;Webflow">{{ old('tools', is_array($artwork->tools) ? implode("\n", $artwork->tools) : $artwork->tools) }}</textarea>
                </div>

            </div>
        </div>

        {{-- ── IMAGES ──────────────────────────────────────────────── --}}
        <div class="admin-card">
            <h3>Images</h3>
            <div class="admin-form-grid">

                {{-- Card Thumbnail --}}
                <div class="admin-form-group">
                    <label class="admin-label">Card Thumbnail</label>
                    <p class="admin-form-hint" style="margin-bottom:.5rem">Shown on the artworks grid card.</p>

                    @if($artwork->image)
                        <div class="admin-current-image" style="margin-bottom:.75rem">
                            <p class="admin-form-hint">Current:</p>
                            @if(str_starts_with($artwork->image, 'artworks/'))
                                <img src="{{ asset('storage/' . $artwork->image) }}" alt="Current"
                                    class="admin-current-image__thumb">
                            @else
                                <img src="{{ asset('images/' . $artwork->image) }}" alt="Current"
                                    class="admin-current-image__thumb">
                            @endif
                        </div>
                    @endif

                    <div class="admin-image-upload-zone" id="cardZone">
                        <div class="admin-image-upload-zone__inner" id="cardPrompt">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" y1="3" x2="12" y2="15" />
                            </svg>
                            <p>Drop or <label for="image" class="admin-image-upload-zone__link">browse</label> to replace
                            </p>
                            <p class="admin-image-upload-zone__hint">PNG, JPG, WEBP — max 4MB</p>
                        </div>
                        <img id="cardPreview" class="admin-image-preview" src="#" alt="" style="display:none">
                        <input type="file" id="image" name="image" accept="image/*" class="admin-file-input"
                            onchange="previewSingle(this,'cardPreview','cardPrompt')">
                    </div>
                    <p class="admin-form-hint">Or use existing filename:</p>
                    <input type="text" name="image_name" value="{{ old('image_name') }}" class="admin-input admin-input--sm"
                        placeholder="Leave blank to keep current">
                    @error('image')<p class="admin-error">{{ $message }}</p>@enderror
                </div>

                {{-- Hero / Mockup Image --}}
                <div class="admin-form-group">
                    <label class="admin-label">Hero / Mockup Image</label>
                    <p class="admin-form-hint" style="margin-bottom:.5rem">Large image shown right side of the detail page
                        hero.</p>

                    @if($artwork->hero_image)
                        <div class="admin-current-image" style="margin-bottom:.75rem">
                            <p class="admin-form-hint">Current:</p>
                            @if(str_starts_with($artwork->hero_image, 'artworks/'))
                                <img src="{{ asset('storage/' . $artwork->hero_image) }}" alt="Current"
                                    class="admin-current-image__thumb">
                            @else
                                <img src="{{ asset('images/' . $artwork->hero_image) }}" alt="Current"
                                    class="admin-current-image__thumb">
                            @endif
                        </div>
                    @endif

                    <div class="admin-image-upload-zone" id="heroZone">
                        <div class="admin-image-upload-zone__inner" id="heroPrompt">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" y1="3" x2="12" y2="15" />
                            </svg>
                            <p>Drop or <label for="hero_image" class="admin-image-upload-zone__link">browse</label> to
                                replace</p>
                            <p class="admin-image-upload-zone__hint">PNG, JPG, WEBP — max 4MB</p>
                        </div>
                        <img id="heroPreview" class="admin-image-preview" src="#" alt="" style="display:none">
                        <input type="file" id="hero_image" name="hero_image" accept="image/*" class="admin-file-input"
                            onchange="previewSingle(this,'heroPreview','heroPrompt')">
                    </div>
                    <p class="admin-form-hint">Or use existing filename:</p>
                    <input type="text" name="hero_image_name" value="{{ old('hero_image_name') }}"
                        class="admin-input admin-input--sm" placeholder="Leave blank to keep current">
                    @error('hero_image')<p class="admin-error">{{ $message }}</p>@enderror
                </div>

                <div class="admin-form-group">
                    <label class="admin-label">Full-Width Preview Image</label>
                    <p class="admin-form-hint" style="margin-bottom:.5rem">Large image shown in the full-width section below
                        the hero.</p>

                    {{-- ADD: show current image --}}
                    @if($artwork->preview_image)
                        <div class="admin-current-image" style="margin-bottom:.75rem">
                            <p class="admin-form-hint">Current:</p>
                            <img src="{{ str_starts_with($artwork->preview_image, 'artworks/') ? asset('storage/' . $artwork->preview_image) : asset('images/' . $artwork->preview_image) }}"
                                alt="Current" class="admin-current-image__thumb">
                        </div>
                    @endif

                    <div class="admin-image-upload-zone" id="previewZone">
                        <div class="admin-image-upload-zone__inner" id="previewPrompt">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" y1="3" x2="12" y2="15" />
                            </svg>
                            <p>Drop or <label for="preview_image" class="admin-image-upload-zone__link">browse</label></p>
                            <p class="admin-image-upload-zone__hint">PNG, JPG, WEBP — max 4MB</p>
                        </div>
                        <img id="previewImgThumb" class="admin-image-preview" src="#" alt="" style="display:none">
                        <input type="file" id="preview_image" name="preview_image" accept="image/*" class="admin-file-input"
                            onchange="previewSingle(this,'previewImgThumb','previewPrompt')">
                    </div>

                    <p class="admin-form-hint">Or use existing filename:</p>
                    {{-- FIX: add value="{{ old('preview_image_name', $artwork->preview_image) }}" --}}
                    <input type="text" name="preview_image_name"
                        value="{{ old('preview_image_name', $artwork->preview_image) }}" class="admin-input admin-input--sm"
                        placeholder="Leave blank to keep current">
                </div>

            </div>
        </div>

        {{-- ── GALLERY ─────────────────────────────────────────────── --}}
        <div class="admin-card">
            <h3>Gallery Screenshots <span style="font-weight:400;color:#666;font-size:.78rem">(optional — shown in "More
                    Screens" section)</span></h3>

            {{-- Existing gallery images --}}
            @if($artwork->gallery && count($artwork->gallery))
                <div style="margin-bottom:1.25rem">
                    <p class="admin-form-hint" style="margin-bottom:.5rem">Current gallery (check to remove):</p>
                    <div style="display:flex;flex-wrap:wrap;gap:.75rem" id="currentGallery">
                        @foreach($artwork->gallery as $i => $item)
                            @php
                                $src = str_starts_with($item['file'] ?? $item, 'artworks/')
                                    ? asset('storage/' . ($item['file'] ?? $item))
                                    : asset('images/' . ($item['file'] ?? $item));
                            @endphp
                            <div style="display:flex;flex-direction:column;align-items:center;gap:.35rem" id="gitem_{{ $i }}">
                                <img src="{{ $src }}"
                                    style="width:90px;height:70px;object-fit:cover;border-radius:6px;border:1px solid #e5e7eb">
                                <span style="font-size:.7rem;color:#666">{{ $item['label'] ?? '' }}</span>
                                <label style="font-size:.72rem;color:#e55;display:flex;align-items:center;gap:3px;cursor:pointer">
                                    <input type="checkbox" name="gallery_remove[]" value="{{ $i }}"
                                        onchange="this.closest('[id^=gitem_]').style.opacity = this.checked ? '0.35' : '1'">
                                    Remove
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- New gallery uploads --}}
            <div id="gallerySlots">
                <div class="gallery-slot" data-index="0">
                    <div class="gallery-slot__inner">
                        <div class="admin-image-upload-zone gallery-upload-zone" id="gz_0">
                            <div class="admin-image-upload-zone__inner" id="gp_0">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.5">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="17 8 12 3 7 8" />
                                    <line x1="12" y1="3" x2="12" y2="15" />
                                </svg>
                                <p>Drop or <label for="gf_0" class="admin-image-upload-zone__link">browse</label></p>
                            </div>
                            <img id="gi_0" class="admin-image-preview" src="#" alt="" style="display:none">
                            <input type="file" id="gf_0" name="gallery_files[]" accept="image/*" class="admin-file-input"
                                onchange="previewGallery(this,0)">
                        </div>
                        <input type="text" name="gallery_labels[]" class="admin-input admin-input--sm"
                            placeholder="Label e.g. Homepage">
                    </div>
                </div>
            </div>

            <button type="button" class="btn-admin btn-admin--ghost" style="margin-top:1rem" onclick="addGallerySlot()">
                + Add another screenshot
            </button>
        </div>

        {{-- ── STATS (Hero Badges) ──────────────────────────────── --}}
        <div class="admin-card">
            <h3>Hero Stats <span style="font-weight:400;color:#666;font-size:.78rem">(up to 3 — shown as floating badges on
                    the project hero)</span></h3>
            <div id="statsSlots" style="display:flex;flex-direction:column;gap:.75rem">

                @php
                    $existingStats = old('stats', isset($artwork) ? (array) ($artwork->stats ?? []) : []);
                @endphp

                @forelse($existingStats as $i => $stat)
                    <div class="stats-slot" style="display:flex;gap:.75rem;align-items:center">
                        <input type="text" name="stats[{{ $i }}][value]" value="{{ $stat['value'] ?? '' }}" class="admin-input"
                            style="width:120px" placeholder="e.g. 98%">
                        <input type="text" name="stats[{{ $i }}][label]" value="{{ $stat['label'] ?? '' }}" class="admin-input"
                            placeholder="e.g. On-time Rate">
                        <button type="button" onclick="this.closest('.stats-slot').remove()"
                            style="background:none;border:none;color:#c0392b;font-size:1.1rem;cursor:pointer;padding:0 4px">✕</button>
                    </div>
                @empty
                    {{-- default 3 empty slots --}}
                    @for($i = 0; $i < 3; $i++)
                        <div class="stats-slot" style="display:flex;gap:.75rem;align-items:center">
                            <input type="text" name="stats[{{ $i }}][value]" class="admin-input" style="width:120px"
                                placeholder="e.g. 98%">
                            <input type="text" name="stats[{{ $i }}][label]" class="admin-input" placeholder="e.g. On-time Rate">
                            <button type="button" onclick="this.closest('.stats-slot').remove()"
                                style="background:none;border:none;color:#c0392b;font-size:1.1rem;cursor:pointer;padding:0 4px">✕</button>
                        </div>
                    @endfor
                @endforelse

            </div>
            <button type="button" class="btn-admin btn-admin--ghost" style="margin-top:.75rem" onclick="addStatSlot()">
                + Add stat
            </button>
        </div>

        {{-- ── SUBMIT / DELETE ─────────────────────────────────────── --}}
        <div class="admin-form-actions">
            <button type="submit" class="btn-admin btn-admin--primary">Save Changes</button>
            <a href="{{ route('admin.artworks.index') }}" class="btn-admin btn-admin--ghost">Cancel</a>
        </div>

    </form>

    {{-- Delete is a separate form — cannot nest forms in HTML --}}
    <form action="{{ route('admin.artworks.destroy', $artwork) }}" method="POST"
        onsubmit="return confirm('Delete this artwork? This cannot be undone.')"
        style="margin-top:.75rem;display:flex;justify-content:flex-end">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-admin btn-admin--danger">Delete Artwork</button>
    </form>

    <style>
        .gallery-slot {
            margin-bottom: 1rem;
        }

        .gallery-slot__inner {
            display: flex;
            flex-direction: column;
            gap: .5rem;
            position: relative;
        }

        .gallery-slot__remove {
            position: absolute;
            top: 6px;
            right: 6px;
            z-index: 10;
            background: rgba(0, 0, 0, .7);
            border: 1px solid rgba(255, 255, 255, .2);
            color: #fff;
            border-radius: 6px;
            padding: 2px 8px;
            font-size: .75rem;
            cursor: pointer;
        }

        .gallery-upload-zone {
            min-height: 100px;
        }

        #gallerySlots {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        @media(max-width:640px) {
            #gallerySlots {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>

    <script>
        // Auto-slug from title
        document.getElementById('title').addEventListener('input', function () {
            document.getElementById('slug').value = this.value.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '').trim().replace(/\s+/g, '-');
        });

        // Single image preview
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

        // Gallery preview
        function previewGallery(input, idx) {
            if (!input.files[0]) return;
            const r = new FileReader();
            r.onload = e => {
                document.getElementById('gi_' + idx).src = e.target.result;
                document.getElementById('gi_' + idx).style.display = 'block';
                document.getElementById('gp_' + idx).style.display = 'none';
            };
            r.readAsDataURL(input.files[0]);
        }

        // Add gallery slot
        let slotCount = 1;
        function addGallerySlot() {
            const i = slotCount++;
            const div = document.createElement('div');
            div.className = 'gallery-slot';
            div.dataset.index = i;
            div.innerHTML = `
                                <div class="gallery-slot__inner">
                                    <button type="button" class="gallery-slot__remove" onclick="this.closest('.gallery-slot').remove()">✕</button>
                                    <div class="admin-image-upload-zone gallery-upload-zone" id="gz_${i}">
                                        <div class="admin-image-upload-zone__inner" id="gp_${i}">
                                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                            <p>Drop or <label for="gf_${i}" class="admin-image-upload-zone__link">browse</label></p>
                                        </div>
                                        <img id="gi_${i}" class="admin-image-preview" src="#" alt="" style="display:none">
                                        <input type="file" id="gf_${i}" name="gallery_files[]" accept="image/*" class="admin-file-input"
                                            onchange="previewGallery(this,${i})">
                                    </div>
                                    <input type="text" name="gallery_labels[]" class="admin-input admin-input--sm"
                                        placeholder="Label e.g. About Us">
                                </div>`;
            document.getElementById('gallerySlots').appendChild(div);
        }

        // Drag & drop for all upload zones
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

        let statCount = document.querySelectorAll('.stats-slot').length;
        function addStatSlot() {
            if (document.querySelectorAll('.stats-slot').length >= 3) {
                alert('Maximum 3 stats allowed.');
                return;
            }
            const i = statCount++;
            const div = document.createElement('div');
            div.className = 'stats-slot';
            div.style.cssText = 'display:flex;gap:.75rem;align-items:center';
            div.innerHTML = `
                        <input type="text" name="stats[${i}][value]" class="admin-input" style="width:120px" placeholder="e.g. 50K+">
                        <input type="text" name="stats[${i}][label]" class="admin-input" placeholder="e.g. Rides Completed">
                        <button type="button" onclick="this.closest('.stats-slot').remove()"
                            style="background:none;border:none;color:#c0392b;font-size:1.1rem;cursor:pointer;padding:0 4px">✕</button>`;
            document.getElementById('statsSlots').appendChild(div);
        }
    </script>
@endsection
