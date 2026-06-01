<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoTool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeoToolController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.seo-projects.index');
    }

    public function create()
    {
        return view('admin.seo.tool-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'icon_path'   => 'nullable|string|max:255',
            'icon'        => 'nullable|image|max:2048',
            'order'       => 'nullable|integer',
        ]);

        $toolData = [
            'name'        => $request->name,
            'category'    => $request->category,
            'description' => $request->description,
            'icon_path'   => $request->icon_path,
            'order'       => $request->order ?? 0,
        ];

        if ($request->hasFile('icon')) {
            $toolData['icon'] = $request->file('icon')->store('seo-tools', 'public');
        }

        SeoTool::create($toolData);

        return redirect()->route('admin.seo-projects.index')
            ->with('success', 'SEO tool added.');
    }

    public function edit(SeoTool $seoTool)
    {
        return view('admin.seo.tool-edit', ['tool' => $seoTool]);
    }

    public function update(Request $request, SeoTool $seoTool)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'icon_path'   => 'nullable|string|max:255',
            'icon'        => 'nullable|image|max:2048',
            'order'       => 'nullable|integer',
        ]);

        $toolData = [
            'name'        => $request->name,
            'category'    => $request->category,
            'description' => $request->description,
            'icon_path'   => $request->icon_path,
            'order'       => $request->order ?? 0,
        ];

        if ($request->hasFile('icon')) {
            if ($seoTool->icon) {
                Storage::disk('public')->delete($seoTool->icon);
            }
            $toolData['icon'] = $request->file('icon')->store('seo-tools', 'public');
        }

        $seoTool->update($toolData);

        return redirect()->route('admin.seo-projects.index')
            ->with('success', 'SEO tool updated.');
    }

    public function destroy(SeoTool $seoTool)
    {
        if ($seoTool->icon) {
            Storage::disk('public')->delete($seoTool->icon);
        }

        $seoTool->delete();
        return redirect()->route('admin.seo-projects.index')
            ->with('success', 'SEO tool deleted.');
    }
}
