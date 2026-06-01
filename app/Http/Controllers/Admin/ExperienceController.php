<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        return view('admin.experiences.index', [
            'experiences' => Experience::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company'    => 'required|string|max:255',
            'role'       => 'required|string|max:255',
            'date_range' => 'required|string|max:100',
            'location'   => 'nullable|string|max:100',
            'type'       => 'nullable|string|max:100',
            'bullets'    => 'nullable|string',
            'order'      => 'nullable|integer',
        ]);

        $data['bullets'] = $this->parseBullets($data['bullets'] ?? null);
        Experience::create($data);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience added.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $data = $request->validate([
            'company'    => 'required|string|max:255',
            'role'       => 'required|string|max:255',
            'date_range' => 'required|string|max:100',
            'location'   => 'nullable|string|max:100',
            'type'       => 'nullable|string|max:100',
            'bullets'    => 'nullable|string',
            'order'      => 'nullable|integer',
        ]);

        $data['bullets'] = $this->parseBullets($data['bullets'] ?? null);
        $experience->update($data);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience updated.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience deleted.');
    }

    private function parseBullets(?string $raw): array
    {
        if (!$raw) return [];
        return array_values(array_filter(array_map('trim', explode("\n", $raw))));
    }
}
