<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        return view('admin.skills.index', [
            'skills' => Skill::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'nullable|string|max:100',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        Skill::create($data);

        return redirect()->route('admin.skills.index')->with('success', 'Skill added.');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', [
            'skill' => $skill,
        ]);
    }

    public function update(Request $request, Skill $skill)
    {
        $data = $request->validate([
            'category' => 'nullable|string|max:100',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $skill->update($data);

        return redirect()->route('admin.skills.index')->with('success', 'Skill updated.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted.');
    }
}
