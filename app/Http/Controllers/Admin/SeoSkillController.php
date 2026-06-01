<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSkill;
use Illuminate\Http\Request;

class SeoSkillController extends Controller
{
    public function create()
    {
        return view('admin.seo.skill-create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer',
        ]);

        SeoSkill::create($data);

        return redirect()->route('admin.seo-projects.index')
            ->with('success', 'SEO skill added.');
    }

    public function edit(SeoSkill $seoSkill)
    {
        return view('admin.seo.skill-edit', ['skill' => $seoSkill]);
    }

    public function update(Request $request, SeoSkill $seoSkill)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer',
        ]);

        $seoSkill->update($data);

        return redirect()->route('admin.seo-projects.index')
            ->with('success', 'SEO skill updated.');
    }

    public function destroy(SeoSkill $seoSkill)
    {
        $seoSkill->delete();
        return redirect()->route('admin.seo-projects.index')
            ->with('success', 'SEO skill deleted.');
    }
}
