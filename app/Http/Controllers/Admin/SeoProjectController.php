<?php
// ═══════════════════════════════════════════════════════
// FILE: app/Http/Controllers/Admin/SeoProjectController.php
// ═══════════════════════════════════════════════════════

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoProject;
use Illuminate\Http\Request;

class SeoProjectController extends Controller
{
    public function index()
    {
        return view('admin.seo.index', [
            'projects' => SeoProject::orderBy('order')->get(),
            'tools' => \App\Models\SeoTool::orderBy('order')->get(),
            'seoSkills' => \App\Models\SeoSkill::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.seo.project-create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'client' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'overview' => 'nullable|string',
            'link' => 'nullable|string|max:255',
            'featured' => 'boolean',
            'tools' => 'nullable|string',
            'results' => 'nullable|string',
            'skills' => 'nullable|string',   // ← added
            'order' => 'nullable|integer',
        ]);

        $data['featured'] = $request->boolean('featured');
        $data['tools'] = $this->parseLines($data['tools'] ?? null);
        $data['results'] = $this->parseLines($data['results'] ?? null);
        // skills stays as plain text — no transformation needed

        SeoProject::create($data);

        return redirect()->route('admin.seo-projects.index')
            ->with('success', 'SEO project added.');
    }

    public function edit(SeoProject $seoProject)
    {
        return view('admin.seo.project-edit', ['project' => $seoProject]);
    }

    public function update(Request $request, SeoProject $seoProject)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'client' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'overview' => 'nullable|string',
            'link' => 'nullable|string|max:255',
            'featured' => 'boolean',
            'tools' => 'nullable|string',
            'results' => 'nullable|string',
            'skills' => 'nullable|string',   // ← added
            'order' => 'nullable|integer',
        ]);

        $data['featured'] = $request->boolean('featured');
        $data['tools'] = $this->parseLines($data['tools'] ?? null);
        $data['results'] = $this->parseLines($data['results'] ?? null);
        // skills stays as plain text — no transformation needed

        $seoProject->update($data);

        return redirect()->route('admin.seo-projects.index')
            ->with('success', 'SEO project updated.');
    }

    public function destroy(SeoProject $seoProject)
    {
        $seoProject->delete();
        return redirect()->route('admin.seo-projects.index')
            ->with('success', 'SEO project deleted.');
    }

    private function parseLines(?string $raw): array
    {
        if (!$raw)
            return [];
        return array_values(array_filter(array_map('trim', explode("\n", $raw))));
    }
}
