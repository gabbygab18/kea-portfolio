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
            'artworks' => Artwork::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.artworks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'               => 'required|string|max:255',
            'slug'                => 'required|string|max:255|unique:artworks,slug',
            'category'            => 'nullable|string|max:100',
            'description'         => 'nullable|string',
            'image'               => 'nullable|image|max:4096',
            'image_name'          => 'nullable|string|max:255',
            'hero_image'          => 'nullable|image|max:4096',
            'hero_image_name'     => 'nullable|string|max:255',
            'preview_image'       => 'nullable|image|max:4096',
            'preview_image_name'  => 'nullable|string|max:255',
            'link'                => 'nullable|url|max:255',
            'tools'               => 'nullable|string',
            'featured'            => 'sometimes|boolean',
            'meta'                => 'nullable|string',
            'gallery_files.*'     => 'nullable|image|max:4096',
            'gallery_labels.*'    => 'nullable|string|max:100',
            'stats'               => 'nullable|array',
            'stats.*'             => 'nullable|array',
        ]);

        $data['image']         = $this->handleImageUpload($request, 'image', 'image_name');
        $data['hero_image']    = $this->handleImageUpload($request, 'hero_image', 'hero_image_name');
        $data['preview_image'] = $this->handleImageUpload($request, 'preview_image', 'preview_image_name');
        $data['gallery']       = $this->handleGalleryUpload($request);
        $data['tools']         = $this->parseTools($data['tools'] ?? null);
        $data['featured']      = $request->boolean('featured');

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
            'title'               => 'required|string|max:255',
            'slug'                => 'required|string|max:255|unique:artworks,slug,' . $artwork->id,
            'category'            => 'nullable|string|max:100',
            'description'         => 'nullable|string',
            'image'               => 'nullable|image|max:4096',
            'image_name'          => 'nullable|string|max:255',
            'hero_image'          => 'nullable|image|max:4096',
            'hero_image_name'     => 'nullable|string|max:255',
            'preview_image'       => 'nullable|image|max:4096',
            'preview_image_name'  => 'nullable|string|max:255',
            'link'                => 'nullable|url|max:255',
            'tools'               => 'nullable|string',
            'featured'            => 'sometimes|boolean',
            'meta'                => 'nullable|string',
            'gallery_files.*'     => 'nullable|image|max:4096',
            'gallery_labels.*'    => 'nullable|string|max:100',
            'gallery_delete.*'    => 'nullable|string',
            'stats'               => 'nullable|array',
            'stats.*'             => 'nullable|array',
        ]);

        // Main image
        $newImage = $this->handleImageUpload($request, 'image', 'image_name');
        if ($newImage) {
            $this->deleteStorageFile($artwork->image);
            $data['image'] = $newImage;
        } else {
            $data['image'] = $artwork->image;
        }

        // Hero image
        $newHero = $this->handleImageUpload($request, 'hero_image', 'hero_image_name');
        if ($newHero) {
            $this->deleteStorageFile($artwork->hero_image);
            $data['hero_image'] = $newHero;
        } else {
            $data['hero_image'] = $artwork->hero_image;
        }

        // Preview image
        $newPreview = $this->handleImageUpload($request, 'preview_image', 'preview_image_name');
        if ($newPreview) {
            $this->deleteStorageFile($artwork->preview_image);
            $data['preview_image'] = $newPreview;
        } else {
            $data['preview_image'] = $artwork->preview_image;
        }

        // Gallery — keep existing, remove deleted, add new
        $existing = (array) ($artwork->gallery ?? []);
        $toDelete = $request->input('gallery_remove', []);
        $existing = array_values(array_filter($existing, function ($item) use ($toDelete) {
            if (in_array($item['file'], $toDelete)) {
                $this->deleteStorageFile($item['file']);
                return false;
            }
            return true;
        }));
        $newGallery = $this->handleGalleryUpload($request);
        $data['gallery'] = array_merge($existing, $newGallery);

        $data['tools']    = $this->parseTools($data['tools'] ?? null);
        $data['featured'] = $request->boolean('featured');

        unset(
            $data['image_name'],
            $data['hero_image_name'],
            $data['preview_image_name'],
            $data['gallery_files'],
            $data['gallery_labels'],
            $data['gallery_delete']
        );

        $data['stats'] = collect($request->input('stats', []))
            ->filter(fn($s) => !empty($s['value']) || !empty($s['label']))
            ->values()
            ->toArray();

        $artwork->update($data);

        return redirect()->route('admin.artworks.index')
            ->with('success', 'Artwork updated successfully.');
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
        $files   = $request->file('gallery_files', []);
        $labels  = $request->input('gallery_labels', []);

        foreach ($files as $i => $file) {
            if ($file && $file->isValid()) {
                $path      = $file->store('artworks/gallery', 'public');
                $label     = $labels[$i] ?? '';
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
        if (!$raw) return [];
        return array_values(array_filter(array_map('trim', explode("\n", $raw))));
    }
}
