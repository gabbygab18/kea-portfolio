<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsletterPhotoController extends Controller
{
    public function index()
    {
        return view('admin.newsletter-photos.index', [
            'leftPhotos'  => NewsletterPhoto::where('column', 'left')->orderBy('order')->get(),
            'rightPhotos' => NewsletterPhoto::where('column', 'right')->orderBy('order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'photos'         => 'required|array|min:1',
            'photos.*'       => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'column'         => 'required|in:left,right',
            'alt'            => 'nullable|string|max:255',
        ]);

        $column     = $data['column'];
        $nextOrder  = NewsletterPhoto::where('column', $column)->max('order') + 1;

        foreach ($request->file('photos') as $file) {
            $path = $file->store('newsletter', 'public');

            NewsletterPhoto::create([
                'image_path' => $path,
                'alt'        => $data['alt'] ?? null,
                'column'     => $column,
                'order'      => $nextOrder++,
            ]);
        }

        return redirect()->route('admin.newsletter-photos.index')
            ->with('success', 'Photo(s) uploaded successfully.');
    }

    public function destroy(NewsletterPhoto $newsletterPhoto)
    {
        Storage::disk('public')->delete($newsletterPhoto->image_path);
        $newsletterPhoto->delete();

        return redirect()->route('admin.newsletter-photos.index')
            ->with('success', 'Photo deleted.');
    }

    /**
     * Reorder via AJAX — expects JSON body: { ids: [1,3,2,...] }
     */
    public function reorder(Request $request)
    {
        $request->validate(['ids' => 'required|array']);

        foreach ($request->ids as $order => $id) {
            NewsletterPhoto::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['ok' => true]);
    }
}
