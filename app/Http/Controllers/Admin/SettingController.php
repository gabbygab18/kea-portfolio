<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index', [
            'settings' => Setting::orderBy('key')->get(),
        ]);
    }

    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', [
            'setting' => $setting,
        ]);
    }

    public function update(Request $request, Setting $setting)
    {
        $data = $request->validate([
            'value' => 'nullable|string',
        ]);

        $setting->update($data);

        return redirect()->route('admin.settings.index')->with('success', 'Setting updated.');
    }
}
