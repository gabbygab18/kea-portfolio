<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    public function index()
    {
        return view('admin.artworks.index', [
            'artworks' => Artwork::orderBy('sort_order')->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.artworks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:artworks,slug',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
            'image_name' => 'nullable|string|max:255',
            'hero_image' => 'nullable|image|max:4096',
            'hero_image_name' => 'nullable|string|max:255',
            'preview_image' => 'nullable|image|max:4096',
            'preview_image_name' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'tools' => 'nullable|string',
            'featured' => 'sometimes|boolean',
            'meta' => 'nullable|string',
            'gallery_files.*' => 'nullable|image|max:4096',
            'gallery_labels.*' => 'nullable|string|max:100',
            'stats' => 'nullable|array',
            'stats.*' => 'nullable|array',
        ]);

        $data['image'] = $this->handleImageUpload($request, 'image', 'image_name');
        $data['hero_image'] = $this->handleImageUpload($request, 'hero_image', 'hero_image_name');
        $data['preview_image'] = $this->handleImageUpload($request, 'preview_image', 'preview_image_name');
        $data['gallery'] = $this->handleGalleryUpload($request);
        $data['tools'] = $this->parseTools($data['tools'] ?? null);
        $data['featured'] = $request->boolean('featured');

        unset(
            $data['image_name'],
            $data['hero_image_name'],
            $data['preview_image_name'],
            $data['gallery_files'],
            $data['gallery_labels']
        );

        $data['stats'] = collect($request->input('stats', []))
            ->filter(fn($s) => !empty($s['value']) || !empty($s['label']))
            ->values()
            ->toArray();

        Artwork::create($data);

        return redirect()->route('admin.artworks.index')
            ->with('success', 'Artwork created successfully.');
    }

    public function edit(Artwork $artwork)
    {
        return view('admin.artworks.edit', compact('artwork'));
    }

    public function update(Request $request, Artwork $artwork)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:artworks,slug,' . $artwork->id,
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'meta' => 'nullable|string',
            'link' => 'nullable|url',
            'featured' => 'nullable|boolean',
            'tools' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
            'hero_image' => 'nullable|image|max:4096',
            'preview_image' => 'nullable|image|max:4096',
            'gallery_files.*' => 'nullable|image|max:4096',
            'gallery_labels.*' => 'nullable|string|max:255',
            'gallery_remove' => 'nullable|array',
            'gallery_remove.*' => 'nullable|integer',
            'stats' => 'nullable|array',
            'stats.*.value' => 'nullable|string|max:50',
            'stats.*.label' => 'nullable|string|max:100',
        ]);

        // ── Tools ─────────────────────────────────────
        $artwork->tools = $request->filled('tools')
            ? array_filter(array_map('trim', explode("\n", $request->tools)))
            : null;

        // ── Stats ─────────────────────────────────────
        $artwork->stats = collect($request->input('stats', []))
            ->filter(fn($s) => !empty($s['value']) || !empty($s['label']))
            ->values()
            ->toArray() ?: null;

        // ── Card thumbnail ────────────────────────────
        if ($request->hasFile('image')) {
            $artwork->image = $request->file('image')->store('artworks', 'public');
        } elseif ($request->filled('image_name')) {
            $artwork->image = $request->image_name;
        }

        // ── Hero image ────────────────────────────────
        if ($request->hasFile('hero_image')) {
            $artwork->hero_image = $request->file('hero_image')->store('artworks', 'public');
        } elseif ($request->filled('hero_image_name')) {
            $artwork->hero_image = $request->hero_image_name;
        }

        // ── Preview image ─────────────────────────────
        if ($request->hasFile('preview_image')) {
            $artwork->preview_image = $request->file('preview_image')->store('artworks', 'public');
        } elseif ($request->filled('preview_image_name')) {
            $artwork->preview_image = $request->preview_image_name;
        }

        // ── Gallery: remove checked items first ───────
        $gallery = collect($artwork->gallery ?? []);

        if ($request->filled('gallery_remove')) {
            $toRemove = array_map('intval', $request->gallery_remove);
            $gallery = $gallery->filter(fn($item, $i) => !in_array($i, $toRemove))->values();
        }

        // ── Gallery: append new uploads ───────────────
        $files = $request->file('gallery_files', []);
        $labels = $request->input('gallery_labels', []);

        foreach ($files as $idx => $file) {
            if ($file && $file->isValid()) {
                $gallery->push([
                    'file' => $file->store('artworks', 'public'),
                    'label' => $labels[$idx] ?? '',
                ]);
            }
        }

        $artwork->gallery = $gallery->isEmpty() ? null : $gallery->values()->toArray();

        // ── Scalar fields ─────────────────────────────
        $artwork->title = $data['title'];
        $artwork->slug = $data['slug'];
        $artwork->category = $data['category'] ?? null;
        $artwork->description = $data['description'] ?? null;
        $artwork->meta = $data['meta'] ?? null;
        $artwork->link = $data['link'] ?? null;
        $artwork->featured = $request->boolean('featured');

        $artwork->save();

        return redirect()->route('admin.artworks.index')->with('success', 'Artwork updated.');
    }

    public function destroy(Artwork $artwork)
    {
        $this->deleteStorageFile($artwork->image);
        $this->deleteStorageFile($artwork->hero_image);
        $this->deleteStorageFile($artwork->preview_image);
        foreach ((array) ($artwork->gallery ?? []) as $item) {
            $this->deleteStorageFile($item['file'] ?? null);
        }
        $artwork->delete();

        return redirect()->route('admin.artworks.index')
            ->with('success', 'Artwork removed.');
    }

    public function reorder(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:artworks,id',
        ]);

        foreach ($request->ids as $order => $id) {
            Artwork::where('id', $id)->update(['sort_order' => $order]);
        }

        return response()->json(['success' => true]);
    }

    // ── Helpers ───────────────────────────────────────────────

    private function handleImageUpload(Request $request, string $field, string $nameField): ?string
    {
        if ($request->hasFile($field)) {
            return $request->file($field)->store('artworks', 'public');
        }
        if ($request->filled($nameField)) {
            return $request->input($nameField);
        }
        return null;
    }

    private function handleGalleryUpload(Request $request): array
    {
        $gallery = [];
        $files = $request->file('gallery_files', []);
        $labels = $request->input('gallery_labels', []);

        foreach ($files as $i => $file) {
            if ($file && $file->isValid()) {
                $path = $file->store('artworks/gallery', 'public');
                $label = $labels[$i] ?? '';
                $gallery[] = ['label' => $label, 'file' => $path];
            }
        }
        return $gallery;
    }

    private function deleteStorageFile(?string $path): void
    {
        if ($path && str_starts_with($path, 'artworks/')) {
            Storage::disk('public')->delete($path);
        }
    }

    private function parseTools(?string $raw): array
    {
        if (!$raw)
            return [];
        return array_values(array_filter(array_map('trim', explode("\n", $raw))));
    }
}
